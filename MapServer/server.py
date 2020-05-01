#!/usr/bin/env python
# coding=utf-8
import json
import os
import random
import time
import urllib
import urllib2
import config
import ee
import jinja2
import webapp2
# import mysql
import numpy as np

jinja_environment = jinja2.Environment(
    loader=jinja2.FileSystemLoader(os.path.dirname(__file__)))

class Map(webapp2.RequestHandler):
  def get(self,mapa):
    import logging
    if "www" not in self.request.url:
      self.redirect("http://www.wegp.unam.mx/"+mapa)
    FORMAT = '%(asctime)-15s %(clientip)s %(user)-8s %(message)s'
    logging.basicConfig(format=FORMAT)
    d = {'clientip': '192.168.0.1', 'user': 'fbloggs'}
    logger = logging.getLogger('tcpserver')
    logger.info('Getting map '+mapa+' from '+os.environ["REMOTE_ADDR"])
    version = config.RELEASE
    if config.WORKING and os.environ["REMOTE_ADDR"] == "10.10.10.1":
      version = config.DEBUG
    if config.OFFLINE and os.environ["REMOTE_ADDR"] != "10.10.10.1":
      template = jinja_environment.get_template('templates/working.html')
      self.response.out.write(template.render())
      return
    bd=config.getBDFromPath(self.request.url)
    url = config.baseURL+'getMapCountry.php?url='+mapa+'&bd='+bd
    print url
    idCaratula = config.getIDBD(bd)
    error = False
    try:
      result = urllib2.urlopen(url)
      r=result.read()
      row = json.loads(r)
      if row[0] is None:
        self.redirect("/");
        return None
      lat = str(row[0])
      lng = str(row[1])
      zoom = int(row[2])
      maxZoom = int(row[3])
      idPais = int(row[5])
      estados = str(row[6])
      colesId = str(row[7])
      colesNom = str(row[8])
      municipios = str(row[9])
      colmunId = str(row[10])
      colmunNom = str(row[11])
      pais = str(row[12])
      colpaiId = str(row[13])
      colpaiNom = str(row[14])
      nombrePais = str(row[19])
    except urllib2.URLError:
      print url
    template = jinja_environment.get_template('templates/test/testMenus.html')
    #template = jinja_environment.get_template('templates/mapa.html')
    self.response.out.write(template.render({
        'version': version,
        'key': config.KEY,
        'zoom': zoom,
        'maxZoom': maxZoom,
        'mapa': mapa,
        'lat': lat,
        'lng': lng,
        'home': bd,
        'estadosT': estados,
        'colesId': colesId,
        'colesNom': colesNom,
        'municipiosT': municipios,
        'colmunId': colmunId,
        'colmunNom': colmunNom,
        'paisT': pais,
        'colpaiId': colpaiId,
        'colpaiNom': colpaiNom,
        'idPaisGlobal': idPais,
		'idCaratula': idCaratula,
		'nombrePais': nombrePais
    }))

class SubCourses(webapp2.RequestHandler):
  def get(self,courseName,coursePage):
    if "www" not in self.request.url:
       self.redirect("http://www.wegp.unam.mx/courses/"+courseName+"/"+coursePage)
    if config.WORKING and os.environ["REMOTE_ADDR"] == "10.10.10.1":
      version = config.DEBUG
    if config.OFFLINE and os.environ["REMOTE_ADDR"] != "10.10.10.1":
      template = jinja_environment.get_template('templates/working.html')
      self.response.out.write(template.render())
      return
    template = jinja_environment.get_template('templates/courses/'+courseName+'/'+coursePage+'.html')
    self.response.out.write(template.render({'key': config.KEY}))

class Courses(webapp2.RequestHandler):
  def get(self,courseName):
    rest = ""
    if courseName is not None:
       rest = "/"+courseName
    if "www" not in self.request.url:
       self.redirect("http://www.wegp.unam.mx/courses"+rest)
    if config.WORKING and os.environ["REMOTE_ADDR"] == "10.10.10.1":
      version = config.DEBUG
    if config.OFFLINE and os.environ["REMOTE_ADDR"] != "10.10.10.1":
      template = jinja_environment.get_template('templates/working.html')
      self.response.out.write(template.render())
      return
    template = jinja_environment.get_template('templates/courses'+rest+"/index.html")
    self.response.out.write(template.render({'key': config.KEY}))

class TestPage(webapp2.RequestHandler):
  def get(self,rest):
    num = ''
    if rest is not None:
      num = rest
    if "www" not in self.request.url:
      self.redirect("http://www.wegp.unam.mx/test"+num)
    template = jinja_environment.get_template('templates/test/test'+num+'.html')
    self.response.out.write(template.render())

class google(webapp2.RequestHandler):
  def get(self):
    template = jinja_environment.get_template('templates/google5f83ec30cc8bae09.html')        
    self.response.out.write(template.render())
	
class test(webapp2.RequestHandler):
  def get(self,idSegmento,nivel):    
    url = 'http://www.mofuss.unam.mx/test/update.php?idSegmento='+idSegmento+'&nivel='+str(nivel).strip()
    print url        
    try:
      result = urllib2.urlopen(url)
      r=result.read()
    except urllib2.URLError:
      print "Error: "+url
    print r
    template = jinja_environment.get_template('templates/test.html')        
    self.response.out.write(template.render({
       'response': r
	}))

class RedirectCemie(webapp2.RequestHandler):
  def get(self):    
    self.redirect("http://www.wegp.unam.mx/cemie/1")

class RedirectCemieMap(webapp2.RequestHandler):
  def get(self,mapa):    
    self.redirect("http://www.wegp.unam.mx/cemie/1/"+mapa)

class VersionCemie(webapp2.RequestHandler):
  def get(self,version):        
    if "www" not in self.request.url:
      self.redirect("http://www.wegp.unam.mx/cemie/"+version)
    if version != "1" and version != "2":
      self.redirect("http://www.wegp.unam.mx/cemie/1")
    if config.OFFLINE and (os.environ["REMOTE_ADDR"] != "10.10.10.1"):# and os.environ["REMOTE_ADDR"] != "132.247.186.47"):
      template = jinja_environment.get_template('templates/working.html')
      self.response.out.write(template.render())
      return       
    template = jinja_environment.get_template('templates/version/'+version+'/cemie.html')
    self.response.out.write(template.render())

class MapCemie(webapp2.RequestHandler):
  def get(self,version,mapa):
    import logging
    import string
    if version != "1" and version != "2":
      self.redirect("http://www.wegp.unam.mx/cemie/1/"+mapa)
    if string.lower(mapa) != "mexico":
      self.redirect("http://www.wegp.unam.mx/cemie/"+version+"/Mexico")
    if "www" not in self.request.url:
      self.redirect("http://www.wegp.unam.mx/cemie/"+version+"/"+mapa)
    FORMAT = '%(asctime)-15s %(clientip)s %(user)-8s %(message)s'
    logging.basicConfig(format=FORMAT)
    d = {'clientip': '192.168.0.1', 'user': 'fbloggs'}
    logger = logging.getLogger('tcpserver')
    logger.info('Getting map '+mapa+' from '+os.environ["REMOTE_ADDR"])    
    if config.OFFLINE and os.environ["REMOTE_ADDR"] != "10.10.10.1":
      template = jinja_environment.get_template('templates/working.html')
      self.response.out.write(template.render())
      return    
    url = config.baseURL+'getMapCountry.php?url='+mapa+'&bd=cemie'+version
    print url    
    error = False
    try:
      result = urllib2.urlopen(url)
      r=result.read()
      row = json.loads(r)
      if row[0] is None:
        self.redirect("/");
        return None
      lat = str(row[0])
      lng = str(row[1])
      zoom = int(row[2])
      maxZoom = int(row[3])
      idPais = int(row[5])
      estados = str(row[6])
      colesId = str(row[7])
      colesNom = str(row[8])
      municipios = str(row[9])
      colmunId = str(row[10])
      colmunNom = str(row[11])
      pais = str(row[12])
      colpaiId = str(row[13])
      colpaiNom = str(row[14])
      nombrePais = str(row[19])
    except urllib2.URLError:
      print url
    template = jinja_environment.get_template("templates/version/"+version+"/mapa.html")
    self.response.out.write(template.render({        
        'key': config.KEY,
        'zoom': zoom,
        'maxZoom': maxZoom,
        'mapa': mapa,
        'lat': lat,
        'lng': lng,
        'home': "cemie"+version,
        'idPaisGlobal': idPais,
		'idCaratula': 2,
		'nombrePais': nombrePais
    }))

class MainPage(webapp2.RequestHandler):
  def get(self,*rest):
    version = config.RELEASE
    if config.WORKING and os.environ["REMOTE_ADDR"] == "10.10.10.1":
      version=config.DEBUG
    if config.OFFLINE and os.environ["REMOTE_ADDR"] != "10.10.10.1":
      template = jinja_environment.get_template('templates/working.html')
      self.response.out.write(template.render())
      return
    if len(list(rest)) == 0:
      template = jinja_environment.get_template('templates/index.html')
      self.response.out.write(template.render({
          'cache_bust': random.randint(0, 150000),
		  'version': version
      }))
    else:
      import logging
      FORMAT = '%(asctime)-15s %(clientip)s %(user)-8s %(message)s'
      logging.basicConfig(format=FORMAT)
      d = {'clientip': '192.168.0.1', 'user': 'fbloggs'}
      logger = logging.getLogger('tcpserver')
      logger.info('Getting '+str(list(rest))+' from '+os.environ["REMOTE_ADDR"])
      self.redirect("/");

class SubPages(webapp2.RequestHandler):
  def get(self):
    bd=config.getBDFromPath2(self.request.url)
    if "www" not in self.request.url:
      self.redirect("http://www.wegp.unam.mx/"+bd)
    version = config.RELEASE
    if config.WORKING and os.environ["REMOTE_ADDR"] == "10.10.10.1":
      version = config.DEBUG
    if config.OFFLINE and os.environ["REMOTE_ADDR"] != "10.10.10.1":
      template = jinja_environment.get_template('templates/working.html')
      self.response.out.write(template.render())
      return       
    template = jinja_environment.get_template('templates/'+bd+'.html')
    self.response.out.write(template.render({
        'index': '/'+bd,
        'version': version
    }))
	
class DemoPages(webapp2.RequestHandler):
  def get(self,rest):
    bd=config.getBDFromPath3(self.request.url)
    #print os.environ
    #print self.request
    if "www" not in self.request.url:
      self.redirect("http://www.wegp.unam.mx/"+bd+"/"+rest)
    version = config.RELEASE
    if config.WORKING and os.environ["REMOTE_ADDR"] == "10.10.10.1":
      version = config.DEBUG
    if config.OFFLINE and os.environ["REMOTE_ADDR"] != "10.10.10.1":
      template = jinja_environment.get_template('templates/working.html')
      self.response.out.write(template.render())
      return   
    bd=config.getBDFromPath3(self.request.url)
    mapa='Mexico'
    url = config.baseURL+'getMapCountry.php?url='+mapa+'&bd='+bd
    error = False
    template = jinja_environment.get_template('templates/demoPages/'+bd+'/'+rest+'/index.html')    
    if config.OFFLINE and os.environ["REMOTE_ADDR"] == "10.10.10.1":
      template = jinja_environment.get_template('templates/demoPages/'+bd+'/'+rest+'/index_offline.html')
      self.response.out.write(template.render())
      return
    try:
      result = urllib2.urlopen(url)
      r=result.read()
      row = json.loads(r)
      if row[0] is None:
        self.redirect("/");
        return None
      lat = str(row[0])
      lng = str(row[1])
      zoom = int(row[2])
      maxZoom = int(row[3])
      idPais = int(row[5])
      estados = str(row[6])
      colesId = str(row[7])
      colesNom = str(row[8])
      municipios = str(row[9])
      colmunId = str(row[10])
      colmunNom = str(row[11])
      pais = str(row[12])
      colpaiId = str(row[13])
      colpaiNom = str(row[14])
    except urllib2.URLError:
      print url
    self.response.out.write(template.render({
        'version': version,
        'key': config.KEY,
        'zoom': zoom,
        'maxZoom': maxZoom,
        'mapa': mapa,
        'lat': lat,
        'lng': lng,
        'home': bd,
        'estadosT': estados,
        'colesId': colesId,
        'colesNom': colesNom,
        'municipiosT': municipios,
        'colmunId': colmunId,
        'colmunNom': colmunNom,
        'paisT': pais,
        'colpaiId': colpaiId,
        'colpaiNom': colpaiNom,
        'idPaisGlobal': idPais
    }))
	
class GetMapData(webapp2.RequestHandler):
  def get(self):    
    self.response.headers.add_header('Access-Control-Allow-Origin', '*')
    self.response.headers['Content-Type'] = 'application/json'
    idm = str(self.request.get('mapid'))   
    bd=str(self.request.get('bd'))
    url = config.baseURL+'getMapData.php?idCapa='+idm+'&bd='+bd   
    print url
    try:
      result = urllib2.urlopen(url)
      r=result.read()
      row = json.loads(r)
      name = str(row[0])
      lat = float(row[1])
      lng = float(row[2])
      zoom = int(row[3])
      columna = str(row[4])
      valor = str(row[5])
      style = str(row[6])
      name2 = str(row[7])
      unidad = str(row[8])
      tipo = str(row[9])
      escalaLog = int(row[10])
      password=str(row[12])
      numRows=str(row[13])
      numCols=str(row[14])
      textoColumnas=str(row[15])
      varColumna=str(row[16])
      plantillaId=str(row[17])
    except urllib2.URLError, e:
      print e
      print url
      return
    ee.Initialize(config.EE_CREDENTIALS)
    layers = []
    if tipo == 'tiff' or tipo == 'raster' or tipo == 'Raster':
       minV, maxV, colors = config.getMinMaxColors(style, columna)
       image = ee.Image(''+name)
       image = image.updateMask(image.gte(minV).And(image.lte(maxV)))       
       if escalaLog == 1:
          from math import log10
          maxV = log10(maxV)
          if minV == 0:
             minV = log10(minV+1)
          else:
             minV = log10(minV)
       options = {
         'palette': colors,
         'min': minV,
         'max': maxV,
         'format':'png'
       }
       if escalaLog == 1:          
          mapid = image.add(1).log10().getMapId(options)          
       else:
          mapid = image.getMapId(options)
       layers.append({
          'lng': lng,
          'lat': lat,
          'mapid': mapid['mapid'],
          'token': mapid['token'],
          'type': 'image',
          'zoom': zoom,
          'name': name,
          'unidad': unidad,
          'style': style,
          'columna': columna,
	      'password': password
       })
    elif tipo == 'table' or tipo == 'vectorial':
       if valor == 'None' or valor == '':
          layers.append({
            'lng': lng,
            'lat': lat,
            'zoom': zoom,
            'type': 'no_filter',
            'style': style,
	        'columna': columna,
            'name': name,
	        'nameZoom': name2,
            'unidad': unidad,
            'password': password,
			'numRows':numRows,
            'numCols':numCols,
            'textoColumnas':textoColumnas,
            'varColumna':varColumna,
            'plantillaId':plantillaId
          })
       else:
          layers.append({
            'lng': lng,
            'lat': lat,
            'zoom': zoom,
            'type': 'filter',
            'style': style,
            'columna': columna,
            'valor': valor,
            'name': name,
	        'nameZoom': name2,
            'unidad': unidad,
            'password': password,
			'numRows':numRows,
            'numCols':numCols,
            'textoColumnas':textoColumnas,
            'varColumna':varColumna,
            'plantillaId':plantillaId
          })
    else:
      global minVG, maxVG, colorsG
      minVG, maxVG, colorsG = config.getMinMaxColors(style, columna)
      minV = minVG
      maxV = maxVG
      colors = colorsG 
      imageC = ee.ImageCollection(''+name)
      imageC = imageC.map(updateMinMax)
      listIm = imageC.toList(imageC.size())
      options = {
         'palette': colors,
         'min': minV,
         'max': maxV,
         'format':'png'
      }
      for i in range(0, imageC.size().getInfo()):
        image = ee.Image(listIm.get(i))
        if escalaLog == 1:
          from math import log10
          maxV = log10(maxV)
          if minV == 0:
             minV = log10(minV+1)
          else:
             minV = log10(minV)
        if escalaLog == 1:
          mapid = image.add(1).log10().getMapId(options)
        else:
          mapid = image.getMapId(options)
        ##print("Appending "+config.getMonth(i))
        layers.append({
          'lng': lng,
          'lat': lat,
          'mapid': mapid['mapid'],
          'token': mapid['token'],
          'type': 'collection',
          'zoom': zoom,
          'name': config.getMonth(i),
          'unidad': unidad,
          'style': style,
          'columna': columna,
          'password': password
        })
    ##print(layers)
    self.response.out.write(json.dumps(layers))

class GetMapOper(webapp2.RequestHandler):
  def get(self):
    idm1 = str(self.request.get('mapid1'))
    idm2 = str(self.request.get('mapid2'))
    oper = str(self.request.get('oper'))
    bd=str(self.request.get('bd'))
    url1 = config.baseURL+'getMapData.php?idCapa='+idm1+'&bd='+bd
    url2 = config.baseURL+'getMapData.php?idCapa='+idm2+'&bd='+bd
    try:
      result1 = urllib2.urlopen(url1)
      result2 = urllib2.urlopen(url2)
      r1=result1.read()
      r2=result2.read()
      row = json.loads(r1)
      name1 = str(row[0])
      tipo1 = str(row[9])
      lat = float(row[1])
      lng = float(row[2])
      zoom = int(row[3])
      columna1 = str(row[4])
      style1 = str(row[6])
      unidad = str(row[8])
      row2 = json.loads(r2)
      name2 = str(row2[0])
      columna2 = str(row2[4])
      style2 = str(row2[6])
      tipo2 = str(row2[9])
    except urllib2.URLError:
      logging.exception('Caught exception fetching url')
    ee.Initialize(config.EE_CREDENTIALS)
    layers = [] 
    image1 = ee.Image(''+name1)
    image2 = ee.Image(''+name2)
    minV1,maxV1,colors = config.getMinMaxColors(style1,columna1)
    minV2,maxV2,colors2 = config.getMinMaxColors(style2,columna2)
    if tipo1 == 'tiff':
       image1 = ee.Image(''+name1)
    else:
       columnaAux = columna1.split(',')
       temp = ee.FeatureCollection('ft:'+name1)
       image1 = temp.reduceToImage([columnaAux[1]], ee.Reducer.first())
    if tipo2 == 'tiff':
       image2 = ee.Image(''+name2)
    else:
       columnaAux = columna2.split(',')
       temp = ee.FeatureCollection('ft:'+name2)
       image2 = temp.reduceToImage([columnaAux[1]], ee.Reducer.first())
    if oper == '1':
       image3 = image1.subtract(image2)
       if maxV1 > maxV2:
          maxV = maxV1
       else:
          maxV = maxV2
       options = {
          'palette': colors,
          'min': -maxV,
          'max': maxV,
          'format':'png'
       }
    else:
       image3 = image1.And(image2)
       maxV = maxV1
       minV = minV1
       options = {
          'palette': colors,
          'min': minV,
          'max': maxV,
          'format':'png'
       }
    mapid = image3.getMapId(options)
    layers.append({
      'lng': lng,
      'lat': lat,
      'unidad': unidad,
      'mapid': mapid['mapid'],
      'token': mapid['token'],
      'type': 'image',
      'zoom': zoom,
      'name': 'Diff'
    })
    self.response.out.write(json.dumps(layers))

class GetStadistics(webapp2.RequestHandler):
  def post(self):    
    self.response.headers.add_header('Access-Control-Allow-Origin', '*')
    ee.Initialize(config.EE_CREDENTIALS)
    idm = str(self.request.get('mapid'))
    print ('MapID', idm) #HGG
    print ('NombreCapa', str(self.request.get('nombreCapa')) ) #HGG
    coords = str(self.request.get('coords'))
    isImage = int(self.request.get('isImage'))
    pais = str(self.request.get('pais'))
    randomFeatures = str(self.request.get('randomFeatures'))
    usoSueloStr = str(self.request.get('usoSuelo'))
    usarANP = int(self.request.get('usarANP'))
    usarPen = int(self.request.get('usarPen'))
    usarBuffer = int(self.request.get('usarBuffer'))
    anpStr = str(self.request.get('anp'))
    pendienteStr = str(self.request.get('pendiente'))
    bufferMaxStr = str(self.request.get('bufferMaxStr'))
    bufferMinStr = str(self.request.get('bufferMinStr'))
    typeP = int(self.request.get('typeP'))
    mapidI = str(self.request.get('mapidI'))
    nCorridas = int(self.request.get('nCorridas'))
    layers = []    
    if typeP == 0:
      exec("coords="+coords)      
      polygon = ee.Geometry.Polygon(coords)	  
    else:
      tabla = str(self.request.get('tabla'))
      llave1 = str(self.request.get('llave1'))
      llave2 = str(self.request.get('llave2'))
      valor1 = str(self.request.get('valor1'))
      valor2 = str(self.request.get('valor2'))
      #print llave1,valor1,llave2,valor2
      polygon = getPolygonFF(tabla,llave1,llave2,valor1,valor2)
      #print polygon
    print 'AREA'
    print polygon.area().getInfo()
    area = polygon.area().divide(1000*1000).getInfo()
    bd=str(self.request.get('bd'))
    #idBD=str(config.getIDBD(bd))
    url = config.baseURL+'getMapData.php?idCapa='+idm+'&bd='+bd
    try:
      result = urllib2.urlopen(url)
      r=result.read()
      row = json.loads(r)
      name = str(row[0])
      name2 = str(row[7])
      columna = str(row[4])
      style = str(row[6])
      unidades = str(row[8])
      escalaLog = int(row[10])
      print 'Apenas regresando de getMapData'
      print columna
    except urllib2.URLError:
      print url
    global incertidumbre
    global meanInc
    print name2
    nameI = "None"
    if mapidI != -1:
      url = config.baseURL+'getMapData.php?idCapa='+mapidI+'&bd='+bd
      try:
        result = urllib2.urlopen(url)
        r=result.read()
        row = json.loads(r)
        nameI = str(row[0])      
      except urllib2.URLError:
        print url
    conversion=0
    reArea = 0
    tempCat = str(self.request.get('categoria'))
	#print tempCat
    exec("categorias = "+tempCat)
    resmask = polygon
    #if area > 1000000:
    #  randomFeatures = randomFeatures.replace('true','True')
    #  exec("temp = "+randomFeatures)
    #  resMask = ee.FeatureCollection(temp)
    #  reArea = len(temp)
    #isImage = 0
    #add db things instead of recieve all the names
    if isImage == 0:
      print 'image 0 HGG' #HGG
      minV,maxV,colors = config.getMinMaxColors(style,columna)
      image = ee.Image(''+name)
      #emptyImage = ee.Image('LANDSAT/LC08/C01/T1/LC08_044034_20140318') #HGG
      conversionT = image.get("conversion").getInfo()
      resolutionT = image.get("resolution").getInfo()      
      unity = image.get("unity").getInfo()  
      resolutionTT = 1
      unityT = 1	        
      # print "Resolucion: ",resolutionT, ", Unidad: ",unity      
      if resolutionT is not None:
        resolutionTT = resolutionT
      if unity is not None:
        unityT = unity
      #print resolutionTT,unityT
      if resolutionT is None or unity is None:
        resolutionTT = 1
        unityT = 1
      if conversionT is None:
        conversion = 0
      else:
        conversion = conversionT      
      # print resolutionTT,unity
      resolution = ee.Number(resolutionTT)
      unity = ee.Number(unityT)      
      value = resolution.pow(2).divide(unity.pow(2))      
      image = image.clip(polygon)
      #emptyImage = emptyImage.clip(polygon) #HGG
      image = image.updateMask(image.gte(minV).And(image.lte(maxV)))
      image = image.multiply(value)
      if usoSueloStr != '' and categorias[0] != -1:
        usoSuelo = ee.Image(usoSueloStr)
        categoriasStr = ""
        categoriasStrEnd = ""
        for categoria in categorias:
           categoriasStr+="usoSuelo.eq("+str(categoria)+").Or("
           categoriasStrEnd+=")"           
        restriccion = categoriasStr[:-4]+categoriasStrEnd[:-1]
        exec("image = image.updateMask("+restriccion+")")
      if usarANP == 1 and anpStr != '':        
        anp = ee.Image(anpStr)
        usarT = anp.get("usar").getInfo()
        if usarT is None:
           usarN = 0
        else:
           usarN = int(usarT)
        image = image.updateMask(anp.eq(usarN))
      # if usarPen == 1 and pendienteStr != '':
      if usarPen != -1 and pendienteStr != '':  
        pendiente = ee.Image(pendienteStr)
        usarT = pendiente.get("usar").getInfo()
        if usarT is None:
           usarN = 0
        else:
           usarN = int(usarT)
        image = image.updateMask(pendiente.eq(usarN))
      if usarBuffer == 2 and bufferMaxStr != '':
        bufferMax = ee.Image(bufferMaxStr)        
        usarT = bufferMax.get("usar").getInfo()
        if usarT is None:
           usarN = 1
        else:
           usarN = int(usarT)
        image = image.updateMask(bufferMax.eq(usarN))
      if usarBuffer == 1 and bufferMinStr != '':
        bufferMin = ee.Image(bufferMinStr)
        usarT = bufferMin.get("usar").getInfo()
        if usarT is None:
           usarN = 1
        else:
           usarN = int(usarT)
        image = image.updateMask(bufferMin.eq(usarN))
      sumaMC = 0
      sumaMCDev = 0
      desvInc = 0
      if nameI != "None":
        incertidumbre = ee.Image(nameI)
#        lista = ee.List.sequence(1,nCorridas)
#        lista = ee.List.sequence(1,1)
#        sumas = []
#        for i in range(nCorridas):
#        for i in range(1):          
#          sumas.append(randomize(image, incertidumbre, resmask))
#        sumaMC = sum(sumas)/len(sumas)
        #print sumaMC
        #print sumas
        #sumaMCDev = np.std(np.array(sumas))
#        acumulate = 0
#        for i in sumas:
#          acumulate += (i-sumaMC)**2
#        acumulate = acumulate/len(sumas)
#        sumaMCDev = acumulate**0.5
#        dev = incertidumbre.divide(100).multiply(image)
#        bio2 = image.pow(2)
#        dev2 = dev.pow(2)
        tempMul = image.multiply(incertidumbre).divide(100)
        sumaMC = tempMul.reduceRegion(ee.Reducer.sum(),resmask,None,None,None,True,1e10).getInfo()['b1'] #HGG best effort
      print 'sumaMC'
      print sumaMC 
      suma = image.reduceRegion(ee.Reducer.sum(),resmask,None,None,None,True,1e10).getInfo()['b1'] #HGG best effort
      print 'suma'
      print suma      
      mean = image.reduceRegion(ee.Reducer.mean(),resmask,None,None,None,True,1e10).getInfo()['b1'] #HGG best effort
      print 'mean'
      print mean
      max_ = image.reduceRegion(ee.Reducer.max(),resmask,None,None,None,True,1e10).getInfo()['b1'] #HGG best effort
      min_ = image.reduceRegion(ee.Reducer.min(),resmask,None,None,None,True,1e10).getInfo()['b1'] #HGG best effort
      stdDev = image.reduceRegion(ee.Reducer.stdDev(),resmask,None,None,None,True,1e10).getInfo()['b1'] #HGG best effort
      count = image.reduceRegion(ee.Reducer.count(),resmask,None,None,None,True,1e10).getInfo()['b1'] #HGG best effort
      print 'count1'
      print count
      #suma = suma/count#*area/areaMunicipio HGG try
      if escalaLog == 1:
        from math import log10
        maxV = log10(max_)
        if minV == 0:
          minV = log10(min_+1)
        else:
          minV = log10(min_)
        image = image.add(1).log10()
      options = {
        'palette': colors,
        'min': minV,
        'max': maxV,
        'format':'png'
      }
      mapid = image.getMapId(options)
      print 'mapid HGG'
      print mapid #HGG
      layers.append({
        'sum':suma,
        'desvInc':desvInc,
        'sumMC':sumaMC,
        'sumMCDev':sumaMCDev,
        'mean':mean,
        'max':max_,
        'min':min_,
        'stdDev':stdDev,
        'area': area,
        'reArea': reArea,
        'tipo': 'tiff',
        'mapid': mapid['mapid'],
        'token': mapid['token'],
        'conversion': conversion,
        'areaPix': count,
        'resolution': resolutionT,
        'unidades': unidades
      })
    else:
      print 'Aqui entra la demanda' #HGG
      columnaAux = columna.split(',') ##Iniciaba antes
      indexCol = 1 #HGG
      table = ee.FeatureCollection(name2).filterBounds(resmask)
      suma = table.reduceColumns(ee.Reducer.sum(), [columnaAux[indexCol]]).getInfo()['sum']
      mean = table.reduceColumns(ee.Reducer.mean(),[columnaAux[indexCol]]).getInfo()['mean']
      max_ = table.reduceColumns(ee.Reducer.max(), [columnaAux[indexCol]]).getInfo()['max']
      min_ = table.reduceColumns(ee.Reducer.min(), [columnaAux[indexCol]]).getInfo()['min']
      stdDev = table.reduceColumns(ee.Reducer.stdDev(),[columnaAux[indexCol]]).getInfo()['stdDev']
      layers.append({
        'sum':suma,
        'mean':mean,
        'max':max_,
        'min':min_,
        'stdDev':stdDev,
        'area': area,
        'reArea': reArea,
        'tipo': 'table',
        'conversion': conversion,
        'unidades': unidades
      })
    self.response.out.write(json.dumps(layers))

class GetUsoSuelo(webapp2.RequestHandler):
  def post(self): 
    self.response.headers.add_header('Access-Control-Allow-Origin', '*')
    ee.Initialize(config.EE_CREDENTIALS)
    pais = str(self.request.get('pais'))
    bd=str(self.request.get('bd'))
    url = ""
    if self.request.get('idPais'):
      idPais = str(self.request.get('idPais'))
      if bd == 'cemie2':
        url = config.baseURL+'getMapCountry2.php?idPais='+idPais+'&bd='+bd
      else:
        url = config.baseURL+'getMapCountry.php?idPais='+idPais+'&bd='+bd 
      print "primer caso uso suelo", "url: ", url
    else: 
      url = config.baseURL+'getMapCountry.php?url='+pais+'&bd='+bd
      print "segundo caso uso suelo", "bd: ", bd    
    typeP=int(self.request.get('type'))
    #url = config.baseURL+'getMapCountry.php?url='+pais+'&bd='+bd
    listaUsos = []
    if bd == "probiomasa":
      self.response.out.write(json.dumps(listaUsos))
      return
    listaUsos.append([])
    listaUsos.append([])
    listaUsos.append([])
    listaUsos.append([])
    listaUsos.append([])
    listaUsos.append([])
    listaUsos.append([])
    try:
      result = urllib2.urlopen(url)
      r=result.read()
      row = json.loads(r)
      if row[0] is None:
        self.redirect("/");
        return None
      idPais = str(row[5])
      usoSueloStr = str(row[4])
      pendienteStr = str(row[15])
      anpStr = str(row[16])
      bufferMaxStr = str(row[17])
      bufferMinStr = str(row[18])
    except urllib2.URLError:
      logging.exception('Caught exception fetching url')
    if bd == 'cemie2':
      url = config.baseURL+'getUsoSuelo2.php?idPais='+idPais+'&bd='+bd
    else:
      url = config.baseURL+'getUsoSuelo.php?idPais='+idPais+'&bd='+bd
    try:
      result = urllib2.urlopen(url)
      r=result.read()
      row = json.loads(r)           
      usosSuelo = row
    except urllib2.URLError:
      logging.exception('Caught exception fetching url')    
    if typeP == 0:
      coords = str(self.request.get('coords'))    
      exec("coords="+coords)
      polygon = ee.Geometry.Polygon(coords)
    else:
      tabla = str(self.request.get('tabla'))
      llave1 = str(self.request.get('llave1'))
      llave2 = str(self.request.get('llave2'))
      valor1 = str(self.request.get('valor1'))
      valor2 = str(self.request.get('valor2'))
      #print llave1,valor1,llave2,valor2
      polygon = getPolygonFF(tabla,llave1,llave2,valor1,valor2)
      #print polygon
    area = polygon.area().divide(1000*1000).getInfo()
    if area > 500000000:
       coords = list(reversed(coords))
       polygon = ee.Geometry.Polygon(coords)
       area = polygon.area().divide(1000*1000).getInfo()
    #if area > 1000000:
    #  randomPoints = 10000
    #  if area > 10000000:
    #    randomPoints = 10000
    #  resMask = ee.FeatureCollection.randomPoints(polygon,int(randomPoints))
    #  randomFeatures = resMask.getInfo()
    #  listaUsos[0].append(randomFeatures)
    if usoSueloStr != 'None':
      usoSuelo = ee.Image(usoSueloStr)
      resmask = polygon
      usoSuelo = usoSuelo.clip(resmask)
      temp = usoSuelo.reduceRegion(ee.Reducer.autoHistogram(),resmask,None,None,None,True,1e10).getInfo()["b1"] #HGG best effort
      for f in temp:
        if f[1] != 0:
          descripcion = config.getDescripcionUsoSuelo(f[0], usosSuelo)
          if descripcion != "-1":
            listaUsos[1].append(str(f[0])+"->"+descripcion)
      listaUsos[1] = sorted(listaUsos[1])
      listaUsos[1].insert(0,'-1->Ninguno')
      listaUsos[2].append(usoSueloStr)
    if anpStr != 'None':
      listaUsos[3].append(anpStr)
    if pendienteStr != 'None':
      listaUsos[4].append(pendienteStr)
    if bufferMaxStr != 'None':
      listaUsos[5].append(bufferMaxStr)
    if bufferMinStr != 'None':
      listaUsos[6].append(bufferMinStr)
    self.response.out.write(json.dumps(listaUsos))

class GetFacilityLocation(webapp2.RequestHandler):
  def get(self):
    ee.Initialize(config.EE_CREDENTIALS)
    pais = str(self.request.get('pais'))
    idm = str(self.request.get('mapid'))
    bd=str(self.request.get('bd'))
    typeP=int(self.request.get('type'))    
    url = config.baseURL+'getMapData.php?idCapa='+idm+'&bd='+bd   
    try:
      result = urllib2.urlopen(url)
      r=result.read()
      row = json.loads(r)
      name = str(row[0])
    except urllib2.URLError, e:
      #print url
      return    
    if typeP == 0:
      coords = str(self.request.get('coords'))    
      exec("coords="+coords)
      polygon = ee.Geometry.Polygon(coords)
    else:
      tabla = str(self.request.get('tabla'))
      llave1 = str(self.request.get('llave1'))
      llave2 = str(self.request.get('llave2'))
      valor1 = str(self.request.get('valor1'))
      valor2 = str(self.request.get('valor2'))
      polygon = getPolygonFF(tabla,llave1,llave2,valor1,valor2)
    #do stuffs 
    #import time
    #fileName = time.strftime("%d%m%Y%H%M%S")
    #file = open("/home/cserver/tmp/"+fileName+".txt","w")
    #file.write("test")
    #file.close()
    #respuesta = [1, name]
    self.response.out.write(json.dumps([]))
	
class GetInfo(webapp2.RequestHandler):
  def get(self):
     self.response.out.write(json.dumps([]))

class GetMapPassword(webapp2.RequestHandler):
  def get(self):    
    self.response.headers.add_header('Access-Control-Allow-Origin', '*')
    idm = str(self.request.get('mapid'))
    bd=str(self.request.get('bd'))
    url = config.baseURL+'getMapPassword.php?idCapa='+idm+'&bd='+bd
    try:
      result = urllib2.urlopen(url)
      r=result.read()
      row = json.loads(r)
      password=str(row[0])
    except urllib2.URLError, e:
      #print url
      return
    layers=[]
    layers.append({
      'password': password
    })
    self.response.out.write(json.dumps(layers))

class GetStability(webapp2.RequestHandler):
  def get(self):
    self.response.headers.add_header('Access-Control-Allow-Origin', '*')
    ee.Initialize(config.EE_CREDENTIALS)
    idAnp = int(self.request.get('anp'))
    ft = str(self.request.get('ft'))
    capa = str(self.request.get('capa'))
    capa1 = 'users/ranyartrodrigo/estabilidad/Mask_mx_eccb'
    # acceder a la FT de anps
    anp = ee.FeatureCollection("ft:"+ft)
    # realizar el recorte del poligono correspondiente al ANP
    # polygon = anp.filter(ee.Filter.eq("OBJECTID",idAnp))
    polygon = anp.filter(ee.Filter.eq("CVE_ENT",idAnp))
    # instanciar las capas
    image = ee.Image(capa)
    image1 = ee.Image(capa1)
    # realizar los calculos
    unos = image.reduceRegion(ee.Reducer.autoHistogram(), polygon, 1000)
    # print("unos calculados: ", unos.getInfo())
    if unos.getInfo()["b1"] == None:
      unos = 0
    else:
      unos = unos.getInfo()["b1"][0][1]
    ceros = image1.reduceRegion(ee.Reducer.autoHistogram(), polygon, 1000).getInfo()["b1"][0][1]
    # print("unos: ", unos)
    # print("ceros: ", ceros)
    self.response.out.write(json.dumps([unos, ceros]))

    

class GetMannKendall(webapp2.RequestHandler):
  def get(self):
    self.response.headers.add_header('Access-Control-Allow-Origin', '*')
    ee.Initialize(config.EE_CREDENTIALS)
    # pol = int(self.request.get('pol'))
    # metadata = str(self.request.get('metadata'))
    # exec("polygon="+metadata)
    # polygonClimate = ee.Geometry.Polygon(polygon)
    # result = []
    idAnp = int(self.request.get('anp'))
    ft = str(self.request.get('ft'))
    image = ee.Image('users/ranyartrodrigo/mannKendall/Tmean_rcp85Sum_tau')
    anp = ee.FeatureCollection("ft:"+ft)
    # realizar el recorte del poligono correspondiente al ANP
    polygon = anp.filter(ee.Filter.eq("OBJECTID",idAnp))
    # image = image.filterBounds(polygonClimate)
    # region = image.reduceRegion(ee.Reducer.autoHistogram(),polygonClimate,1000).getInfo()["b1"]
    region = image.reduceRegion(ee.Reducer.toList(),polygon,1000).getInfo()["b1"]
    # print('region: ', region)
    self.response.out.write(json.dumps(region))

class GetClimateData(webapp2.RequestHandler):
  def promedio(image):
    return image.reduce(ee.Reducer.mean())
  def get(self):    
    self.response.headers.add_header('Access-Control-Allow-Origin', '*')
    ee.Initialize(config.EE_CREDENTIALS)
    pol = int(self.request.get('pol'))
    variable = int(self.request.get('variable'))
    metadata = str(self.request.get('metadata'))
    temporada = int(self.request.get('idTemporada'))
    lista = config.getListName(variable)
    anpStr = "";
    if self.request.get('anpstr'):
      anpStr = str(self.request.get('anpstr'))
    else:
	  anpStr = "1BE5n-CAhAl601hgEyX5ZvW1IsNN3T7g48y_ylqQb"
    exec('lista = '+lista)
    layers=[]
    anp = ee.FeatureCollection("ft:"+anpStr)
    if pol == 0:
      exec("idAnps="+metadata)
      i = 0      
      for idAnp in idAnps:
        layers.append([])
        polygonClimate = anp.filter(ee.Filter.eq("OBJECTID",idAnp))		
        for name in lista:
          if variable >= 6 and variable <= 11 or variable == 15:
              imageMean = ee.Image(name)
          else:
              image = ee.ImageCollection(name)
              image = image.filterBounds(polygonClimate)
              listAux = image.toList(12)
              if ("CNR" in name or "HAD" in name or "MPI" in name or "GFD" in name) and temporada != 1:
                if variable != 5:
                   ind=config.getPeriod2(temporada)
                   listAux = ee.List([listAux.get(ind[0]),listAux.get(ind[1]),listAux.get(ind[2])])                   
                else:
                   if "CNR" in name:                   
                     ind=config.getPeriod2(temporada)
                     listAux = ee.List([listAux.get(ind[0]),listAux.get(ind[1]),listAux.get(ind[2])])
                   elif "HAD" in name:
                     ind=config.getPeriod(temporada)
                     listAux = listAux.slice(ind[0],ind[1])
                   elif "MPI" in name:
                     if "p6" in name and "8.5" in name:
                       ind=config.getPeriod2(temporada)
                       listAux = ee.List([listAux.get(ind[0]),listAux.get(ind[1]),listAux.get(ind[2])])
                     else:
                       ind=config.getPeriod(temporada)
                       listAux = listAux.slice(ind[0],ind[1])
                   else:
                     if "8.5" in name and ("p4" in name or "p6" in name):
                       ind=config.getPeriod(temporada)
                       listAux = listAux.slice(ind[0],ind[1])
                     else:
                       ind=config.getPeriod2(temporada)
                       listAux = ee.List([listAux.get(ind[0]),listAux.get(ind[1]),listAux.get(ind[2])])
              else:
                ind=config.getPeriod(temporada)
                listAux = listAux.slice(ind[0],ind[1])
              image = ee.ImageCollection.fromImages(listAux)
              if variable == 2:
                imageMean = image.sum()
              elif variable == 3 or variable == 4 or variable == 12 or variable == 13:
                # imageMean = image.map(promedio).max()
                if temporada == 1:
                   num = 12
                else:
                   num = 3
                listaMax = []
                for ii in range(num):
                   imagenI = ee.Image(listAux.get(ii))
                   listaMax.append(imagenI.reduceRegion(ee.Reducer.mean(), polygonClimate, 1000).getInfo()["b1"])
                if variable == 3 or variable == 12:
                   indice = listaMax.index(max(listaMax))
                else:
                   indice = listaMax.index(min(listaMax))
                # print('Lista: ', listaMax)
                # print('IndiceMAx: ', indice)
                # print('Name: ', name)
                imageMean = ee.Image(listAux.get(indice))
              else:
                imageMean = image.mean()
          if variable == 6 or variable == 7:
            t=imageMean.reduceRegion(ee.Reducer.mode(),polygonClimate,1000).getInfo()["b1"]
          elif variable == 8 or variable == 9 or variable == 15 or variable == 14 or variable == 12 or variable == 13:
	        t=imageMean.reduceRegion(ee.Reducer.mean(),polygonClimate,1000).getInfo()["b1"]
          elif variable == 10 or variable == 11:
	        t=imageMean.reduceRegion(ee.Reducer.median(),polygonClimate,1000).getInfo()["b1"]          
          else:
            t=imageMean.reduceRegion(ee.Reducer.autoHistogram(),polygonClimate,1000).getInfo()["b1"]
          datos = []
          if t is None:
            layers[i].append(datos)
            continue
          if variable >= 6 and variable <= 13:
            layers[i].append(t)
          else:          
            for x in range(0, len(t)):
              if round(t[x][1]) != 0:                
                datos.append(str(t[x][0])+"x"+str(round(t[x][1])))
            layers[i].append(datos)
        i = i + 1
    elif pol == 1:
      exec("idEnt="+metadata)
      i = 0
      ft = ee.FeatureCollection("ft:1CHafYvXodZoBmN-eDN74OBHZ5sQZfc2JfZwGDdYf")
      for idAnp in idEnt:
        layers.append([])
        polygonClimate = ft.filter(ee.Filter.eq("CVE_ENT",idAnp))        
        pols = anp.filterBounds(polygonClimate);
        listaT = pols.toList(176)
        t = listaT.getInfo()
        idsANP = []
        for j in range(len(t)):
          idsANP.append(t[j]["properties"]["OBJECTID"])
        for name in lista:
          if variable >= 6 and variable <= 11 or variable == 15:
              imageMean = ee.Image(name)
          else:
              image = ee.ImageCollection(name)
              image = image.filterBounds(polygonClimate)
              listAux = image.toList(12)
              if ("CNR" in name or "HAD" in name or "MPI" in name or "GFD" in name) and temporada != 1:
                if variable != 5:
                   ind=config.getPeriod2(temporada)
                   listAux = ee.List([listAux.get(ind[0]),listAux.get(ind[1]),listAux.get(ind[2])])                   
                else:
                   if "CNR" in name:                   
                     ind=config.getPeriod2(temporada)
                     listAux = ee.List([listAux.get(ind[0]),listAux.get(ind[1]),listAux.get(ind[2])])
                   elif "HAD" in name:
                     ind=config.getPeriod(temporada)
                     listAux = listAux.slice(ind[0],ind[1])
                   elif "MPI" in name:
                     if "p6" in name and "8.5" in name:
                       ind=config.getPeriod2(temporada)
                       listAux = ee.List([listAux.get(ind[0]),listAux.get(ind[1]),listAux.get(ind[2])])
                     else:
                       ind=config.getPeriod(temporada)
                       listAux = listAux.slice(ind[0],ind[1])
                   else:
                     if "8.5" in name and ("p4" in name or "p6" in name):
                       ind=config.getPeriod(temporada)
                       listAux = listAux.slice(ind[0],ind[1])
                     else:
                       ind=config.getPeriod2(temporada)
                       listAux = ee.List([listAux.get(ind[0]),listAux.get(ind[1]),listAux.get(ind[2])])
              else:
                ind=config.getPeriod(temporada)
                listAux = listAux.slice(ind[0],ind[1])
              image = ee.ImageCollection.fromImages(listAux)
              if variable == 2:
                imageMean = image.sum()
              elif variable == 3 or variable == 4 or variable == 12 or variable == 13:
                # imageMean = image.map(promedio).max()
                if temporada == 1:
                   num = 12
                else:
                   num = 3
                listaMax = []
                for ii in range(num):
                   imagenI = ee.Image(listAux.get(ii))
                   listaMax.append(imagenI.reduceRegion(ee.Reducer.mean(), polygonClimate, 1000).getInfo()["b1"])
                if variable == 3 or variable == 12:
                   indice = listaMax.index(max(listaMax))
                else:
                   indice = listaMax.index(min(listaMax))
                # print('Lista: ', listaMax)
                # print('IndiceMAx: ', indice)
                # print('Name: ', name)
                imageMean = ee.Image(listAux.get(indice))
              else:
                imageMean = image.mean()
          if variable == 6 or variable == 7:
            t=imageMean.reduceRegion(ee.Reducer.mode(),polygonClimate,1000).getInfo()["b1"]
          elif variable == 8 or variable == 9 or variable == 15 or variable == 14 or variable == 12 or variable == 13:
	        t=imageMean.reduceRegion(ee.Reducer.mean(),polygonClimate,1000).getInfo()["b1"]
          elif variable == 10 or variable == 11:
	        t=imageMean.reduceRegion(ee.Reducer.median(),polygonClimate,1000).getInfo()["b1"]          
          else:
            t=imageMean.reduceRegion(ee.Reducer.autoHistogram(),polygonClimate,1000).getInfo()["b1"]
          datos = []
          if t is None:
            layers[i].append(datos)
            continue
          if variable >= 6 and variable <= 13:
            layers[i].append(t)
          else:          
            for x in range(0, len(t)):
              if round(t[x][1]) != 0:                
                datos.append(str(t[x][0])+"x"+str(round(t[x][1])))
            layers[i].append(datos)
        i = i + 1
    else:
      i = 0	
      exec("polygon="+metadata)
      polygonClimate = ee.Geometry.Polygon(polygon)
      layers.append([])
      layers.append([])
      # pols = anp.filterBounds(polygonClimate);
      # listaT = pols.toList(176)
      # t = listaT.getInfo()
      idsANP = []
      # for j in range(len(t)):
        # idsANP.append(t[j]["properties"]["OBJECTID"])
      for name in lista:
        if variable >= 6 and variable <= 11 or variable == 15:
            imageMean = ee.Image(name)
        else:
            image = ee.ImageCollection(name)
            image = image.filterBounds(polygonClimate)
            listAux = image.toList(12)
            if ("CNR" in name or "HAD" in name or "MPI" in name or "GFD" in name) and temporada != 1:
              if variable != 5:
                 ind=config.getPeriod2(temporada)
                 listAux = ee.List([listAux.get(ind[0]),listAux.get(ind[1]),listAux.get(ind[2])])                   
              else:
                 if "CNR" in name:                   
                   ind=config.getPeriod2(temporada)
                   listAux = ee.List([listAux.get(ind[0]),listAux.get(ind[1]),listAux.get(ind[2])])
                 elif "HAD" in name:
                   ind=config.getPeriod(temporada)
                   listAux = listAux.slice(ind[0],ind[1])
                 elif "MPI" in name:
                   if "p6" in name and "8.5" in name:
                     ind=config.getPeriod2(temporada)
                     listAux = ee.List([listAux.get(ind[0]),listAux.get(ind[1]),listAux.get(ind[2])])
                   else:
                     ind=config.getPeriod(temporada)
                     listAux = listAux.slice(ind[0],ind[1])
                 else:
                   if "8.5" in name and ("p4" in name or "p6" in name):
                     ind=config.getPeriod(temporada)
                     listAux = listAux.slice(ind[0],ind[1])
                   else:
                     ind=config.getPeriod2(temporada)
                     listAux = ee.List([listAux.get(ind[0]),listAux.get(ind[1]),listAux.get(ind[2])])
            else:
              ind=config.getPeriod(temporada)
              listAux = listAux.slice(ind[0],ind[1])
            image = ee.ImageCollection.fromImages(listAux)
            if variable == 2:
              imageMean = image.sum()
            elif variable == 3 or variable == 4 or variable == 12 or variable == 13:
              # imageMean = image.map(promedio).max()
              if temporada == 1:
                 num = 12
              else:
                 num = 3
              listaMax = []
              for ii in range(num):
                 imagenI = ee.Image(listAux.get(ii))
                 listaMax.append(imagenI.reduceRegion(ee.Reducer.mean(), polygonClimate, 1000).getInfo()["b1"])
              if variable == 3 or variable == 12:
                 indice = listaMax.index(max(listaMax))
              else:
                 indice = listaMax.index(min(listaMax))
              # print('Lista: ', listaMax)
              # print('IndiceMAx: ', indice)
              # print('Name: ', name)
              imageMean = ee.Image(listAux.get(indice))
            else:
              imageMean = image.mean()
        if variable == 6 or variable == 7:
          t=imageMean.reduceRegion(ee.Reducer.mode(),polygonClimate,1000).getInfo()["b1"]
        elif variable == 8 or variable == 9 or variable == 15 or variable == 14 or variable == 12 or variable == 13:
	      t=imageMean.reduceRegion(ee.Reducer.mean(),polygonClimate,1000).getInfo()["b1"]
        elif variable == 10 or variable == 11:
	      t=imageMean.reduceRegion(ee.Reducer.median(),polygonClimate,1000).getInfo()["b1"]          
        else:
          t=imageMean.reduceRegion(ee.Reducer.autoHistogram(),polygonClimate,1000).getInfo()["b1"]
        datos = []
        if t is None:
          layers[i].append(datos)
          continue
        if variable >= 6 and variable <= 13:
          layers[i].append(t)
        else:          
          for x in range(0, len(t)):
            if round(t[x][1]) != 0:                
              datos.append(str(t[x][0])+"x"+str(round(t[x][1])))
          layers[i].append(datos)        
      layers[1].append({'idsANP':idsANP})
    self.response.out.write(json.dumps(layers))

class ExportData(webapp2.RequestHandler):
  def get(self):
    ee.Initialize(config.EE_CREDENTIALS)
    landsat = ee.Image('LANDSAT/LC8_L1T_TOA/LC81230322014135LGN00').select(['B4', 'B3', 'B2'])
    llx = 116.2621
    lly = 39.8412
    urx = 116.4849
    ury = 40.01236
    geometry = [[llx,lly], [llx,ury], [urx,ury], [urx,lly]]
    task_config = {
      'description': 'imageToDriveExample',
      'scale': 30,  
      'region': geometry
    }
    task = ee.batch.Export.image(landsat, 'exportExample', task_config)   
    task.start()
    while task.active():
      time.sleep(10)
    self.response.out.write(json.dumps(["OK"]))

def updateMinMax(imageT):
  return imageT.updateMask(imageT.gte(minVG).And(imageT.lte(maxVG)))

def randomize(biomasa, incertidumbre, resmask):
  import time
  import math
  timestamp = int(round(time.time() * 1000))
  u = ee.Image.random(timestamp)
  v = ee.Image.random(timestamp+1)
  random =  u.log().multiply(-2).sqrt().multiply(v.multiply(2*math.pi).cos())
  random = random.reproject("EPSG:4326",[0.0008888799999999999,0,-117.1289176,0,-0.0008888799999999999,32.96624256])
  temp = biomasa.multiply(incertidumbre).divide(100)
  random = random.multiply(temp).add(biomasa)
  random = random.expression("(b('random') < 0) ? 0:b('random')")
  random = random.updateMask(biomasa)
  random = random.clip(resmask)
  sum = ee.Image(random).reduceRegion(ee.Reducer.sum(),None,None,None,None,False,1e15).getInfo()["random"]
  return sum  

def devximage(image):
  diff = ee.Image(image)
  diff = image.subtract(meanInc).pow(2)
  return diff

def getPolygonFF(tabla, llave1, llave2, valor1, valor2):   
   if llave1 == "ROWID":
     llave1 = "system:index"   
   valor1,isArray = config.getValueLV(llave1,valor1)
   valor2,isArray2 = config.getValueLV(llave2,valor2)   
   ft = ee.FeatureCollection('ft:'+tabla)   
   if valor1 != -1 and valor2 == -1:     
     if isArray == 0:
        ft = ft.filter(ee.Filter.eq(llave1,valor1))
     else:
        ft = ft.filter(ee.Filter.inList(llave1,valor1))
   if valor1 == -1 and valor2 != -1:
     if isArray2 == 0:
        ft = ft.filter(ee.Filter.eq(llave1,valor2))
     else:
        #ft = ft.filter(ee.Filter.And(ee.Filter.eq(llave1,valor1),ee.Filter.equals(llave2,valor2[0])))
        ft = ft.filter(ee.Filter.inList(llave1,valor2))
   return ft.geometry()

def iterate(imageI,list):
  image = ee.Image(imageI)
  sum = image.reduceRegion(ee.Reducer.sum(),resmask,None,None,None,False,1e15)
  return ee.List(list).add(sum)

minVG = maxVG = colorsG = meanInc = None

app = webapp2.WSGIApplication([
    (r'/', MainPage),
    #(r'/testmenus', TestMenus),
    (r'/google5f83ec30cc8bae09.html', google),
    (r'/test/([1-2])/([0-9 ]+)', test),
	(r'/courses/?(\w+)?',Courses),
    (r'/courses/(\w+)/(\w+)',SubCourses),	
    (r'/conabio/([0-9]+)',DemoPages),
    #(r'/conabio/([0-9]+)/(\w+)',DemoPagesMap),
    (r'/cemie',RedirectCemie),
    (r'/cemie/([a-zA-Z]+)', RedirectCemieMap),	
    (r'/cemie/([0-9]+)',VersionCemie), 
    (r'/cemie/([0-9]+)/([a-zA-Z]+)',MapCemie),
    #(r'/conabio',SubPages),
    (r'/probiomasa',SubPages),
    (r'/sicabioenergy',SubPages),
    (r'/cepalplayground',SubPages),
    (r'/lae',SubPages),
    (r'/lae/(\w+)', Map),
    (r'/probiomasa/(\w+)', Map),    
    (r'/conabio/(\w+)', Map),
    (r'/sicabioenergy/(\w+)', Map),
    (r'/cepalplayground/(\w+)', Map),
    (r'/test([0-9a-zA-Z]+)?', TestPage),
    (r'/getmapdata', GetMapData),
    (r'/exportdata', ExportData),
    (r'/getmappassword',GetMapPassword), 
    (r'/getstadistics', GetStadistics),
    (r'/getclimatedata',GetClimateData),
    (r'/getmannkendall',GetMannKendall),
    (r'/getstability',GetStability),
    (r'/getusosuelo', GetUsoSuelo),
    (r'/getdemand', GetUsoSuelo),
    (r'/getfacilityl', GetFacilityLocation),
    (r'/getmapoper', GetMapOper),
    (r'/getinfo', GetInfo),
    (r'/(\w+)', Map),
    (r'/(.*)', MainPage)
])
