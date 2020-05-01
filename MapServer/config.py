#!/usr/bin/env python
import ee
baseURL = 'http://www.wegp.unam.mx/admin/Global/'
#baseURL = '10.99.0.147/'
EE_ACCOUNT = '209028579450-compute@developer.gserviceaccount.com' #cuenta para ee
EE_PRIVATE_KEY_FILE = 'privatekey.pem'  #llave privada de la maquina
#EE_PRIVATE_KEY_FILE = 'privatekey.json'  #llave privada de la maquina
EE_CREDENTIALS = ee.ServiceAccountCredentials(EE_ACCOUNT, EE_PRIVATE_KEY_FILE)
#KEY = 'AIzaSyCIxiGEZou3mM3x73P0YyySKiNn1HkUedQ' #Local key para el mapa
#KEY = 'AIzaSyD84F7WfY-ZWxkt1y_gPDh9KVhs9YbWDZ4' #biomasa key para el mapa
#KEYFT = 'AIzaSyBzOS2gRQAuzmKXtkGGQWBIURi21-Nm2Lg'
#KEY = 'AIzaSyDmx5onaja6CLHbpn3dTqRxXytrexf3whM' #10.99.1.37
KEY = 'AIzaSyDqra8J1Lim9w7fyULtxg5ZlGDa4LNesC0' #wegp
WORKING = True
#WORKING = False
OFFLINE = True
#OFFLINE = False
DEBUG = "debug"
RELEASE = "debug"
#RELEASE = "release"
listaMaxInfo = ["users/ranyartrodrigo/maxMin/p3bio05Max"]
listaMinInfo = ["users/ranyartrodrigo/maxMin/p3bio06Min"]
listaBioTemp = ["users/darkber86/Conabio/p1bio01",
                "users/darkber86/Conabio/p2bio01",
                "users/darkber86/Conabio/p3bio01",
				"users/ranyartrodrigo/bios/p3CNRMCM5_rcp45_bio1",
                "users/ranyartrodrigo/bios/p3CNRMCM5_rcp85_bio1",
				"users/ranyartrodrigo/bios/p4CNRMCM5_rcp45_bio1",
                "users/ranyartrodrigo/bios/p4CNRMCM5_rcp85_bio1",
                "users/ranyartrodrigo/bios/p6CNRMCM5_rcp45_bio1",
                "users/ranyartrodrigo/bios/p6CNRMCM5_rcp85_bio1",
				"users/darkber86/Conabio/p3MPI_ESM_LR_rcp45_bio1",
				"users/darkber86/Conabio/p3MPI_ESM_LR_rcp85_bio1",
				"users/darkber86/Conabio/p4MPI_ESM_LR_rcp45_bio1",
				"users/darkber86/Conabio/p4MPI_ESM_LR_rcp85_bio1",
				"users/darkber86/Conabio/p6MPI_ESM_LR_rcp45_bio1",
				"users/darkber86/Conabio/p6MPI_ESM_LR_rcp85_bio1",
				"users/darkber86/Conabio/p3HADGEM2_ES_rcp45_bio1",
				"users/darkber86/Conabio/p3HADGEM2_ES_rcp85_bio1",
				"users/darkber86/Conabio/p4HADGEM2_ES_rcp45_bio1",
				"users/darkber86/Conabio/p4HADGEM2_ES_rcp85_bio1",
				"users/darkber86/Conabio/p6HADGEM2_ES_rcp45_bio1",
				"users/darkber86/Conabio/p6HADGEM2_ES_rcp85_bio1",
				"users/ranyartrodrigo/bios/p3GFDL_CM3_rcp45_bio1",
				"users/ranyartrodrigo/bios/p3GFDL_CM3_rcp85_bio1",
				"users/ranyartrodrigo/bios/p4GFDL_CM3_rcp45_bio1",
                "users/ranyartrodrigo/bios/p4GFDL_CM3_rcp85_bio1",
                "users/ranyartrodrigo/bios/p6GFDL_CM3_rcp45_bio1",
                "users/ranyartrodrigo/bios/p6GFDL_CM3_rcp85_bio1"]
listaBioPrec = ["users/darkber86/Conabio/p1bio12",
                "users/darkber86/Conabio/p2bio12",
                "users/darkber86/Conabio/p3bio12",
				"users/ranyartrodrigo/bios/p3CNRMCM5_rcp45_bio12",
                "users/ranyartrodrigo/bios/p3CNRMCM5_rcp85_bio12",
				"users/ranyartrodrigo/bios/p4CNRMCM5_rcp45_bio12",
                "users/ranyartrodrigo/bios/p4CNRMCM5_rcp85_bio12",
                "users/ranyartrodrigo/bios/p6CNRMCM5_rcp45_bio12",
                "users/ranyartrodrigo/bios/p6CNRMCM5_rcp85_bio12",
				"users/darkber86/Conabio/p3MPI_ESM_LR_rcp45_bio12",
				"users/darkber86/Conabio/p3MPI_ESM_LR_rcp85_bio12",
				"users/darkber86/Conabio/p4MPI_ESM_LR_rcp45_bio12",
				"users/darkber86/Conabio/p4MPI_ESM_LR_rcp85_bio12",
				"users/darkber86/Conabio/p6MPI_ESM_LR_rcp45_bio12",
				"users/darkber86/Conabio/p6MPI_ESM_LR_rcp85_bio12",
				"users/darkber86/Conabio/p3HADGEM2_ES_rcp45_bio12",
				"users/darkber86/Conabio/p3HADGEM2_ES_rcp85_bio12",
				"users/darkber86/Conabio/p4HADGEM2_ES_rcp45_bio12",
				"users/darkber86/Conabio/p4HADGEM2_ES_rcp85_bio12",
				"users/darkber86/Conabio/p6HADGEM2_ES_rcp45_bio12",
				"users/darkber86/Conabio/p6HADGEM2_ES_rcp85_bio12",
				"users/ranyartrodrigo/bios/p3GFDL_CM3_rcp45_bio12",
				"users/ranyartrodrigo/bios/p3GFDL_CM3_rcp85_bio12",
				"users/ranyartrodrigo/bios/p4GFDL_CM3_rcp45_bio12",
                "users/ranyartrodrigo/bios/p4GFDL_CM3_rcp85_bio12",
                "users/ranyartrodrigo/bios/p6GFDL_CM3_rcp45_bio12",
                "users/ranyartrodrigo/bios/p6GFDL_CM3_rcp85_bio12"]
listaMax = ["users/darkber86/Conabio/p1tmax_49",
            "users/darkber86/Conabio/p2tmax_79",
            "users/darkber86/Conabio/p3tmax_09",
			"users/darkber86/Conabio/p3CNRMCM5_rcp45_tmax",
			"users/darkber86/Conabio/p3CNRMCM5_rcp85_tmax",
			"users/darkber86/Conabio/p4CNRMCM5_rcp45_tmax",
			"users/darkber86/Conabio/p4CNRMCM5_rcp85_tmax",
			"users/darkber86/Conabio/p6CNRMCM5_rcp45_tmax",
			"users/darkber86/Conabio/p6CNRMCM5_rcp85_tmax",
			"users/darkber86/Conabio/p3MPI_ESM_LR_rcp45_tmax",
			"users/darkber86/Conabio/p3MPI_ESM_LR_rcp85_tmax",
			"users/darkber86/Conabio/p4MPI_ESM_LR_rcp45_tmax",
			"users/darkber86/Conabio/p4MPI_ESM_LR_rcp85_tmax",
			"users/darkber86/Conabio/p6MPI_ESM_LR_rcp45_tmax",
			"users/darkber86/Conabio/p6MPI_ESM_LR_rcp85_tmax",
			"users/darkber86/Conabio/p3HADGEM2_ES_rcp45_tmax",
			"users/darkber86/Conabio/p3HADGEM2_ES_rcp85_tmax",
			"users/darkber86/Conabio/p4HADGEM2_ES_rcp45_tmax",
			"users/darkber86/Conabio/p4HADGEM2_ES_rcp85_tmax",
			"users/darkber86/Conabio/p6HADGEM2_ES_rcp45_tmax",
			"users/darkber86/Conabio/p6HADGEM2_ES_rcp85_tmax",
			"users/darkber86/Conabio/p3GFDL_CM3_rcp45_tmax",
			"users/darkber86/Conabio/p3GFDL_CM3_rcp85_tmax",
			"users/darkber86/Conabio/p4GFDL_CM3_rcp45_tmax",
			"users/darkber86/Conabio/p4GFDL_CM3_rcp85_tmax",
			"users/darkber86/Conabio/p6GFDL_CM3_rcp45_tmax",
			"users/darkber86/Conabio/p6GFDL_CM3_rcp85_tmax"]
listaMin = ["users/ranyartrodrigo/tmin/p1tmin_49_conabio",
            "users/ranyartrodrigo/tmin/p2tmin_79_conabio",
            "users/ranyartrodrigo/tmin/p3tmin_09_conabio",
			"users/ranyartrodrigo/tmin_meses/p3CNRMCM5_rcp45_tmin",
            "users/ranyartrodrigo/tmin_meses/p3CNRMCM5_rcp85_tmin",
            "users/ranyartrodrigo/tmin_meses/p4CNRMCM5_rcp45_tmin",
            "users/ranyartrodrigo/tmin_meses/p4CNRMCM5_rcp85_tmin",
            "users/ranyartrodrigo/tmin_meses/p6CNRMCM5_rcp45_tmin",
            "users/ranyartrodrigo/tmin_meses/p6CNRMCM5_rcp85_tmin",
			"users/ranyartrodrigo/tmin_meses/p3MPI_ESM_LR_rcp45_tmin",
            "users/ranyartrodrigo/tmin_meses/p3MPI_ESM_LR_rcp85_tmin",
            "users/ranyartrodrigo/tmin_meses/p4MPI_ESM_LR_rcp45_tmin",
            "users/ranyartrodrigo/tmin_meses/p4MPI_ESM_LR_rcp85_tmin",
            "users/ranyartrodrigo/tmin_meses/p6MPI_ESM_LR_rcp45_tmin",
            "users/ranyartrodrigo/tmin_meses/p6MPI_ESM_LR_rcp85_tmin",
			"users/ranyartrodrigo/tmin_meses/p3HADGEM_ES_rcp45_tmin",
            "users/ranyartrodrigo/tmin_meses/p3HADGEM_ES_rcp85_tmin",
            "users/ranyartrodrigo/tmin_meses/p4HADGEM_ES_rcp45_tmin",
            "users/ranyartrodrigo/tmin_meses/p4HADGEM_ES_rcp85_tmin",
            "users/ranyartrodrigo/tmin_meses/p6HADGEM_ES_rcp45_tmin",
            "users/ranyartrodrigo/tmin_meses/p6HADGEM_ES_rcp85_tmin",
			"users/ranyartrodrigo/tmin_meses/p3GFDL_CM3_rcp45_tmin",
            "users/ranyartrodrigo/tmin_meses/p3GFDL_CM3_rcp85_tmin",
            "users/ranyartrodrigo/tmin_meses/p4GFDL_CM3_rcp45_tmin",
            "users/ranyartrodrigo/tmin_meses/p4GFDL_CM3_rcp85_tmin",
            "users/ranyartrodrigo/tmin_meses/p6GFDL_CM3_rcp45_tmin",
            "users/ranyartrodrigo/tmin_meses/p6GFDL_CM3_rcp85_tmin"]
'''
listaMean = ["users/ranyartrodrigo/tmean/p1tmean_49_conabio",
            "users/ranyartrodrigo/tmean/p2tmean_79_conabio",
            "users/ranyartrodrigo/tmean/p3tmean_09_conabio",
			"users/ranyartrodrigo/tmean/p4tmean_rea_rcp45_39_conabio",
            "users/ranyartrodrigo/tmean/p4tmean_rea_rcp85_39_conabio",
            "users/ranyartrodrigo/tmean/p6tmean_rea_rcp45_99_conabio",
            "users/ranyartrodrigo/tmean/p6tmean_rea_rcp85_99_conabio"]
'''
listaMean = ["users/ranyartrodrigo/tmean/p1tmean_49_conabio",
            "users/ranyartrodrigo/tmean/p2tmean_79_conabio",
            "users/ranyartrodrigo/tmean/p3tmean_09_conabio",
            "users/ranyartrodrigo/tmean_meses/p3CNRMCM5_rcp45_tmean",
            "users/ranyartrodrigo/tmean_meses/p3CNRMCM5_rcp85_tmean",
            "users/ranyartrodrigo/tmean_meses/p4CNRMCM5_rcp45_tmean",
            "users/ranyartrodrigo/tmean_meses/p4CNRMCM5_rcp85_tmean",
            "users/ranyartrodrigo/tmean_meses/p6CNRMCM5_rcp45_tmean",
            "users/ranyartrodrigo/tmean_meses/p6CNRMCM5_rcp85_tmean",
            "users/ranyartrodrigo/tmean_meses/p3MPI_ESM_LR_rcp45_tmean",
            "users/ranyartrodrigo/tmean_meses/p3MPI_ESM_LR_rcp85_tmean",
            "users/ranyartrodrigo/tmean_meses/p4MPI_ESM_LR_rcp45_tmean",
            "users/ranyartrodrigo/tmean_meses/p4MPI_ESM_LR_rcp85_tmean",
            "users/ranyartrodrigo/tmean_meses/p6MPI_ESM_LR_rcp45_tmean",
            "users/ranyartrodrigo/tmean_meses/p6MPI_ESM_LR_rcp85_tmean",
            "users/ranyartrodrigo/tmean_meses/p3HADGEM2_ES_rcp45_tmean",
            "users/ranyartrodrigo/tmean_meses/p3HADGEM2_ES_rcp85_tmean",
            "users/ranyartrodrigo/tmean_meses/p4HADGEM2_ES_rcp45_tmean",
            "users/ranyartrodrigo/tmean_meses/p4HADGEM2_ES_rcp85_tmean",
            "users/ranyartrodrigo/tmean_meses/p6HADGEM2_ES_rcp45_tmean",
            "users/ranyartrodrigo/tmean_meses/p6HADGEM2_ES_rcp85_tmean",
            "users/ranyartrodrigo/tmean_meses/p3GFDL_CM3_rcp45_tmean",
            "users/ranyartrodrigo/tmean_meses/p3GFDL_CM3_rcp85_tmean",
            "users/ranyartrodrigo/tmean_meses/p4GFDL_CM3_rcp45_tmean",
            "users/ranyartrodrigo/tmean_meses/p4GFDL_CM3_rcp85_tmean",
            "users/ranyartrodrigo/tmean_meses/p6GFDL_CM3_rcp45_tmean",
            "users/ranyartrodrigo/tmean_meses/p6GFDL_CM3_rcp85_tmean"
            ]

listaPre = ["users/ranyartrodrigo/prec/p1prec_49_conabio",
            "users/ranyartrodrigo/prec/p2prec_79_conabio",
            "users/ranyartrodrigo/prec/p3prec_09_conabio",
			"users/darkber86/Conabio/p3CNRMCM5_rcp45_prec",
			"users/darkber86/Conabio/p3CNRMCM5_rcp85_prec",
			"users/darkber86/Conabio/p4CNRMCM5_rcp45_prec",
			"users/darkber86/Conabio/p4CNRMCM5_rcp85_prec",
			"users/darkber86/Conabio/p6CNRMCM5_rcp45_prec",
			"users/darkber86/Conabio/p6CNRMCM5_rcp85_prec",
			"users/darkber86/Conabio/p3MPI_ESM_LR_rcp45_prec",
			"users/darkber86/Conabio/p3MPI_ESM_LR_rcp85_prec",
			"users/darkber86/Conabio/p4MPI_ESM_LR_rcp45_prec",
			"users/darkber86/Conabio/p4MPI_ESM_LR_rcp85_prec",
			"users/darkber86/Conabio/p6MPI_ESM_LR_rcp45_prec",
			"users/darkber86/Conabio/p6MPI_ESM_LR_rcp85_prec",
			"users/darkber86/Conabio/p3HADGEM2_ES_rcp45_prec",
			"users/darkber86/Conabio/p3HADGEM2_ES_rcp85_prec",
			"users/darkber86/Conabio/p4HADGEM2_ES_rcp45_prec",
			"users/darkber86/Conabio/p4HADGEM2_ES_rcp85_prec",
			"users/darkber86/Conabio/p6HADGEM2_ES_rcp45_prec",
			"users/darkber86/Conabio/p6HADGEM2_ES_rcp85_prec",
			"users/darkber86/Conabio/p3GFDL_CM3_rcp45_prec",
			"users/darkber86/Conabio/p3GFDL_CM3_rcp85_prec",
			"users/darkber86/Conabio/p4GFDL_CM3_rcp45_prec",
			"users/darkber86/Conabio/p4GFDL_CM3_rcp85_prec",
			"users/darkber86/Conabio/p6GFDL_CM3_rcp45_prec",
			"users/darkber86/Conabio/p6GFDL_CM3_rcp85_prec"]
			
def getValueLV(llave,valor):
  isArray = 0
  if isFloat(valor):
     if llave == "system:index":
       valor = str(int(valor))
     else:
       valor = float(valor)
  else:
     valor = valor.replace("(","[").replace(")","]")
     exec("valor="+valor)  
     isArray = 1
  return [valor, isArray]
def getMinMaxColors(style,columna):
  temp = style.replace('valFill','0.5').replace('[','').replace(']','')
  temp = temp.replace('where','\'where\'').replace('polygonOptions','\'polygonOptions\'').replace('fillColor','\'fillColor\'').replace('fillOpacity','\'fillOpacity\'').replace('iconName','\'iconName\'').replace('markerOptions','\'markerOptions\'').replace('strokeColor','\'strokeColor\'').replace('strokeWeight','\'strokeWeight\'')
  exec("styleT="+temp)  
  limitsMin = []
  limitsMax = []
  colors = ''
  columnaAux = columna.split(',')
  if type(styleT)==tuple:
    for s in styleT:
      limits = s['where'].replace('<','').replace('>','').replace('=','')
      limits = limits.split('AND')
      temp1 = limits[0].replace(columnaAux[1],'')
      temp2 = limits[1].replace(columnaAux[1],'')
      valor1 = float(temp1) if isFloat(temp1) else temp1
      valor2 = float(temp2) if isFloat(temp2) else temp2
      limitsMin.append(valor1)
      limitsMax.append(valor2)
      colors = colors + s['polygonOptions']['fillColor'] + ','
  else:
    limits = styleT['where'].replace('<','').replace('>','').replace('=','')
    limits = limits.split('AND')
    temp1 = limits[0].replace(columnaAux[1],'')
    temp2 = limits[1].replace(columnaAux[1],'')
    valor1 = float(temp1) if isFloat(temp1) else temp1
    valor2 = float(temp2) if isFloat(temp2) else temp2
    limitsMin.append(valor1)
    limitsMax.append(valor2)
    colors = colors + styleT['polygonOptions']['fillColor'] + ','
  colors = colors[0:len(colors)-1]
  colors = colors.replace('#','')
  if isFloat(limitsMin[0]) and isFloat(limitsMax[0]):
    minV = min(limitsMin)
    maxV = max(limitsMax)
  else:
    minV = 1
    maxV = len(limitsMin)
  return [minV,maxV,colors]

def getDescripcionUsoSuelo(categoria, usosSuelo):
  if usosSuelo is None:
    return "-1"
  for s in usosSuelo:
    if s[0] == categoria:
      return s[1]
  return "-1"

def getBDFromPath3(path): 
  bd = path[0:path.rfind('/')]
  bd = bd[bd.rfind('/')+1:]
  if bd == 'www.wegp.unam.mx' or bd == 'wegp.unam.mx':
    bd='global'
  return bd

def getBDFromPath2(path): 
  bd = path[path.rfind('/')+1:]
  if bd == 'www.wegp.unam.mx' or bd == 'wegp.unam.mx':
    bd='global'
  return bd

def getBDFromPath(path):
  path = path[:path.rfind('/')]
  bd = path[path.rfind('/')+1:]
  if bd == 'www.wegp.unam.mx' or bd == 'wegp.unam.mx':
    bd='global'
  return bd

def getMonth(i):
  return {
    0: 'Enero',
    1: 'Febrero',
    2: 'Marzo',
    3: 'Abril',
    4: 'Mayo',
    5: 'Junio',
    6: 'Julio',
    7: 'Agosto',
    8: 'Septiembre',
    9: 'Octubre',
    10: 'Noviembre',
    11: 'Diciembre'
  }[i]

def getIDBD(i):
  return {
    'global':1,
    'cemie':2,
    'sicabioenergy':3,
    'conabio':4,
    'probiomasa':5,
	'lae':6,
	'cepalplayground':7
  }[i]  

def isFloat(value):
  try:
     float(value)
     return True
  except:
     return False

def getListName(variable):
  return {
    1: 'config.listaEvo',
    2: 'config.listaPre',
    3: 'config.listaMax',
    4: 'config.listaMin',
    5: 'config.listaMean',
    6: 'config.listaBioTemp',
    7: 'config.listaBioPrec',
	8: 'config.listaBioTemp',
    9: 'config.listaBioPrec',
	10: 'config.listaBioTemp',
    11: 'config.listaBioPrec',
    12: 'config.listaMax',
    13: 'config.listaMin',
    14: 'config.listaMaxInfo',
    15: 'config.listaMinInfo'
  }[variable]

def getPeriod(temporada):
  return {
    1: [0,12],
    2: [0,3],
    3: [3,6],
    4: [6,9],
    5: [9,12]
  }[temporada]
def getPeriod2(temporada):
  return {    
    2: [0,4,5],
    3: [6,7,8],
    4: [9,10,11],
    5: [1,2,3]
  }[temporada]
