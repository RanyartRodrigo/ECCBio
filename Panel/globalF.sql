-- MySQL dump 10.13  Distrib 5.1.61, for redhat-linux-gnu (i386)
--
-- Host: localhost    Database: global
-- ------------------------------------------------------
-- Server version	5.1.61

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `amigos`
--

DROP TABLE IF EXISTS `amigos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `amigos` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) DEFAULT NULL,
  `url` text,
  `img` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amigos`
--

LOCK TABLES `amigos` WRITE;
/*!40000 ALTER TABLE `amigos` DISABLE KEYS */;
INSERT INTO `amigos` VALUES (1,'Dinamica EGO','http://csr.ufmg.br/dinamica/','1.png'),(2,'GACC','http://cleancookstoves.org/','2.jpg'),(3,'SEI','http://www.sei-us.org/','3.png');
/*!40000 ALTER TABLE `amigos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `colores`
--

DROP TABLE IF EXISTS `colores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `colores` (
  `id` int(1) NOT NULL,
  `color` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colores`
--

LOCK TABLES `colores` WRITE;
/*!40000 ALTER TABLE `colores` DISABLE KEYS */;
INSERT INTO `colores` VALUES (1,' rgba(35, 111, 121, 0.811765)'),(2,' rgba(255, 255, 255, 0.882353)'),(3,' rgba(249, 248, 255, 0.901961)'),(4,' rgba(0, 47, 41, 0.811765)');
/*!40000 ALTER TABLE `colores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `columnas`
--

DROP TABLE IF EXISTS `columnas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `columnas` (
  `idColumna` int(10) NOT NULL AUTO_INCREMENT,
  `columna` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `valorFiltro` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estilos` text COLLATE utf8_spanish2_ci,
  PRIMARY KEY (`idColumna`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `columnas`
--

LOCK TABLES `columnas` WRITE;
/*!40000 ALTER TABLE `columnas` DISABLE KEYS */;
INSERT INTO `columnas` VALUES (1,'COUNTRY,WF_HARVEST',NULL,'[{where:\'WF_HARVEST >= 0.155740 AND WF_HARVEST <= 9278.102364\',polygonOptions: {fillColor: \'#FFFF80\',fillOpacity: valFill}}, { where: \'WF_HARVEST >= 9278.102365 AND WF_HARVEST <= 25104.616615\', polygonOptions: { fillColor: \'#FAD155\', fillOpacity: valFill } }, { where: \'WF_HARVEST >= 25104.616616 AND WF_HARVEST <= 60477.906217\', polygonOptions: { fillColor: \'#F2A72E\', fillOpacity: valFill } }, { where: \'WF_HARVEST >= 60477.906218 AND WF_HARVEST <= 99890.233750\', polygonOptions: { fillColor: \'#AD5313\', fillOpacity: valFill } }, { where: \'WF_HARVEST >= 99890.233751 AND WF_HARVEST <= 242127.297114\', polygonOptions: { fillColor: \'#6B0000\', fillOpacity: valFill } }]'),(2,'COUNTRY,NRBB2H',NULL,'[{where:\'NRBB2H >= 0 AND NRBB2H <= 772.722787\',polygonOptions: {fillColor: \'#FFFF80\',fillOpacity: valFill}}, { where: \'NRBB2H >= 772.722788 AND NRBB2H <= 2252.542824\', polygonOptions: { fillColor: \'#FAD155\', fillOpacity: valFill } }, { where: \'NRBB2H >= 2252.542825 AND NRBB2H <= 5445.018272\', polygonOptions: { fillColor: \'#F2A72E\', fillOpacity: valFill } }, { where: \'NRBB2H >= 5445.018273 AND NRBB2H <= 13985.153335\', polygonOptions: { fillColor: \'#AD5313\', fillOpacity: valFill } }, { where: \'NRBB2H >= 13985.153336 AND NRBB2H <= 45013.118411\', polygonOptions: { fillColor: \'#6B0000\', fillOpacity: valFill } }]'),(3,'COUNTRY,NRBAH',NULL,'[{where:\'NRBAH >= 0 AND NRBAH <= 1108.831434\',polygonOptions: {fillColor: \'#FFFF80\',fillOpacity: valFill}}, { where: \'NRBAH >= 1108.831435 AND NRBAH <= 3322.803428\', polygonOptions: { fillColor: \'#FAD155\', fillOpacity: valFill } }, { where: \'NRBAH >= 3322.803429 AND NRBAH <= 7330.535172\', polygonOptions: { fillColor: \'#F2A72E\', fillOpacity: valFill } }, { where: \'NRBAH >= 7330.535173 AND NRBAH <= 15063.381802\', polygonOptions: { fillColor: \'#AD5313\', fillOpacity: valFill } }, { where: \'NRBAH >= 15063.381803 AND NRBAH <= 45310.361458\', polygonOptions: { fillColor: \'#6B0000\', fillOpacity: valFill } }]'),(4,'COUNTRY,NRBB1_B2H',NULL,'[{where:\'NRBB1_B2H >= 0 AND NRBB1_B2H <= 1847.33936\',polygonOptions: {fillColor: \'#FFFF80\',fillOpacity: valFill}}, { where: \'NRBB1_B2H >= 1847.33937 AND NRBB1_B2H <= 5445.01827\', polygonOptions: { fillColor: \'#FAD155\', fillOpacity: valFill } }, { where: \'NRBB1_B2H >= 5445.01828 AND NRBB1_B2H <= 12622.38755\', polygonOptions: { fillColor: \'#F2A72E\', fillOpacity: valFill } }, { where: \'NRBB1_B2H >= 12622.38756 AND NRBB1_B2H <= 23823.44006\', polygonOptions: { fillColor: \'#AD5313\', fillOpacity: valFill } }, { where: \'NRBB1_B2H >= 23823.44007 AND NRBB1_B2H <= 45013.11841\', polygonOptions: { fillColor: \'#6B0000\', fillOpacity: valFill } }]'),(5,'COUNTRY,FNRBB2H',NULL,'[{where:\'FNRBB2H >= 0 AND FNRBB2H <= 6.166042\',polygonOptions: {fillColor: \'#FFFF80\',fillOpacity: valFill}}, { where: \'FNRBB2H >= 6.166043 AND FNRBB2H <= 15.132010\', polygonOptions: { fillColor: \'#FAD155\', fillOpacity: valFill } }, { where: \'FNRBB2H >= 15.132011 AND FNRBB2H <= 29.243006\', polygonOptions: { fillColor: \'#F2A72E\', fillOpacity: valFill } }, { where: \'FNRBB2H >= 29.243007 AND FNRBB2H <= 49.401768\', polygonOptions: { fillColor: \'#AD5313\', fillOpacity: valFill } }, { where: \'FNRBB2H >= 49.401769 AND FNRBB2H <= 79.030470\', polygonOptions: { fillColor: \'#6B0000\', fillOpacity: valFill } }]'),(6,'COUNTRY,FNRBAH',NULL,'[{where:\'FNRBAH >= 0 AND FNRBAH <= 10.803855\',polygonOptions: {fillColor: \'#FFFF80\',fillOpacity: valFill}}, { where: \'FNRBAH >= 10.803856 AND FNRBAH <= 24.59147\', polygonOptions: { fillColor: \'#FAD155\', fillOpacity: valFill } }, { where: \'FNRBAH >= 24.591471 AND FNRBAH <= 39.560343\', polygonOptions: { fillColor: \'#F2A72E\', fillOpacity: valFill } }, { where: \'FNRBAH >= 39.560344 AND FNRBAH <= 56.040603\', polygonOptions: { fillColor: \'#AD5313\', fillOpacity: valFill } }, { where: \'FNRBAH >= 56.040604 AND FNRBAH <= 83.284832\', polygonOptions: { fillColor: \'#6B0000\', fillOpacity: valFill } }]'),(7,'COUNTRY,FNRBB1_B2H',NULL,'[{where:\'FNRBB1_B2H >= 0 AND FNRBB1_B2H <= 13.912\',polygonOptions: {fillColor: \'#FFFF80\',fillOpacity: valFill}}, { where: \'FNRBB1_B2H >= 13.91201 AND FNRBB1_B2H <= 28.516\', polygonOptions: { fillColor: \'#FAD155\', fillOpacity: valFill } }, { where: \'FNRBB1_B2H >= 28.51601 AND FNRBB1_B2H <= 46.065\', polygonOptions: { fillColor: \'#F2A72E\', fillOpacity: valFill } }, { where: \'FNRBB1_B2H >= 46.06501 AND FNRBB1_B2H <= 70.041\', polygonOptions: { fillColor: \'#AD5313\', fillOpacity: valFill } }, { where: \'FNRBB1_B2H >= 70.04101 AND FNRBB1_B2H <= 100\', polygonOptions: { fillColor: \'#6B0000\', fillOpacity: valFill } }]'),(8,'COUNTRY,POP_DENS',NULL,'[{where:\'POP_DENS >= 0.070751 AND POP_DENS <= 57.006992\',polygonOptions: {fillColor: \'#FFFF80\',fillOpacity: valFill}}, { where: \'POP_DENS >= 57.006993 AND POP_DENS <= 169.081335\', polygonOptions: { fillColor: \'#FAD155\', fillOpacity: valFill } }, { where: \'POP_DENS >= 169.081336 AND POP_DENS <= 407.566862\', polygonOptions: { fillColor: \'#F2A72E\', fillOpacity: valFill } }, { where: \'POP_DENS >= 407.566863 AND POP_DENS <= 1055.403461\', polygonOptions: { fillColor: \'#AD5313\', fillOpacity: valFill } }, { where: \'POP_DENS >= 1055.403462 AND POP_DENS <= 8186.861934\', polygonOptions: { fillColor: \'#6B0000\', fillOpacity: valFill } }]'),(9,'COUNTRY,TOTAL_POP',NULL,'[{where:\'TOTAL_POP >= 2.168200 AND TOTAL_POP <= 20650.4098\',polygonOptions: {fillColor: \'#FFFF80\',fillOpacity: valFill}}, { where: \'TOTAL_POP >= 20650.409801 AND TOTAL_POP <= 49658.055\', polygonOptions: { fillColor: \'#FAD155\', fillOpacity: valFill } }, { where: \'TOTAL_POP >= 49658.055001 AND TOTAL_POP <= 112015.2307\', polygonOptions: { fillColor: \'#F2A72E\', fillOpacity: valFill } }, { where: \'TOTAL_POP >= 112015.230701 AND TOTAL_POP <= 237257.4094\', polygonOptions: { fillColor: \'#AD5313\', fillOpacity: valFill } }, { where: \'TOTAL_POP >= 237257.409401 AND TOTAL_POP <= 1342307.0294\', polygonOptions: { fillColor: \'#6B0000\', fillOpacity: valFill } }]'),(10,'COUNTRY,URBAN_POP',NULL,'[{where:\'URBAN_POP >= 0 AND URBAN_POP <= 15036.95086\',polygonOptions: {fillColor: \'#FFFF80\',fillOpacity: valFill}}, { where: \'URBAN_POP >= 15036.950861 AND URBAN_POP <= 60794.966\', polygonOptions: { fillColor: \'#FAD155\', fillOpacity: valFill } }, { where: \'URBAN_POP >= 60794.966001 AND URBAN_POP <= 162370.09\', polygonOptions: { fillColor: \'#F2A72E\', fillOpacity: valFill } }, { where: \'URBAN_POP >= 162370.090001 AND URBAN_POP <= 364395.8745\', polygonOptions: { fillColor: \'#AD5313\', fillOpacity: valFill } }, { where: \'URBAN_POP >= 364395.874501 AND URBAN_POP <= 647009.577\', polygonOptions: { fillColor: \'#6B0000\', fillOpacity: valFill } }]'),(11,'COUNTRY,RURAL_POP','NULL','[{where:\'RURAL_POP >= 0 AND RURAL_POP <= 6743.69827\',polygonOptions: {fillColor: \'#FFFF80\',fillOpacity: valFill}}, { where: \'RURAL_POP >= 6743.698271 AND RURAL_POP <= 25167.3847\', polygonOptions: { fillColor: \'#FAD155\', fillOpacity: valFill } }, { where: \'RURAL_POP >= 25167.384701 AND RURAL_POP <= 67747.2869\', polygonOptions: { fillColor: \'#F2A72E\', fillOpacity: valFill } }, { where: \'RURAL_POP >= 67747.286901 AND RURAL_POP <= 120623.0295\', polygonOptions: { fillColor: \'#AD5313\', fillOpacity: valFill } }, { where: \'RURAL_POP >= 120623.029501 AND RURAL_POP <= 828442.232846\', polygonOptions: { fillColor: \'#6B0000\', fillOpacity: valFill } }]'),(19,'COUNTRY,FNRBAH,SUB_UNIT','NULL','[{where:\'FNRBAH >= 0 AND FNRBAH <= 11.342909\',polygonOptions: {fillColor: \'#FFFF80\',fillOpacity: valFill}}, { where: \'FNRBAH >= 11.34291 AND FNRBAH <= 25.139114\', polygonOptions: { fillColor: \'#FAD155\', fillOpacity: valFill } }, { where: \'FNRBAH >= 25.139115 AND FNRBAH <= 39.339209\', polygonOptions: { fillColor: \'#F2A72E\', fillOpacity: valFill } }, { where: \'FNRBAH >= 39.33921 AND FNRBAH <= 60.942406\', polygonOptions: { fillColor: \'#AD5313\', fillOpacity: valFill } }, { where: \'FNRBAH >= 60.942407 AND FNRBAH <= 100\', polygonOptions: { fillColor: \'#6B0000\', fillOpacity: valFill } }]'),(20,'COUNTRY,WF_HARVES,SUB_UNIT','NULL','[{where:\'WF_HARVES >= 0 AND WF_HARVES <= 997\',polygonOptions: {fillColor: \'#FFFF80\',fillOpacity: valFill}}, { where: \'WF_HARVES >= 998 AND WF_HARVES <= 3564\', polygonOptions: { fillColor: \'#FAD155\', fillOpacity: valFill } }, { where: \'WF_HARVES >= 3565 AND WF_HARVES <= 7800\', polygonOptions: { fillColor: \'#F2A72E\', fillOpacity: valFill } }, { where: \'WF_HARVES >= 7801 AND WF_HARVES <= 14815\', polygonOptions: { fillColor: \'#AD5313\', fillOpacity: valFill } }, { where: \'WF_HARVES >= 14816 AND WF_HARVES <= 31829\', polygonOptions: { fillColor: \'#6B0000\', fillOpacity: valFill } }]'),(21,'COUNTRY,FNRBB2H,SUB_UNIT','NULL','[{where:\'FNRBB2H >= 0 AND FNRBB2H <= 8.675848\',polygonOptions: {fillColor: \'#FFFF80\',fillOpacity: valFill}}, { where: \'FNRBB2H >= 8.675849 AND FNRBB2H <= 22.538452\', polygonOptions: { fillColor: \'#FAD155\', fillOpacity: valFill } }, { where: \'FNRBB2H >= 22.538453 AND FNRBB2H <= 38.138518\', polygonOptions: { fillColor: \'#F2A72E\', fillOpacity: valFill } }, { where: \'FNRBB2H >= 38.138519 AND FNRBB2H <= 60.629505\', polygonOptions: { fillColor: \'#AD5313\', fillOpacity: valFill } }, { where: \'FNRBB2H >= 60.629506 AND FNRBB2H <= 100\', polygonOptions: { fillColor: \'#6B0000\', fillOpacity: valFill } }]'),(22,'COUNTRY,FNRBB1_B2H,SUB_UNIT','NULL','[{where:\'FNRBB1_B2H >= 0 AND FNRBB1_B2H <= 13\',polygonOptions: {fillColor: \'#FFFF80\',fillOpacity: valFill}}, { where: \'FNRBB1_B2H >= 13.000001 AND FNRBB1_B2H <= 29.4\', polygonOptions: { fillColor: \'#FAD155\', fillOpacity: valFill } }, { where: \'FNRBB1_B2H >= 29.400001 AND FNRBB1_B2H <= 48.799999\', polygonOptions: { fillColor: \'#F2A72E\', fillOpacity: valFill } }, { where: \'FNRBB1_B2H >= 48.8 AND FNRBB1_B2H <= 79.400002\', polygonOptions: { fillColor: \'#AD5313\', fillOpacity: valFill } }, { where: \'FNRBB1_B2H >= 79.400003 AND FNRBB1_B2H <= 100\', polygonOptions: { fillColor: \'#6B0000\', fillOpacity: valFill } }]'),(23,'COUNTRY,POP_DENS,SUB_UNIT','NULL','[{where:\'POP_DENS >= 0 AND POP_DENS <= 834.948991\',polygonOptions: {fillColor: \'#FFFF80\',fillOpacity: valFill}}, { where: \'POP_DENS >= 834.948992 AND POP_DENS <= 3454.616205\', polygonOptions: { fillColor: \'#FAD155\', fillOpacity: valFill } }, { where: \'POP_DENS >= 3454.616206 AND POP_DENS <= 8141.37718\', polygonOptions: { fillColor: \'#F2A72E\', fillOpacity: valFill } }, { where: \'POP_DENS >= 8141.377181 AND POP_DENS <= 13800.282519\', polygonOptions: { fillColor: \'#AD5313\', fillOpacity: valFill } }, { where: \'POP_DENS >= 13800.28252 AND POP_DENS <= 26365.387489\', polygonOptions: { fillColor: \'#6B0000\', fillOpacity: valFill } }]'),(24,'COUNTRY,RURAL_POP,SUB_UNIT','NULL','[{ where: \'RURAL_POP >= 0 AND RURAL_POP <= 2285.84\', polygonOptions: { fillColor: \'#FAD155\', fillOpacity: valFill } }, { where: \'RURAL_POP >= 2285.840001 AND RURAL_POP <= 11680.8\', polygonOptions: { fillColor: \'#F2A72E\', fillOpacity: valFill } }, { where: \'RURAL_POP >= 11680.800001 AND RURAL_POP <= 35714.5\', polygonOptions: { fillColor: \'#AD5313\', fillOpacity: valFill } }, { where: \'RURAL_POP >= 35714.500001 AND RURAL_POP <= 90209.1\', polygonOptions: { fillColor: \'#6B0000\', fillOpacity: valFill } },{where:\'RURAL_POP >= 90209.100001 AND RURAL_POP <= 156839\',polygonOptions: {fillColor: \'#FFFF80\',fillOpacity: valFill}},]'),(25,'COUNTRY,URBAN_POP,SUB_UNIT','NULL','[{where:\'URBAN_POP >= 0 AND URBAN_POP <= 1448.91\',polygonOptions: {fillColor: \'#FFFF80\',fillOpacity: valFill}}, { where: \'URBAN_POP >= 1448.910001 AND URBAN_POP <= 5623.54\', polygonOptions: { fillColor: \'#FAD155\', fillOpacity: valFill } }, { where: \'URBAN_POP >= 5623.540001 AND URBAN_POP <= 14176.4\', polygonOptions: { fillColor: \'#F2A72E\', fillOpacity: valFill } }, { where: \'URBAN_POP >= 14176.400001 AND URBAN_POP <= 30449.8\', polygonOptions: { fillColor: \'#AD5313\', fillOpacity: valFill } }, { where: \'URBAN_POP >= 30449.800001 AND URBAN_POP <= 70790.9\', polygonOptions: { fillColor: \'#6B0000\', fillOpacity: valFill } }]'),(26,'COUNTRY,TOTAL_POP,SUB_UNIT','NULL','[{where:\'TOTAL_POP >= 0 AND TOTAL_POP <= 4465.631\',polygonOptions: {fillColor: \'#FFFF80\',fillOpacity: valFill}}, { where: \'TOTAL_POP >= 4465.631001 AND TOTAL_POP <= 20211.381\', polygonOptions: { fillColor: \'#FAD155\', fillOpacity: valFill } }, { where: \'TOTAL_POP >= 20211.381001 AND TOTAL_POP <= 46370.6\', polygonOptions: { fillColor: \'#F2A72E\', fillOpacity: valFill } }, { where: \'TOTAL_POP >= 46370.600001 AND TOTAL_POP <= 82227.8\', polygonOptions: { fillColor: \'#AD5313\', fillOpacity: valFill } }, { where: \'TOTAL_POP >= 82227.800001 AND TOTAL_POP <= 193573.1\', polygonOptions: { fillColor: \'#6B0000\', fillOpacity: valFill } }]'),(27,'COUNTRY,NRBAH,SUB_UNIT','NULL','[{where:\'NRBAH >= 0 AND NRBAH <= 363.4\',polygonOptions: {fillColor: \'#FFFF80\',fillOpacity: valFill}}, { where: \'NRBAH >= 363.4001 AND NRBAH <= 1276.4\', polygonOptions: { fillColor: \'#FAD155\', fillOpacity: valFill } }, { where: \'NRBAH >= 1276.4 AND NRBAH <= 3731.8\', polygonOptions: { fillColor: \'#F2A72E\', fillOpacity: valFill } }, { where: \'NRBAH >= 3731.800001 AND NRBAH <= 8284.6\', polygonOptions: { fillColor: \'#AD5313\', fillOpacity: valFill } }, { where: \'NRBAH >= 8284.600001 AND NRBAH <= 22478.6\', polygonOptions: { fillColor: \'#6B0000\', fillOpacity: valFill } }]'),(28,'COUNTRY,NRBB2H,SUB_UNIT','NULL','[{where:\'NRBB2H >= 0 AND NRBB2H <= 493.4\',polygonOptions: {fillColor: \'#FFFF80\',fillOpacity: valFill}}, { where: \'NRBB2H >= 493.4001 AND NRBB2H <= 1825.8\', polygonOptions: { fillColor: \'#FAD155\', fillOpacity: valFill } }, { where: \'NRBB2H >= 1825.8 AND NRBB2H <= 4272.7\', polygonOptions: { fillColor: \'#F2A72E\', fillOpacity: valFill } }, { where: \'NRBB2H >= 4272.700001 AND NRBB2H <= 8039.9\', polygonOptions: { fillColor: \'#AD5313\', fillOpacity: valFill } }, { where: \'NRBB2H >= 8039.900001 AND NRBB2H <= 21525.8\', polygonOptions: { fillColor: \'#6B0000\', fillOpacity: valFill } }]'),(29,'COUNTRY,NRBB1_B2H,SUB_UNIT','NULL','[{where:\'NRBB1_B2H>=0 AND NRBB1_B2H<=429.6\',polygonOptions:{fillColor:\'#ffff80\',fillOpacity:valFill}},{where:\'NRBB1_B2H>=429.6001 AND NRBB1_B2H<=1483.9\',polygonOptions:{fillColor:\'#fbda55\',fillOpacity:valFill}},{where:\'NRBB1_B2H>=1483.9 AND NRBB1_B2H<=3731.8\',polygonOptions:{fillColor:\'#ecb81c\',fillOpacity:valFill}},{where:\'NRBB1_B2H>=3731.800001 AND NRBB1_B2H<=88284.6\',polygonOptions:{fillColor:\'#ad5313\',fillOpacity:valFill}},{where:\'NRBB1_B2H>=88284.600001 AND NRBB1_B2H<=22478.6\',polygonOptions:{fillColor:\'#890e11\',fillOpacity:valFill}}]'),(30,'faodem09_kg,faodem09_kg','NULL','[{where:\'>=0 AND <=100\',polygonOptions:{fillColor:\'#38a81d\',fillOpacity:valFill}},{where:\'>=100 AND <=1000\',polygonOptions:{fillColor:\'#6fc400\',fillOpacity:valFill}},{where:\'>=1000 AND <=5000\',polygonOptions:{fillColor:\'#b0e000\',fillOpacity:valFill}},{where:\'>=5000 AND <=50000\',polygonOptions:{fillColor:\'#ffff00\',fillOpacity:valFill}},{where:\'>=50000 AND <=100000\',polygonOptions:{fillColor:\'#ffaa00\',fillOpacity:valFill}},{where:\'>=100000 AND <=1000000\',polygonOptions:{fillColor:\'#ff5500\',fillOpacity:valFill}},{where:\'>=1000000 AND <=210356096\',polygonOptions:{fillColor:\'#ff0000\',fillOpacity:valFill}}]'),(31,'2_NRB01,2_NRB01','NULL','[{where:\'>=0 AND <=100\',polygonOptions:{fillColor:\'#06ff00\',fillOpacity:valFill}},{where:\'>=100 AND <=100\',polygonOptions:{fillColor:\'#ff0000\',fillOpacity:valFill}}]'),(32,'2_AGBt101,2_AGBt101','NULL','[{where:\'>=1.4 AND <=100\',polygonOptions:{fillColor:\'#06ff00\',fillOpacity:valFill}},{where:\'>=100 AND <=100\',polygonOptions:{fillColor:\'#ff0000\',fillOpacity:valFill}}]'),(33,'2_fNRB01,2_fNRB01','NULL','[{where:\'>=0 AND <=1\',polygonOptions:{fillColor:\'#06ff00\',fillOpacity:valFill}},{where:\'>=1 AND <=1\',polygonOptions:{fillColor:\'#ff0000\',fillOpacity:valFill}}]'),(34,'2_CON_TOT01,2_CON_TOT01','NULL','[{where:\'>=0 AND <=363\',polygonOptions:{fillColor:\'#06ff00\',fillOpacity:valFill}},{where:\'>=363 AND <=363\',polygonOptions:{fillColor:\'#ff0000\',fillOpacity:valFill}}]'),(35,'BIOMASA,BIOMASA','NULL','[{where:\'BIOMASA>0 AND BIOMASA<=127\',polygonOptions:{fillColor:\'#000000\',fillOpacity:valFill}},{where:\'BIOMASA>127 AND BIOMASA<=200\',polygonOptions:{fillColor:\'#39f27a\',fillOpacity:valFill}}]'),(36,'MDEMEX,MDEMEX','NULL','[{where:\'MDEMEX>0 AND MDEMEX<=255\',polygonOptions:{fillColor:\'#37ac15\',fillOpacity:valFill}},{where:\'MDEMEX>255 AND MDEMEX<=255\',polygonOptions:{fillColor:\'#ff0000\',fillOpacity:valFill}}]'),(37,'undem09_kg,undem09_kg','NULL','[{where:\'>=0 AND <=10\',polygonOptions:{fillColor:\'#38a800\',fillOpacity:valFill}},{where:\'>=10 AND <=100\',polygonOptions:{fillColor:\'#66bf00\',fillOpacity:valFill}},{where:\'>=100 AND <=1000\',polygonOptions:{fillColor:\'#9bd900\',fillOpacity:valFill}},{where:\'>=1000 AND <=10000\',polygonOptions:{fillColor:\'#def200\',fillOpacity:valFill}},{where:\'>=10000 AND <=100000\',polygonOptions:{fillColor:\'#ffdd00\',fillOpacity:valFill}},{where:\'>=100000 AND <=1000000\',polygonOptions:{fillColor:\'#ff9100\',fillOpacity:valFill}},{where:\'>=1000000 AND <=10000000\',polygonOptions:{fillColor:\'#ff4800\',fillOpacity:valFill}},{where:\'>=10000000 AND <=235024368\',polygonOptions:{fillColor:\'#ff0000\',fillOpacity:valFill}}]'),(38,'aNRBds_RD,aNRBds_RD','NULL','[{where:\'>0 AND <=16\',polygonOptions:{fillColor:\'#fef0d9\',fillOpacity:valFill}},{where:\'>16 AND <=32\',polygonOptions:{fillColor:\'#fdcc8a\',fillOpacity:valFill}},{where:\'>32 AND <=48\',polygonOptions:{fillColor:\'#fc8d59\',fillOpacity:valFill}},{where:\'>48 AND <=64\',polygonOptions:{fillColor:\'#d7301f\',fillOpacity:valFill}}]'),(39,'aNRBmean_RD,aNRBmean_RD','NULL','[{where:\'>0 AND <=22\',polygonOptions:{fillColor:\'#fef0d9\',fillOpacity:valFill}},{where:\'>22 AND <=44\',polygonOptions:{fillColor:\'#fdcc8a\',fillOpacity:valFill}},{where:\'>44 AND <=66\',polygonOptions:{fillColor:\'#fc8d59\',fillOpacity:valFill}},{where:\'>66 AND <=86\',polygonOptions:{fillColor:\'#d7301f\',fillOpacity:valFill}}]'),(40,'aCON_NRBds_RD,aCON_NRBds_RD','NULL','[{where:\'>0 AND <=24\',polygonOptions:{fillColor:\'#fef0d9\',fillOpacity:valFill}},{where:\'>24 AND <=48\',polygonOptions:{fillColor:\'#fdcc8a\',fillOpacity:valFill}},{where:\'>48 AND <=72\',polygonOptions:{fillColor:\'#fc8d59\',fillOpacity:valFill}},{where:\'>72 AND <=98\',polygonOptions:{fillColor:\'#d7301f\',fillOpacity:valFill}}]'),(41,'aCON_NRBmean_RD,aCON_NRBmean_RD','NULL','[{where:\'>0 AND <=48\',polygonOptions:{fillColor:\'#fef0d9\',fillOpacity:valFill}},{where:\'>48 AND <=96\',polygonOptions:{fillColor:\'#fdcc8a\',fillOpacity:valFill}},{where:\'>96 AND <=144\',polygonOptions:{fillColor:\'#fc8d59\',fillOpacity:valFill}},{where:\'>144 AND <=192\',polygonOptions:{fillColor:\'#d7301f\',fillOpacity:valFill}}]'),(42,'aCON_NRBvar_RD,aCON_NRBvar_RD','NULL','[{where:\'>0 AND <=2385\',polygonOptions:{fillColor:\'#fef0d9\',fillOpacity:valFill}},{where:\'>2385 AND <=4770\',polygonOptions:{fillColor:\'#fdcc8a\',fillOpacity:valFill}},{where:\'>4770 AND <=7155\',polygonOptions:{fillColor:\'#fc8d59\',fillOpacity:valFill}},{where:\'>7155 AND <=9543\',polygonOptions:{fillColor:\'#d7301f\',fillOpacity:valFill}}]'),(43,'aCON_TOTds_RD,aCON_TOTds_RD','NULL','[{where:\'>0 AND <=19\',polygonOptions:{fillColor:\'#fef0d9\',fillOpacity:valFill}},{where:\'>19 AND <=38\',polygonOptions:{fillColor:\'#fdcc8a\',fillOpacity:valFill}},{where:\'>38 AND <=57\',polygonOptions:{fillColor:\'#fc8d59\',fillOpacity:valFill}},{where:\'>57 AND <=78\',polygonOptions:{fillColor:\'#d7301f\',fillOpacity:valFill}}]'),(44,'aCON_TOTmean_RD,aCON_TOTmean_RD','NULL','[{where:\'>0 AND <=48\',polygonOptions:{fillColor:\'#fef0d9\',fillOpacity:valFill}},{where:\'>48 AND <=96\',polygonOptions:{fillColor:\'#fdcc8a\',fillOpacity:valFill}},{where:\'>96 AND <=144\',polygonOptions:{fillColor:\'#fc8d59\',fillOpacity:valFill}},{where:\'>144 AND <=192\',polygonOptions:{fillColor:\'#d7301f\',fillOpacity:valFill}}]'),(45,'aCON_TOTvar_RD,aCON_TOTvar_RD','NULL','[{where:\'>0 AND <=1505\',polygonOptions:{fillColor:\'#fef0d9\',fillOpacity:valFill}},{where:\'>1505 AND <=3010\',polygonOptions:{fillColor:\'#fdcc8a\',fillOpacity:valFill}},{where:\'>3010 AND <=4515\',polygonOptions:{fillColor:\'#fc8d59\',fillOpacity:valFill}},{where:\'>4515 AND <=6020\',polygonOptions:{fillColor:\'#d7301f\',fillOpacity:valFill}}]'),(46,'aNRBvar_RD,aNRBvar_RD','NULL','[{where:\'>0 AND <=968\',polygonOptions:{fillColor:\'#fef0d9\',fillOpacity:valFill}},{where:\'>968 AND <=1936\',polygonOptions:{fillColor:\'#fdcc8a\',fillOpacity:valFill}},{where:\'>1936 AND <=2904\',polygonOptions:{fillColor:\'#fc8d59\',fillOpacity:valFill}},{where:\'>2904 AND <=3872\',polygonOptions:{fillColor:\'#d7301f\',fillOpacity:valFill}}]'),(47,'Biomass_Malawi,Biomass_Malawi','NULL','[{where:\'>=0 AND <=200\',polygonOptions:{fillColor:\'#6a3500\',fillOpacity:valFill}},{where:\'>=200 AND <=397\',polygonOptions:{fillColor:\'#008000\',fillOpacity:valFill}},{where:\'>=397 AND <=397\',polygonOptions:{fillColor:\'#00cc00\',fillOpacity:valFill}}]'),(48,'District,Site_type','NULL','[{where:\'type_id>0 AND type_id<=1\',markerOptions:{iconName:\'measle_brown\'}},{where:\'type_id>1 AND type_id<=2\',markerOptions:{iconName:\'measle_grey\'}},{where:\'type_id>2 AND type_id<=3\',markerOptions:{iconName:\'small_green\'}}]'),(49,'DEM_Malawi,DEM_Malawi','NULL','[{where:\'>0 AND <=2827\',polygonOptions:{fillColor:\'#ffffff\',fillOpacity:valFill}},{where:\'>2827 AND <=2827\',polygonOptions:{fillColor:\'#000000\',fillOpacity:valFill}}]'),(50,'Hillshade_Malawi,Hillshade_Malawi','NULL','[{where:\'>0 AND <=254\',polygonOptions:{fillColor:\'#ffffff\',fillOpacity:valFill}},{where:\'>254 AND <=254\',polygonOptions:{fillColor:\'#000000\',fillOpacity:valFill}}]'),(51,'Treecover_2000_Malawi,Treecover_2000_Malawi','NULL','[{where:\'>0 AND <=100\',polygonOptions:{fillColor:\'#008040\',fillOpacity:valFill}},{where:\'>100 AND <=100\',polygonOptions:{fillColor:\'#753a00\',fillOpacity:valFill}}]'),(52,'NAME_1','NULL','[{where:\'>0 AND <=29\',polygonOptions:{fillColor:\'#82d7ff\',fillOpacity:0.01}}]'),(53,'NAME,DESIG','NULL','[{where:\'>=0 AND <=0\',polygonOptions:{fillColor:\'#0080c0\',fillOpacity:valFill}}]'),(54,'name','NULL','[{where:\'>=0 AND <=0\',polylineOptions:{strokeColor:\'#000000\'}}]'),(55,'name','NULL','[{where:\'>= AND <=\',polylineOptions:{strokeColor:\'#0000ff\'}}]');
/*!40000 ALTER TABLE `columnas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `page` varchar(250) NOT NULL,
  `page_url` varchar(250) NOT NULL,
  `page_title` varchar(250) NOT NULL,
  `content` mediumtext NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `upvotes` int(11) NOT NULL DEFAULT '0',
  `downvotes` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `parent` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commentvotes`
--

DROP TABLE IF EXISTS `commentvotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commentvotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commentvotes`
--

LOCK TABLES `commentvotes` WRITE;
/*!40000 ALTER TABLE `commentvotes` DISABLE KEYS */;
/*!40000 ALTER TABLE `commentvotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galeria`
--

DROP TABLE IF EXISTS `galeria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `galeria` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galeria`
--

LOCK TABLES `galeria` WRITE;
/*!40000 ALTER TABLE `galeria` DISABLE KEYS */;
INSERT INTO `galeria` VALUES (9,'9.png'),(10,'10.png'),(11,'11.png'),(12,'12.png'),(13,'13.png');
/*!40000 ALTER TABLE `galeria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galeria_paises`
--

DROP TABLE IF EXISTS `galeria_paises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `galeria_paises` (
  `idGaleria` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(14) DEFAULT NULL,
  `idPais` int(6) DEFAULT NULL,
  `tipo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idGaleria`)
) ENGINE=MyISAM AUTO_INCREMENT=86 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galeria_paises`
--

LOCK TABLES `galeria_paises` WRITE;
/*!40000 ALTER TABLE `galeria_paises` DISABLE KEYS */;
INSERT INTO `galeria_paises` VALUES (7,'7.jpg',2,1),(52,'52.png',1,1),(23,'23.jpg',1,0),(39,'39.jpg',9,0),(50,'50.jpg',1,0),(48,'48.jpg',1,0),(24,'24.jpg',13,0),(25,'25.jpg',13,0),(26,'26.jpg',13,0),(27,'27.jpg',13,0),(28,'28.jpg',1,0),(29,'29.jpg',1,0),(30,'30.jpg',1,0),(31,'31.jpg',1,0),(32,'32.jpg',1,0),(33,'33.jpg',13,0),(34,'34.jpg',13,0),(37,'37.jpeg',13,0),(38,'38.jpg',10,0),(40,'40.jpg',9,0),(41,'41.jpg',9,0),(42,'42.jpg',9,0),(43,'43.jpg',9,0),(44,'44.jpg',5,0),(45,'45.jpg',5,0),(46,'46.jpg',5,0),(47,'47.jpg',5,0),(51,'51.jpg',1,0),(53,'53.jpg',1,1),(54,'54.gif',1,1),(62,'62.jpg',1,1),(63,'63.jpg',1,1),(58,'58.png',1,1),(64,'64.png',1,1),(73,'73.jpg',1,2),(74,'74.png',1,2),(75,'75.jpg',1,2),(76,'76.jpg',1,2),(77,'77.png',1,2),(78,'78.gif',1,2),(79,'79.png',1,2),(80,'80.JPG',1,2),(81,'81.jpg',1,2),(82,'82.png',1,2),(83,'83.png',1,2),(84,'84.png',1,2),(85,'85.png',1,2);
/*!40000 ALTER TABLE `galeria_paises` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id_Capa` int(12) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `latitud` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `longitud` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `id_Pais` int(6) NOT NULL,
  `descripcion` text COLLATE utf8_spanish2_ci NOT NULL,
  `id_Columna` int(10) DEFAULT NULL,
  `zoom` int(3) NOT NULL,
  `nombreEE` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `nombreEE2` varchar(100) COLLATE utf8_spanish2_ci DEFAULT '',
  `subMenu` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `grupo` varchar(100) COLLATE utf8_spanish2_ci DEFAULT '',
  `unidad` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `tipo` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `escalaLog` tinyint(1) DEFAULT '0',
  UNIQUE KEY `id` (`id_Capa`),
  KEY `menuColumnaFK` (`id_Columna`),
  CONSTRAINT `menuColumnaFK` FOREIGN KEY (`id_Columna`) REFERENCES `columnas` (`idColumna`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'BIOMASA MÃ‰XICO','22.694','-102.37',1,'tyhtyht',35,6,'users/darkber86/Mexico_biomass','','','s','metros','tiff',0),(2,'MDE MÃ‰XICO','22.694','-102.37',1,'nose',36,6,'users/darkber86/MDE_Mexico2','','','s','Kt','tiff',0),(3,'National Harvest','0','0',2,'Estimated mass of woodfuel (firewood and charcoal) consumed annually within each geographic unit (measured in thousands of dry tons per year)',1,2,'1HTFGKSqZ85ozZWoYG6ubX1FCAY4EywBP0IxXPLoL','','Harvest','','Kt','table',0),(4,'National NRB_B2','0','0',2,'NRB_B2: the amount of woodfuel required to meet demand after by-products of deforestation or other land use changes are exhausted',2,2,'1B46sZgTOi7TlqTDcUEluRTfXiQbJypq4RudoLHV7','','NRB','','Kt','table',0),(5,'National NRB_A','0','0',2,'NRB_A: the amount of woodfuels that would be harvested by-products of deforestation or other land use changes are not used at all for woodfuel',3,2,'1B46sZgTOi7TlqTDcUEluRTfXiQbJypq4RudoLHV7','','NRB','','Kt','table',0),(6,'National  NRB_B1+B2','0','0',2,'NRB_B1+B2: the combined amount of woodfuel required to meet demand including by-products of deforestation and the additional volume required to meet total demand.\n                   ',4,2,'1B46sZgTOi7TlqTDcUEluRTfXiQbJypq4RudoLHV7','','NRB','','Kt','table',0),(7,'National fNRB_B2','0','0',2,'fNRB_B2 = NRB_B2 / Harvest',5,2,'18vt0oLY0pQiUGzRbtaJkfhH8vrjdmhA6oaLN_NPp','','fNRB','','Kt','table',0),(8,'National  fNRB_A','0','0',2,'fNRB_A = NRB_A / Harvest;',6,2,'18vt0oLY0pQiUGzRbtaJkfhH8vrjdmhA6oaLN_NPp','','fNRB','','Kt','table',0),(9,'National fNRB_B1+B2','0','0',2,'fNRB_B1+B2 = NRB_B1+B2 / Harvest = NRB_B1+B2 / Harvest\n                        ',7,2,'18vt0oLY0pQiUGzRbtaJkfhH8vrjdmhA6oaLN_NPp','','fNRB','','Kt','table',0),(10,'National Pupolation Dens','0','0',2,'Density and Total population. Four variables are shown: 1) population density in inhab/km<sup>2</sup>; 2) Total population in thousands of inhabitants; 3) urban population in thousands of inhabitants; and 4) rural population in thousands of inhabitants.',8,2,'1y5UfXG61Xsk95avwmfE4wR81IcPF-MgnhSj9i-WE','','Population','national','inhab/km<sup>2</sup>','table',0),(11,'National Total Popul','0','0',2,'Density and Total population. Four variables are shown: 1) population density in inhab/km2; 2) Total population in thousands of inhabitants; 3) urban population in thousands of inhabitants; and 4) rural population in thousands of inhabitants.',9,2,'1y5UfXG61Xsk95avwmfE4wR81IcPF-MgnhSj9i-WE','','Population','national','x1000 inhab','table',0),(12,'National Urban Popul','0','0',2,'Density and Total population. Four variables are shown: 1) population density in inhab/km2; 2) Total population in thousands of inhabitants; 3) urban population in thousands of inhabitants; and 4) rural population in thousands of inhabitants.',10,2,'1y5UfXG61Xsk95avwmfE4wR81IcPF-MgnhSj9i-WE','','Population','national','x1000 inhab','table',0),(13,'National Rural Popul','0','0',2,'Density and Total population. Four variables are shown: 1) population density in inhab/km2; 2) Total population in thousands of inhabitants; 3) urban population in thousands of inhabitants; and 4) rural population in thousands of inhabitants.',11,2,'1y5UfXG61Xsk95avwmfE4wR81IcPF-MgnhSj9i-WE','','Population','national','x1000 inhab','table',0),(14,'2_AGBt101','19.305','-72.2708',13,'2_AGBt101',32,9,'users/darkber86/2_AGBt101','','','','Kg','tiff',0),(15,'2_CON_TOT01','19.305','-72.2708',13,'2_CON_TOT01',34,9,'users/darkber86/2_CON_TOT01','','','','Kg','tiff',0),(16,'2_fNRB01','19.305','-72.2708',13,'2_fNRB01',33,9,'users/darkber86/2_fNRB01','','','','Kg','tiff',0),(17,'2_NRB01','19.305','-72.2708',13,'2_NRB01',31,9,'users/darkber86/2_NRB01','','','','Kg','tiff',0),(18,'Sub National fNRB_A','0','0',2,'fNRB_A',19,2,'1wGn2NPze_EG6cOnZN7c0I6jYOPZ6DCxX6T9feRtZ','18vt0oLY0pQiUGzRbtaJkfhH8vrjdmhA6oaLN_NPp','fNRB','','Kt','table',0),(19,'Sub National Harvest','0','0',2,'Estimated mass of woodfuel (firewood and charcoal) consumed annually within each geographic unit (measured in thousands of dry tons per year)',20,2,'1THLfWXEhlRpU4HvA968dWPau9PFuOac7ne571BHD','1HTFGKSqZ85ozZWoYG6ubX1FCAY4EywBP0IxXPLoL','Harvest','','Kt','table',0),(20,'Sub National fNRB_B2','0','0',2,'fNRB_B2',21,2,'1wGn2NPze_EG6cOnZN7c0I6jYOPZ6DCxX6T9feRtZ','18vt0oLY0pQiUGzRbtaJkfhH8vrjdmhA6oaLN_NPp','fNRB','','Kt','table',0),(21,'Sub National fNRB_B1+B2','0','0',2,'fNRB_B1+B2 = NRB_B1+B2 / Harvest = NRB_B1+B2 / Harvest',22,2,'1wGn2NPze_EG6cOnZN7c0I6jYOPZ6DCxX6T9feRtZ','18vt0oLY0pQiUGzRbtaJkfhH8vrjdmhA6oaLN_NPp','fNRB','','Kt','table',0),(22,'Sub National Total Popul','0','0',2,'Total Population',26,2,'1HgRCp4Bkf4QV7IcVHysm6lQwJlJ-T3JKXjQNRoVi','1y5UfXG61Xsk95avwmfE4wR81IcPF-MgnhSj9i-WE','Population','subnational','x1000 inhab','table',0),(23,'Sub National Rural Popul','0','0',2,'Rural Population',24,2,'1HgRCp4Bkf4QV7IcVHysm6lQwJlJ-T3JKXjQNRoVi','1y5UfXG61Xsk95avwmfE4wR81IcPF-MgnhSj9i-WE','Population','subnational','x1000 inhab','table',0),(24,'Sub National Urban Popul','0','0',2,'Urban Population',25,2,'1HgRCp4Bkf4QV7IcVHysm6lQwJlJ-T3JKXjQNRoVi','1y5UfXG61Xsk95avwmfE4wR81IcPF-MgnhSj9i-WE','Population','subnational','x1000 inhab','table',0),(25,'Sub National Population Dens','0','0',2,'Population Density',23,2,'1HgRCp4Bkf4QV7IcVHysm6lQwJlJ-T3JKXjQNRoVi','1y5UfXG61Xsk95avwmfE4wR81IcPF-MgnhSj9i-WE','Population','subnational','inhab/km<sup>2</sup>','table',0),(26,'Sub National NRB_A','0','0',2,'fNRB_B1+B2 = NRB_B1+B2 / Harvest = NRB_B1+B2 / Harvest',27,2,'1dw7xwXf0KVLNvncaMQIMFwYCWyoWVxxm0--Xvs9U','1B46sZgTOi7TlqTDcUEluRTfXiQbJypq4RudoLHV7','NRB','','Kt','table',0),(27,'Sub National NRB_B2','0','0',2,'fNRB_B1+B2 = NRB_B1+B2 / Harvest = NRB_B1+B2 / Harvest',28,2,'1dw7xwXf0KVLNvncaMQIMFwYCWyoWVxxm0--Xvs9U','1B46sZgTOi7TlqTDcUEluRTfXiQbJypq4RudoLHV7','NRB','','Kt','table',0),(28,'Sub National NRB_B1+B2','0','0',2,'fNRB_B1+B2 = NRB_B1+B2 / Harvest = NRB_B1+B2 / Harvest',29,2,'1dw7xwXf0KVLNvncaMQIMFwYCWyoWVxxm0--Xvs9U','1B46sZgTOi7TlqTDcUEluRTfXiQbJypq4RudoLHV7','NRB','','Kt','table',0),(29,'FAODEM','0','0',2,'FAODEM',30,2,'users/darkber86/faodem09_kg','','','','Kg','tiff',1),(30,'UNDEM','0','0',2,'UNDEM KG',37,3,'users/darkber86/undem09_kg','','','','Kg','tiff',1),(31,'aNRBmean','18.97','-70.24',4,'aNRBmean',39,9,'users/darkber86/aNRBmean_RD','','NRB','','Kg/Ha','tiff',0),(32,'aNRBds','18.97','-70.24',4,'aNRBds',38,9,'users/darkber86/aNRBds_RD','','NRB','','Kg/Ha','tiff',0),(33,'aCON_NRBds','18.97','-70.24',4,'aCON_NRBds',40,9,'users/darkber86/aCON_NRBds_RD','','aCON','','Kg','tiff',1),(34,'aCON_NRBmean','18.97','-70.24',4,'aCON_NRBmean',41,9,'users/darkber86/aCON_NRBmean_RD','','aCON','','Kg','tiff',1),(35,'aCON_NRBvar','18.97','-70.24',4,'aCON_NRBvar',42,9,'users/darkber86/aCON_NRBvar_RD','','aCON','','Kg','tiff',1),(36,'aCON_TOTds','18.97','-70.24',4,'aCON_TOTds',43,9,'users/darkber86/aCON_TOTds_RD','','aCON','','Kg','tiff',1),(37,'aCON_TOTmean','18.97','-70.24',4,'aCON_TOTmean',44,9,'users/darkber86/aCON_TOTmean_RD','','aCON','','Kg','tiff',1),(38,'aCON_TOTvar','18.97','-70.24',4,'aCON_TOTvar',45,9,'users/darkber86/aCON_TOTvar_RD','','aCON','','Kg','tiff',1),(39,'aNRBvar','18.97','-70.24',4,'aNRBvar',46,9,'users/darkber86/aNRBvar_RD','','NRB','','Kg/Ha','tiff',1),(40,'Biomass','-11.26','34.20',9,'Biomass',47,7,'users/darkber86/Biomass_Malawi','','Ancillary data','','Kg/Ha','tiff',0),(41,'Mulanje','-11.26','34.20',9,'Mulanje',48,7,'1n8jZHOZ_Al-BmEzPkJoJPxFdTX59Qk0VXjTxctc1','','Samples Sites','','N/A','table',0),(42,'DEM','-11.26','34.20',9,'DEM',49,7,'users/darkber86/DEM_Malawi','','Ancillary data','','Kg/Ha','tiff',0),(43,'Hillshad','-11.26','34.20',9,'Hillshade',50,7,'users/darkber86/Hillshade_Malawi','','Ancillary data','','Kg/Ha','tiff',0),(44,'Treecover 2000','-11.26','34.20',9,'Treecover 2000',51,7,'users/darkber86/Treecover_2000_Malawi','','Ancillary data','','Kg/Ha','tiff',0),(45,'Districts','-11.26','34.20',9,'Districts',52,7,'1R35Ah6jP1JDsQKVN93cboMfksQinuyDS4e6szD_H','','','','N/A','table',0),(46,'Protected Areas','-11.26','34.20',9,'Protected areas',53,7,'1YezGKOM4ot2nss1EuMTn0xoXRDwpxLwZoRu5mRyi','','Ancillary data','','N/A','table',0),(47,'Rivers','-11.26','34.20',9,'Riveres',55,7,'19sQUvPKKBBCs9CbPRhZQTWn5D6TrpmbBk5GSJen4','','Ancillary data','','N/A','table',0),(48,'Chiradzulu','-11.26','34.20',9,'Chiradzulu',48,7,'1wFL-t7Mq9zED2vYNlacPDvnfsQMAhTX53vLRYsiA','','Samples Sites','','N/A','table',0),(49,'Thyolo','-11.26','34.20',9,'Thyolo',48,7,'1oq0QgXIpinkUTmYdltiGeK50XsrgUCX3Y6g3Croh','','Samples Sites','','N/A','table',0),(50,'Main Roads','-11.26','34.20',9,'Main Roads',54,7,'1k4KeTyZVsfueg0qKD_2SRZH3uTHAInQfVfclJNP4','','Ancillary data','','N/A','table',0);
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_user` int(11) NOT NULL,
  `to_user` int(11) NOT NULL,
  `message` mediumtext NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group` varchar(100) NOT NULL,
  `item` varchar(100) NOT NULL,
  `value` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `options`
--

LOCK TABLES `options` WRITE;
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
/*!40000 ALTER TABLE `options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paises`
--

DROP TABLE IF EXISTS `paises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paises` (
  `id_Pais` int(6) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `nombreURL` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `informacion` text COLLATE utf8_spanish2_ci,
  `longitud` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `zoom` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `latitud` varchar(11) COLLATE utf8_spanish2_ci NOT NULL,
  `maxZoom` int(11) NOT NULL,
  `bandera` varchar(30) COLLATE utf8_spanish2_ci DEFAULT '',
  PRIMARY KEY (`id_Pais`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paises`
--

LOCK TABLES `paises` WRITE;
/*!40000 ALTER TABLE `paises` DISABLE KEYS */;
INSERT INTO `paises` VALUES (1,'Mexico','Mexico','<div s class=\"completo obscuro\"><img src=\"http://www.mofuss.unam.mx/Mapps/Global/uploads/galeria_Paises/23.jpg\"/><div><h3>CARACTERÃSTICAS GEOGRÃFICAS</h3><p>La mayorÃ­a del territorio mexicano se encuentra en una plataforma a una gran altura sobre el nivel del mar. Los dos sistemas montaÃ±osos que posee son la Sierra Madre Occidental y la Sierra Madre Oriental, donde se encuentra una regiÃ³n denominada La Junta. En esta regiÃ³n existe una maza de montaÃ±as volcÃ¡nicas donde se destaca el Tehuantepec. \nLa caracterÃ­stica mÃ¡s prominente de la topografÃ­a mexicana es la existencia de una gran plataforma central. Dos grandes valles se encuentran en ella, el BolsÃ³n de MaipÃ­ y el Valle de AnÃ¡huac, al centro de MÃ©xico.\nLas costas son planas, generalmente bajas y con bastante arena, por lo que hay buenas playas.\nMÃ©xico tiene poca cantidad de rÃ­os y muchos de ellos no son navegables. Se destaca el RÃ­o Grande, tambiÃ©n llamdo RÃ­o Bravo; que forma la frontera con los estados Unidos. En el valle tambiÃ©n existen algunos lagos.</p></div></div><div s class=\"cuarto semiobscuro\"><img src=\"http://www.mofuss.unam.mx/Mapps/Global/uploads/galeria_Paises/50.jpg\"/><div><h3>IDIOMA </h3><p>El idioma oficial y que prevalece en la mayorÃ­a de la poblaciÃ³n, es el EspaÃ±ol, aunque se hablan algunas leguas nativas y diferentes dialectos como el Nahuatl y el Azteca, otros dialectos incluyen el Maya en la penÃ­nsula de YucatÃ¡n, OtomÃ­ en la regiÃ³n central, el Mixtec y el Zapotec.</p></div></div><div s class=\"medio claro\"><img src=\"http://www.mofuss.unam.mx/Mapps/Global/uploads/galeria_Paises/48.jpg\"/><div><h3>SITUACIÃ“N GEOGRÃFICA</h3><p>Los Estados Unidos Mexicanos se encuentran en AmÃ©rica del Norte.\nSus fronteras son:\nNorte: Estados Unidos.\nSur: Belice y Guatemala.\nEste: Golfo de MÃ©xico y Mar Caribe. \nOeste: OcÃ©ano PacÃ­fico.\nTambiÃ©n pertenecen al territorio mexicano algunas islas fuera del continente.</p></div></div><div s class=\"cuarto semiobscuro\"><img src=\"http://www.mofuss.unam.mx/Mapps/Global/uploads/galeria_Paises/31.jpg\"/><div><h3>RELIGIÃ“N</h3><p>MÃ©xico tuvo una tradiciÃ³n de anticlericalismo oficial que culminÃ³ en 1991 con los cambios en la ConstituciÃ³n.\nEl 90% de los religiosos son catÃ³licos. Los protestantes representan una minorÃ­a.</p></div></div><div s class=\"completo obscuro\"><img src=\"http://www.mofuss.unam.mx/Mapps/Global/uploads/galeria_Paises/29.jpg\"/><div><h3>RECURSOS NATURALES</h3><p>Los recursos minerales en MÃ©xico son muy ricos y variados. Casi todos los minerales pueden encontrarse como reservas en este paÃ­s, incluyenso el cobre, hierro, fosfato, uranio, plata, oro, cobre y el zinc entre otros muchos. MÃ©xico es productor de petrÃ³leo y gas natural pues tiene enormes reservas de estos recursos.\nEs productor tambiÃ©n de maderas preciosas y tiene buenas condiciones para el desarrollo de la agricultura.</p></div></div><div s class=\"medio semiobscuro\"><img src=\"http://www.mofuss.unam.mx/Mapps/Global/uploads/galeria_Paises/28.jpg\"/><div><h3>PRINCIPALES CIUDADES</h3><p>La capital es MÃ©xico D.F. que es ademÃ¡s la ciudad mÃ¡s grande del paÃ­s.\nOtras ciudades importantes son Guadalajara, NetzahualcÃ³yotl, Monterrey, Puebla, LeÃ³n, Ciudad JuÃ¡rez y Tijuana.</p></div></div><div s class=\"cuarto claro\"><img src=\"http://www.mofuss.unam.mx/Mapps/Global/uploads/galeria_Paises/32.jpg\"/><div><h3>CLIMA</h3><p>MÃ©xico estÃ¡ dividido por el TrÃ³pico de CÃ¡ncer, la regiÃ³n sur se encuentra en una zona tÃ³rrida. En general, el clima varÃ­a de acuerdo a la altura. En las regiones bajas hay un clima cÃ¡lido.\nLa humedad ambiental es extremadamente alta y las temperaturas pueden variar entre 16Â° y 49Â°C.\nEn las regiones templadas puede haber una variaciÃ³n de temperaturas de 17Â° a 21Â°C, mientras que en las zonas frÃ­as el promedio es de 6Â° a 19Â°C.</p></div></div><div s class=\"cuarto obscuro\"><img src=\"http://www.mofuss.unam.mx/Mapps/Global/uploads/galeria_Paises/30.jpg\"/><div><h3>FLORA Y FAUNA</h3><p>Debido a la gran extensiÃ³n territorial, la flora y fauna mexicanas son extremadamente variadas.\nEn la vegetaciÃ³n se destacan los Ã¡rboles maderables y vegetaciÃ³n desÃ©rtica en algunas regiones, asÃ­ como palmas y cocoteros entre otros.\nEntre los animales se destacan los lobos y coyotes, asÃ­ como oselotes, jaguares y otros.</p></div></div><div s class=\"completo claro\"><img src=\"http://www.mofuss.unam.mx/Mapps/Global/uploads/galeria_Paises/51.jpg\"/><div><h3>CULTURA</h3><p>La cultura mexicana es muy rica y compleja, tiene sus raÃ­ces en las tradiciones aborÃ­genes y espaÃ±olas.\nEn las Ã¡reas rurales se observa una cultura popular con fuerte influencia del desarrollo de las sociedades mayas, aztecas y toltecas, aunque los descendientes de los espaÃ±oles la han enriquecido incluyÃ©ndole tradiciones espaÃ±olas.\nEn las ciudades hay una mayor influencia de la cultura europea y una influencia norteamericana.</p></div></div>','-102.08','6','23.24',10,'1.png'),(2,'World','World','<div s class=\"completo obscuro\"><img src=\"uploads/paises/2.jpg\"/><div><h3></h3><p></p></div></div>','0','3','0',13,'2.jpg'),(3,'Bangladesh','Bangladesh','<div class=\"cuarto obscuro\"><h3>8o</h3><p>o8</p></div>','90.14','8','24.61',12,'3.png'),(4,'Dominican Republic','DominicanRepublic','<div class=\"medio claro\"><h3>o8</h3><p>o8i</p></div>','-70.24','9','18.97',13,'4.png'),(5,'El Salvador','ElSalvador','<div s class=\"completo semiobscuro\"><img src=\"http://www.mofuss.unam.mx/Mapps/Global/uploads/galeria_Paises/46.jpg\"/><div><h3>GEOGRAPHY</h3><p>Situated on the Pacific coast of Central America, El Salvador has Guatemala to the west and Honduras to the north and east. It is the smallest of the Central American countries, with an area equal to that of Massachusetts, and it is the only one without an Atlantic coastline. Most of the country is on a fertile volcanic plateau about 2,000 ft (607 m) high.</p></div></div><div s class=\"tercio obscuro\"><img src=\"http://www.mofuss.unam.mx/Mapps/Global/uploads/galeria_Paises/46.jpg\"/><div><h3>CLIMATE</h3><p>El Salvador has a Tropical climate with pronounced wet and dry seasons. Temperatures vary primarily with elevation and show little seasonal change. The Pacific lowlands are uniformly hot; the central plateau and mountain areas are more moderate. The rainy season extends from May to October; this time of year is referred to as invierno or winter. Almost all the annual rainfall occurs during this period; yearly totals, particularly on southern-facing mountain slopes, can be as high as 2170 mm.</p></div></div><div s class=\"tercio claro\"><img src=\"http://www.mofuss.unam.mx/Mapps/Global/uploads/galeria_Paises/45.jpg\"/><div><h3>POLITICAL CULTURE</h3><p>El Salvador has a multi-party system. Two political parties, the Nationalist Republican Alliance (ARENA) and the Farabundo MartÃ­ National Liberation Front (FMLN) have tended to dominate elections. ARENA candidates won four consecutive presidential elections until the election of Mauricio Funes of the FMLN in March 2009. The FMLN Party is Leftist in ideology, and is split between the dominant Marxist-Leninist faction in the legislature, and the liberal wing led by President Funes.</p></div></div><div s class=\"tercio obscuro\"><img src=\"http://www.mofuss.unam.mx/Mapps/Global/uploads/galeria_Paises/47.jpg\"/><div><h3>HUMAN RIGHTS</h3><p>Amnesty International has drawn attention to several arrests of police officers for unlawful police killings. Other current issues to gain Amnesty International\"s attention in the past 10 years include missing children, failure of law enforcement to properly investigate and prosecute crimes against women, and rendering organized labor illegal</p></div></div><div s class=\"completo semiobscuro\"><img src=\"http://www.mofuss.unam.mx/Mapps/Global/uploads/galeria_Paises/44.jpg\"/><div><h3>HISTORY</h3><p>The Pipil Indians, descendants of the Aztecs, likely migrated to the region in the 11th century. In 1525, Pedro de Alvarado, a lieutenant of CortÃ©s\"s, conquered El Salvador.\n\nEl Salvador, with the other countries of Central America, declared its independence from Spain on Sept. 15, 1821, and was part of a federation of Central American states until that union dissolved in 1838. For decades after its independence, El Salvador experienced numerous revolutions and wars against other Central American republics. From 1931 to 1979 El Salvador was ruled by a series of military dictatorships.\n\nIn 1969, El Salvador invaded Honduras after Honduran landowners deported several thousand Salvadorans. The four-day war became known as the â€œfootball warâ€ because it broke out during a soccer game between the two countries.</p></div></div><div s class=\"completo claro\"><img src=\"ninguna\"/><div><h3>FOREIGN RELATIONS</h3><p>El Salvador is a member of the United Nations and several of its specialized agencies, the Organization of American States (OAS), the Central American Common Market (CACM), the Central American Parliament (PARLACEN), and the Central American Integration System (SICA). It actively participates in the Central American Security Commission (CASC), which seeks to promote regional arms control.\n\nEl Salvador also is a member of the World Trade Organization and is pursuing regional free trade agreements. An active participant in the Summit of the Americas process, El Salvador chairs a working group on market access under the Free Trade Area of the Americas initiative.</p></div></div>','-88.87','10','13.98',14,'5.png'),(6,'Honduras','Honduras','<div class=\"medio obscuro\"><h3>89l</h3><p>oli</p></div>','-87.24','9','14.43',13,'6.png'),(7,'India','India','<div class=\"medio obscuro\"><h3>9ol</h3><p>89l</p></div>','78.39','5','24.96',9,'7.png'),(8,'Kenya','Kenya','<div class=\"cuarto claro\"><h3>o</h3><p>9il</p></div>','37.93','7','1.75',11,'8.gif'),(9,'Malawi','Malawi','<div s class=\"tercio obscuro\"><img src=\"http://www.mofuss.unam.mx/Mapps/Global/uploads/galeria_Paises/40.jpg\"/><div><h3>MIGRATION</h3><p>Acccelerating migration from rural to urban areas contributed to an annual urban growth rate of about 6% in the early 1990s. Between October 1992 and mid-1996, 1.3 million Mozambican refugees repatriated from Malawi; the return of refugees to Mozambique was complete. In 2004 persons of concern to the United Nations High Commissioner for Refugees (UNHCR) in Malawi were 3,682 refugees and 3,335 asylum seekers from the Democratic Republic of the Congo and Rwanda. In 2004 over 1,700 Malawians sought asylum in South Africa and the United Kingdom.</p></div></div><div s class=\"tercio semiobscuro\"><img src=\"http://www.mofuss.unam.mx/Mapps/Global/uploads/galeria_Paises/43.jpg\"/><div><h3>ETHNIC GROUPS</h3><p>TThe people of Malawi belong mainly to various Central Bantu groups. The Chewas are primarily located in the central regions of the country. The Nyanja live primarily in the south and the Lomwe (Alomwe) live south of Lake Chilwa. Other indigenous Malawians include the Tumbuko, Tonga, and Ngonde. The Ngoni (an offshoot of the Zulus from South Africa) and Yao arrived in the 19th century. There are a few thousand Europeans, mainly of British origin, including descendants of Scottish missionaries. There are also small numbers of Portuguese, Asians (mainly Indians), and persons of mixed ancestry.</p></div></div><div s class=\"tercio claro\"><img src=\"http://www.mofuss.unam.mx/Mapps/Global/uploads/galeria_Paises/42.jpg\"/><div><h3>LANGUAGES</h3><p>NNumerous Bantu languages and dialects are spoken. Chichewa, the language of the Chewa and Nyanja, is spoken by more than half the population, but the Lomwe, Yao, and Tumbuka have their own widely spoken languages, respectively known as Chilomwe, Chiyao, and Chitumbuka. English and Chichewa are the official languages.</p></div></div>','34.20','7','-11.26',11,'9.gif'),(10,'Nigeria','Nigeria','<div s class=\"medio semiobscuro\"><img src=\"http://www.mofuss.unam.mx/Mapps/Global/uploads/galeria_Paises/38.jpg\"/><div><h3>POLITICAL SYSTEM</h3><p>Nigeria is a Federal Republic with a presidential system. Chief of State, Head of the Government and Commander-in-Chief of the Armed Forces is the president. \nNigerias constitution provides the separation of powers of the three branches (Executive branch, Legislative branch, and Judicial branch).\nThe bicameral National Assembly consists of the Senate and the House of Representatives. \nThe country has a mixed legal system of English common law, Islamic law (in 12 northern states), and traditional law. Sharia has been instituted as a main body of civil and criminal law in 9 Muslim-majority and in some parts of 3 Muslim-plurality states since 1999.</p></div></div><div s class=\"medio claro\"><img src=\"http://www.mofuss.unam.mx/Mapps/Global/uploads/galeria_Paises/38.jpg\"/><div><h3>WORLD HERITAGE SITES IN NIGERIA</h3><p>World Heritage Site Osun-Osogbo Sacred Grove \nThe dense forest of the Osun Sacred Grove, on the outskirts of the city of Osogbo, in Yorubaland is one of the last remnants of primary high forest in southern Nigeria. The landscape of the grove and its meandering river is dotted with sanctuaries and shrines, sculptures and art works in honour of Oshun, the goddess of fertility.\n\nWorld Heritage Site Sukur Cultural Landscape\nThe Sukur Cultural Landscape, with the Palace of the Hidi (Chief) on a hill dominating the villages below, the terraced fields and their sacred symbols, and the extensive remains of a former flourishing iron industry. According to this site, (Sukur.info) the region in the Mandara mountains of northeast Nigeria was assaulted by Boko Haram extremists in 2014.</p></div></div><div s class=\"completo obscuro\"><img src=\"http://www.mofuss.unam.mx/Mapps/Global/uploads/galeria_Paises/38.jpg\"/><div><h3>NIGERIA NEWS</h3><p>According to Reporters Without Borders, Nigeria has more than 100 independent media outlets, but it is nearly impossible to cover stories involving politics, terrorism, or financial embezzlement. Journalists are often threatened, subjected to physical violence, or denied access to information by government officials, police, and sometimes the public itself. (RSF)</p></div></div>','7.75','7','11.13',11,'10.png'),(13,'Haiti','Haiti','<div s class=\"medio semiobscuro\"><img src=\"http://www.mofuss.unam.mx/Mapps/Global/uploads/galeria_Paises/33.jpg\"/><div><h3>LAND</h3><p>Haiti is bordered to the east by the Dominican Republic, which covers the rest of Hispaniola, to the south and west by the Caribbean, and to the north by the Atlantic Ocean. Cuba lies some 50 miles (80 km) west of Haitiâ€™s northern peninsula, across the Windward Passage, a strait connecting the Atlantic to the Caribbean. Jamaica is some 120 miles (190 km) west of the southern peninsula, across the Jamaica Channel, and Great Inagua Island (of The Bahamas) lies roughly 70 miles (110 km) to the north. Haiti claims sovereignty over Navassa (Navase) Island, an uninhabited U.S.-administered islet about 35 miles (55 km) to the west in the Jamaica Channel.</p></div></div><div s class=\"medio obscuro\"><img src=\"http://www.mofuss.unam.mx/Mapps/Global/uploads/galeria_Paises/34.jpg\"/><div><h3>RELIEF AND DRAINAGE</h3><p>The generally rugged topography of central and western Hispaniola is reflected in Haitiâ€™s name, which derives from the indigenous Arawak place-name Ayti (â€œMountainous Landâ€); about two-thirds of the total land area is above 1,600 feet (490 metres) in elevation. Haitiâ€™s irregular coastline forms a long, slender peninsula in the south and a shorter one in the north, separated by the triangular-shaped Gulf of GonÃ¢ve. Within the gulf lies GonÃ¢ve Island, which has an area of approximately 290 square miles (750 square km). Haitiâ€™s shores are generally rocky, rimmed with cliffs, and indented by a number of excellent natural harbours. The surrounding seas are renowned for their coral reefs. Plains, which are quite limited in extent, are the most productive agricultural lands and the most densely populated areas. Rivers are numerous but short, and most are not navigable.</p></div></div><div s class=\"completo claro\"><img src=\"http://www.mofuss.unam.mx/Mapps/Global/uploads/galeria_Paises/37.jpeg\"/><div><h3>SOILS</h3><p>The soils in the mountains are thin and lose fertility quickly when cultivated. The lower hills are covered with red clays and loams. The alluvial soils of the plains and valleys are fertile but overcultivated, owing to high population densities in those areas. Deforestation has caused much soil erosion, and as much as one-third of Haitiâ€™s land may have eroded beyond recovery.</p></div></div><div s class=\"completo semiobscuro\"><img src=\"http://www.mofuss.unam.mx/Mapps/Global/uploads/galeria_Paises/25.jpg\"/><div><h3>CLIMATE</h3><p>Haiti has a warm, humid tropical climate characterized by diurnal temperature variations that are greater than the annual variations; temperatures are modified by elevation. Average temperatures range from the high 70s F (about 25 Â°C) in January and February to the mid-80s F (about 30 Â°C) in July and August. The village of Kenscoff, at some 4,700 feet (1,430 metres), has an average temperature of about 60 Â°F (16 Â°C), whereas Port-au-Prince, at sea level, has an average of 79 Â°F (26 Â°C). In winter, frost can occur at high elevations.\n\nHaiti is located on the leeward side of the island, which means that the influence of humid trade winds is not as great as in the Dominican Republic. The more humid districts are found on the northern and eastern slopes of the mountains. Some portions of the island receive less than 28 inches (700 mm) of rainfall per year. The northwestern peninsula and GonÃ¢ve Island are particularly dry. Some regions have two rainy seasons, lasting from April to June and from August to October, whereas other regions experience rainfall from May to November. Annual variations of precipitation can cause droughts, widespread crop failures, and famine.</p></div></div><div s class=\"medio obscuro\"><img src=\"http://www.mofuss.unam.mx/Mapps/Global/uploads/galeria_Paises/26.jpg\"/><div><h3>PLANT AND ANIMAL LIFE</h3><p>From the 17th to the 19th century, much of the natural vegetation was destroyed through clearing for agriculture, grazing, and logging. Deforestation accelerated during the 20th century as population increased, and the forests that once covered the country have been reduced to a tiny proportion of the total land area. Patches of virgin forest remain in the Massif de la Selle, which includes tall pines, and in the Massif de la Hotte, where an evergreen forest with giant tree ferns and orchids stands on the slopes of Macaya Peak. Bayahondes (a type of mesquite), cacti, and acacias form thorny woods on the dry plains. The mangrove swamps on the coast have also declined rapidly, as their trees have been overexploited for firewood and for the production of charcoal.</p></div></div><div s class=\"medio claro\"><img src=\"http://www.mofuss.unam.mx/Mapps/Global/uploads/galeria_Paises/24.jpg\"/><div><h3>ETHNIC GROUPS AND LANGUAGES</h3><p>Nearly all of Haitiâ€™s population are of African origin (termed blacks). A small minority of people of mixed European and African descent (called mulattoes) constitute a wealthier elite and account for most of the remainder. There is also a small number of people of European descent. Haiti has differentiated itself ethnically, linguistically, and culturally from other Caribbean and Latin American countries, notably the Spanish-speaking and the English-speaking countries of the region.</p></div></div><div s class=\"completo obscuro\"><img src=\"http://www.mofuss.unam.mx/Mapps/Global/uploads/galeria_Paises/27.jpg\"/><div><h3>RELIGION</h3><p>Haiti has no official religion, and the constitution allows for religious freedom. More than half of the population practices Roman Catholicism, the dominant sect of Christianity, and approximately one-fourth is Protestant or independent Christian. Liberation theology continues to have some influence in religious life, notably in the shantytown areas of Port-au-Prince and other towns. Most Haitian Roman Catholics are also practitioners of Vodou (Voodoo, or Vodun), a religion whose gods (lwa) are derived from West African religions. However, most of the countryâ€™s Protestants consider Christianity to be incompatible with Vodou. In addition to the older Protestant denominations established in the early 19th century (Methodists, Episcopalians, and Presbyterians), Baptists, Seventh-day Adventists, and Mormons came to Haiti during and after the period (1915â€“34) when the United States occupied the country.</p></div></div>','-72.2708','9','19.305',13,'13.png'),(14,'Alaska','Alaska','<div class=\"cuarto obscuro\"><h3>87oi</h3><p>uil</p></div>','-150.77','5','64.79',9,'14.png');
/*!40000 ALTER TABLE `paises` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `panel`
--

DROP TABLE IF EXISTS `panel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `panel` (
  `idPanel` int(6) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) DEFAULT NULL,
  `icono` varchar(30) DEFAULT NULL,
  `descripcion` text,
  `funcion` text,
  `submenu` int(6) DEFAULT NULL,
  `prioridad` int(3) DEFAULT NULL,
  PRIMARY KEY (`idPanel`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `panel`
--

LOCK TABLES `panel` WRITE;
/*!40000 ALTER TABLE `panel` DISABLE KEYS */;
INSERT INTO `panel` VALUES (1,'plus','plus','Zoom in','zoomMas(1),cierraAdvertencia()',-1,3),(13,'minus','minus','Get away','zoomMas(-1)',-1,2),(4,'road','road','Road Map','setMapa(1)',0,6),(5,'location-arrow','location-arrow','Hybrid','setMapa(4)',-1,4),(6,'globe','globe','Satellite','setMapa(2)',0,9),(7,'leaf','leaf','Terrain','setMapa(3)',0,5),(8,'draw','pencil-square-o','Draw','',0,8),(10,'poligono','bookmark','Draw Polygon','setMapa(6)',8,7),(11,'cuadro','stop','Draw rectangle','setMapa(7)',8,1),(14,'find','search','','openFind()',-1,10),(15,'calculos','calculator','operaciones','',-1,12),(16,'resta','minus','Diferencia entre capas','diferencia()',15,11),(17,'interseccion','chevron-up','','interseccion()',15,13);
/*!40000 ALTER TABLE `panel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personas`
--

DROP TABLE IF EXISTS `personas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personas` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) DEFAULT NULL,
  `apellido` varchar(30) DEFAULT NULL,
  `locacion` text,
  `descripcion` text,
  `img` varchar(50) DEFAULT NULL,
  `contacto` text,
  `graduado` tinyint(1) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `prioridad` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personas`
--

LOCK TABLES `personas` WRITE;
/*!40000 ALTER TABLE `personas` DISABLE KEYS */;
INSERT INTO `personas` VALUES (1,'AdriÃ¡n','Ghilardi','CIGA/UNAM','BiÃ³logo por la Universidad Nacional de CÃ³rdoba, Argentina (2000). RealizÃ³ un Doctorado en el CIEco-UNAM (2008) y desde 2011 es Investigador Asociado del Centro de Investigaciones en GeografÃ­a Ambiental de la UNAM.','1.jpg','aghilardi@ciga.unam.mx',1,'DR',1),(2,'Rob','Bailis','SEI','Rob is a senior scientist, focused on the relationships between energy, social welfare, and environmental change in developing countries. He first became interested in these themes while working as a teacher in the U.S. Peace Corps in northwestern Kenya. He joined SEI-US in September 2015, after a decade as an academic researcher and university instructor.','2.jpg','rob.bailis@sei-us.org',1,'DR',2),(3,'Rudi','Drigo','Wisdom','Rudi Drigo','3.png','rudi.drigo@tin.it',1,'DR',3),(4,'Jean Francois','Mas','CIGA','Investigador Titular en el Centro de Investigaciones en GeografÃ­a Ambiental. \nTiene un doctorado en PercepciÃ³n Remota / EcologÃ­a Tropical, Universidad Paul Sabatier, Toulouse, Francia y es miembro del sistema de investigaciÃ³n nacional nivel 2. Sus principales lÃ­neas de investigaciÃ³n son el monitoreo y modelado de los cambios de las coberturas/uso del suelo con base en imÃ¡genes de satÃ©lite y sistemas de informaciÃ³n geogrÃ¡fica. PublicÃ³ mÃ¡s de 50 artÃ­culos en revistas internacionales sobre estos temas. DirigiÃ³ 5 tesis de licenciatura, 12 de maestrÃ­a y 6 de doctorado.','4.jpg','jfmas@ciga.unam.mx',1,'DR',4);
/*!40000 ALTER TABLE `personas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `permissions` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrator','*'),(2,'User','');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(32) NOT NULL,
  `payload` text,
  `last_activity` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usermeta`
--

DROP TABLE IF EXISTS `usermeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usermeta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `meta_key` varchar(100) NOT NULL,
  `meta_value` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usermeta`
--

LOCK TABLES `usermeta` WRITE;
/*!40000 ALTER TABLE `usermeta` DISABLE KEYS */;
INSERT INTO `usermeta` VALUES (1,1,'last_login','2016-11-29 19:15:02'),(2,1,'last_login_ip','127.0.0.1'),(3,2,'last_login','2017-05-08 17:15:44'),(4,2,'last_login_ip','10.10.10.1'),(5,3,'prefix',''),(6,3,'first_name',''),(7,3,'last_name',''),(8,3,'display',''),(9,3,'researchertype','T'),(10,3,'researchareas',''),(11,3,'laboratory',''),(12,3,'phone',''),(13,3,'url',''),(14,3,'researchgate',''),(15,3,'gscholar',''),(16,3,'linkedin',''),(17,3,'academic',''),(18,3,'professional',''),(19,3,'researchlines',''),(20,3,'awards',''),(21,3,'students',''),(22,3,'publications',''),(23,3,'last_login','2017-05-02 21:27:29'),(24,3,'last_login_ip','10.10.10.1'),(25,2,'avatar_image','2.jpg'),(26,2,'avatar_type','image');
/*!40000 ALTER TABLE `usermeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(64) NOT NULL,
  `display_name` varchar(200) DEFAULT NULL,
  `joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `role_id` int(5) NOT NULL DEFAULT '0',
  `reminder` varchar(50) DEFAULT NULL,
  `remember` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','webmaster@localhost.dev','$2y$10$trJyrB8x2V/hKKeKJvNF0Otz6OqFgisd0fiLc7B1ssHzSvpE0ADYu','Admin','2014-08-06 22:44:27',1,1,NULL,''),(2,'cris','cris','$2y$10$To0W8b2aATOqIU2lBYlYAOlC2CkjTfC5vx2UalHJj6Qi9BQN1wzBq','cris','2016-11-29 20:24:25',1,1,NULL,''),(3,'roberto','robert@hotmail.com','$2y$10$Pg6t38nNGfqeSjcfOjQqV.mobtdJjh/qfgJ14lWbVF7OMTDgfscSO','roberto','2017-02-22 18:51:27',1,1,NULL,'');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-11 16:36:17
