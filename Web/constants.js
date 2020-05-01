var drawingManager = null;
var pathIcons = "/admin/Global/img/iconos/";
var wegpBaseURL="http://www.wegp.unam.mx:8080";
var gettingDemand = false;
var totalRowsInt = null;
var geoxml3 = null;
var totalProduccion = null;
var totalSum = null;
var limitQuery = 2;
var infoWindow;
var debug = true;
var nombresEstados = [];
var valores_ = [];
var columnas_ = [];
var styles_ = [];
var types_ = [];
var tablas_ = [];
var unidades_ = [];
var name_ = [];
var name2_ = [];
var capasCargadas = [];
var capas = [];
var mapid_ = [];
var token_ = [];
var pos_ = [];
var latlng_ = [];
var zoom_ = [];
var pos_ = [];
var map;
var playStop = false;
var cont = 0;
var stopId = 0;
var contCC = 0;
var changeAgain = true;
var nameOper_ = {};
var latlngOper_ = {};
var zoomOper_ = {};
var unidadOper_ = {};
var typesOper_ = {};
var mapidOper_ = {};
var tokenOper_ = {};
var posOper_ = {};
var lastPolygon = null;
var cveEntMarked = [];
var cveMunMarked = [];
var multiPolygons = [];
var pendienteStr = '';
var anpStr = '';
var mapidR = 0;
var tokenR = 0;
var cveANPMarked = [];
var anpG = "";
var polG = 0;
var temporadaG = 0;
var variableG = 2;
var cveEntG = "";
var nombresANP = [];
var nameCol_=[[],[]];
var mapidCol_=[[],[]];
var tokenCol_=[[],[]];
var posCol_=[[],[]];
var timeOutCol=null;
var contCol = 0;
var polsANP = null;
var polsFT = [];
var insideGetStadistics = false;
var styleLayers = [{
	polygonOptions: {
		fillColor: '#000000',
		fillOpacity:0.4,
		strokeColor: '#AA0000',
		strokeWeight: 1
	}
}];
var styleLayersANP = [{
	polygonOptions: {
		fillColor: '#9c603d',
		fillOpacity:0.8,
		strokeColor: '#9c603d',
		strokeWeight: 1
	}
}];
var infoWindowCL = null;
