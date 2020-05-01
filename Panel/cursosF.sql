-- MySQL dump 10.13  Distrib 5.1.61, for redhat-linux-gnu (i386)
--
-- Host: localhost    Database: cursos
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
-- Table structure for table `acerca_de`
--

DROP TABLE IF EXISTS `acerca_de`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acerca_de` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) CHARACTER SET utf8 NOT NULL,
  `info` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acerca_de`
--

LOCK TABLES `acerca_de` WRITE;
/*!40000 ALTER TABLE `acerca_de` DISABLE KEYS */;
INSERT INTO `acerca_de` VALUES (1,'Course Description:','The training course is based on a modeling tool called MoFuSS (Modeling Fuelwood Savings Scenarios). MoFuSS was designed to assess fuelwood-driven degradation in a variety of contexts. In short, the tool is a landscape-level computer model that simulates fuelwood harvesting in space and time, and expected regrowth of the vegetation. By means of what-if scenarios embedded within dynamic landscapes, MoFuSS can be used to account for savings in non-renewable woody biomass from reduced fuelwood consumption. Practical exercises will be conducted using datasets from Mexico and Central America, Kenya and India.\r\n\r\n                MoFuSS was developed during one of the Global Alliance for Clean Cookstoves (GACC) projects between 2013-2015: Geospatial Analysis and Modeling of Non-Renewable Biomass: WISDOM and beyond. It was built for GACC partners and other stakeholders to assess fuelwood-driven degradation in a variety of contexts. '),(2,'Objective:','Train up to 70 people (35 each day) in fuelwood modeling techniques using available data and freeware. The underlying objectives of simulations are 1) to better understand where and when fuelwood could be a driver of forests and woodland degradation in terms of aboveground biomass density and 2) serve as a decision making tool, informing local policy makers and practitioners working in the field.'),(3,'Target audience:','Anyone interested or in the need to quantify carbon savings from fuelwood reduction interventions (e.g. clean cookstoves, fuel switching, etc.). No GIS or programming skills are needed when running the model using provided default datasets.'),(4,'Registration and fees:','Register using the online form. In case of overbooking, participants will be selected by their registration date. The course has no cost for everybody. '),(5,'Outputs and Expectations:','MoFuSS has six different levels of interaction with end-users according to their expertise with spatial analysis and modeling software and techniques. The main expectation of this course is that attendants manage to build scenarios with MoFuSS for any of the provided datasets by means of a user-friendly interfase (up to Level 3).');
/*!40000 ALTER TABLE `acerca_de` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `areas` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `area` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areas`
--

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` VALUES (1,'Environmental impacts of fuelwood extraction'),(3,'Modeling patterns'),(4,'Land use/cover change'),(5,'Parallel computting'),(6,'Computational Optimizations Techniques');
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `colores`
--

DROP TABLE IF EXISTS `colores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `colores` (
  `id` int(1) NOT NULL,
  `color` varchar(10) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colores`
--

LOCK TABLES `colores` WRITE;
/*!40000 ALTER TABLE `colores` DISABLE KEYS */;
INSERT INTO `colores` VALUES (0,'#aaaaaa'),(1,'#aaaaaa'),(2,'#aaaaaa');
/*!40000 ALTER TABLE `colores` ENABLE KEYS */;
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
-- Table structure for table `contactos`
--

DROP TABLE IF EXISTS `contactos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contactos` (
  `id_reference` int(8) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `link` text COLLATE utf8_spanish_ci NOT NULL,
  `id_instructor` int(6) NOT NULL,
  PRIMARY KEY (`id_reference`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contactos`
--

LOCK TABLES `contactos` WRITE;
/*!40000 ALTER TABLE `contactos` DISABLE KEYS */;
INSERT INTO `contactos` VALUES (2,'twitter','https://twitter.com/MoFuSSfreeware?lang=en',2),(3,'facebook','https://www.facebook.com/Mofuss-203433700039152/',2),(4,'envelope','mailto:aghilardi@ciga.unam.mx',2),(5,'envelope','mailto:jfmas@ciga.unam.mx',3),(6,'facebook','https://www.facebook.com/ulises1229',4),(7,'linkedin','https://www.linkedin.com/in/ulises-olivares-pinto-0441aa8a?trk=nav_responsive_tab_profile_pic',4),(8,'envelope','mailto:uolivares@enesmorelia.unam.mx',4);
/*!40000 ALTER TABLE `contactos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `curso_instructor`
--

DROP TABLE IF EXISTS `curso_instructor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `curso_instructor` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `id_curso` int(6) NOT NULL,
  `id_instructor` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curso_instructor`
--

LOCK TABLES `curso_instructor` WRITE;
/*!40000 ALTER TABLE `curso_instructor` DISABLE KEYS */;
INSERT INTO `curso_instructor` VALUES (3,1,4),(9,1,2),(33,1,3);
/*!40000 ALTER TABLE `curso_instructor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cursos`
--

DROP TABLE IF EXISTS `cursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cursos` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `inicio` date NOT NULL,
  `final` date NOT NULL,
  `img` text,
  `lugar` text NOT NULL,
  `direccion` text NOT NULL,
  `descripcion` text,
  `color` varchar(20) NOT NULL,
  `modelo` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cursos`
--

LOCK TABLES `cursos` WRITE;
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
INSERT INTO `cursos` VALUES (1,'MofuSS','2016-11-29','2016-11-30','1.png','UNAM','@19.7131969,-101.1560842,12z','The extraction and burning of woody biomass at rates exceeding re-growth (i.e. non-renewable extraction) results in net emissions of CO2. Quantification of the amount of non-renewable woody biomass through a robust and widely applicable method is urgently needed for a wide variety of applications including cookstove carbon-offset projects, national GHG inventories, and sustainable forest management strategies under REDD+. Within this context, we developed \"MoFuSS\" (Modeling Fuelwood Savings Scenarios), a dynamic model that simulates the spatiotemporal effect of fuelwood harvesting on the landscape vegetation and that accounts for savings in non-renewable woody biomass from reduced consumption.\r\n\r\nMoFuSS and any other needed software are freely available to download and use, and all MoFuSS scripts can be opened, edited and saved using any free code editor such as Notepad++ or Sublime Text. Mofuss scripts were coded in Dinamica EGO (.egoml), R (.R), LaTeX (.tex) and Windows batch scripting (.bat).\r\n\r\nTo try MoFuSS for the country of Honduras download the User Manual Starter and follow instructions carefully. New datasets and an improved version of the model will be available soon. Stay tuned by joining our email list. \r\n\r\nThis link will provide free access to MoFuSS article in Environmental Modelling and Software until July 3, 2016. \r\n\r\nSimilar Tier 3 datasets for a handful of other countries (Mexico, Brazil, El Salvador, Kenya and Karnataka, India) are currently being \"polished\" to be uploaded before the upcoming September course at Morocco; while a pantropical dataset at Tier 1 level is being uploaded into a map-server interfase. \r\n\r\nThe first version of MoFuSS (version 1.0) was developed between September 2011 and April 2015 with funding from Global Alliance for Clean Cookstoves (UNF-12-402), Yale Institute for Biospheric Studies, Overlook International Foundation, ClimateWorks Foundation (11-0244) and UNAM\'s PAPIIT (IA101513).','#0c335f',1);
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galeria_cursos`
--

DROP TABLE IF EXISTS `galeria_cursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `galeria_cursos` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `id_curso` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galeria_cursos`
--

LOCK TABLES `galeria_cursos` WRITE;
/*!40000 ALTER TABLE `galeria_cursos` DISABLE KEYS */;
INSERT INTO `galeria_cursos` VALUES (13,'13.jpg',1),(14,'14.jpg',1),(15,'15.jpg',1),(16,'16.jpg',1);
/*!40000 ALTER TABLE `galeria_cursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horarios`
--

DROP TABLE IF EXISTS `horarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `horarios` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `hr_inicio` datetime NOT NULL,
  `hr_fin` datetime NOT NULL,
  `comentarios` text NOT NULL,
  `icono` varchar(30) NOT NULL,
  `curso` int(6) NOT NULL,
  `importance` varchar(30) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horarios`
--

LOCK TABLES `horarios` WRITE;
/*!40000 ALTER TABLE `horarios` DISABLE KEYS */;
INSERT INTO `horarios` VALUES (1,'2016-11-29 08:30:00','2016-11-29 09:00:00','Registration','fa fa-clock-o',1,NULL),(2,'2016-11-29 09:00:00','2016-11-29 09:15:00','Presentation of course objectives','fa fa-user',1,NULL),(3,'2016-11-29 09:15:00','2016-11-29 10:30:00','Installation of MoFuSS','fa fa-desktop',1,NULL),(4,'2016-11-29 10:30:00','2016-11-29 11:00:00','Run MoFuSS for a very small sample study area using the user-friendly interface; in order to clear out any bugs related to configuration','fa fa-clock-o',1,NULL),(5,'2016-11-29 11:00:00','2016-11-29 11:15:00','Coffee break','fa fa-user',1,NULL),(6,'2016-11-29 11:15:00','2016-11-29 14:00:00','Re-run MoFuSS for a \"not-so-small\" area, while understanding each tunable parameter within the user-friendly interface','fa fa-user',1,NULL),(7,'2016-11-29 14:00:00','2016-11-29 15:00:00','Lunch break','fa fa-user',1,NULL),(8,'2016-11-29 15:00:00','2016-11-29 15:30:00','Solve particular doubts and bugs from the previous exercise','fa fa-clock-o',1,NULL),(9,'2016-11-29 15:30:00','2016-11-29 16:45:00','Demonstration on how to use MoFuSS beyond level 3: adjusting most built-in parameters, adding own maps and datasets, and affecting inner geoprocessing operations','fa fa-clock-o',1,NULL),(10,'2016-11-29 16:45:00','2016-11-29 17:45:00','Closing remarks','fa fa-undefined',1,NULL);
/*!40000 ALTER TABLE `horarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instructor_area`
--

DROP TABLE IF EXISTS `instructor_area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instructor_area` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `id_area` int(6) NOT NULL,
  `id_instructor` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructor_area`
--

LOCK TABLES `instructor_area` WRITE;
/*!40000 ALTER TABLE `instructor_area` DISABLE KEYS */;
INSERT INTO `instructor_area` VALUES (1,1,2),(3,3,3),(4,4,3),(5,5,4),(6,6,4);
/*!40000 ALTER TABLE `instructor_area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instructores`
--

DROP TABLE IF EXISTS `instructores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instructores` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `info` text NOT NULL,
  `areas` varchar(20) DEFAULT NULL,
  `contacto` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `img` varchar(60) NOT NULL,
  `curso` int(6) DEFAULT NULL,
  `apellido` varchar(20) NOT NULL,
  `grado` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructores`
--

LOCK TABLES `instructores` WRITE;
/*!40000 ALTER TABLE `instructores` DISABLE KEYS */;
INSERT INTO `instructores` VALUES (2,' ADRIAN','Adrian is a Full Professor at the Environmental Geography Research Center (CIGA) of the National Autonomous University of Mexico (UNAM). His main interest is on environmental impacts of fuelwood extraction and charcoal production. Adrian designed and coded the first version of MoFuSS between 2011 and 2015, while he was a postdoctoral associate at Yale School of Forestry & Environmental Studies. Adrian holds a PhD in Natural Resource Management from UNAM.','DAGHILARDI','DAGHILARDI','2.jpg',1,'GHILARDI','DR'),(3,'JEAN-FRANÃ‡OIS','Jean-FranÃ§ois is a Full Professor at CIGA, UNAM. He is one of the world leading scientists in modeling patterns and processes of land use/cover change, and has published extensively in uncertainty and confidence in land use/cover classifications. Jean-FranÃ§ois coded key features of MoFuSS, particularly those dealing with fuelwood collection spatial projections. He holds a PhD in Remote Sensing and Tropical Ecology from University Paul Sabatier (Toulouse, France).---','DJMAS','DJMAS','3.jpg',1,'MAS','DR'),(4,'ULISES','Ulises is responsible of bioinformatics at UNAMÂ´s National School of High Studies (ENES). His main interests are optimization techniques using parallel architectures, and computer graphics. Ulises is currently optimizing MoFuSS in order to run faster, taking advantage of high-processing and parallel computing. Ulises is about to complete his PhD in Computer Sciences at the Center for Research and Advanced Studies (CINEVSTAV) of the National Polytechnic Institute (IPN)','MUOLIVARES','MUOLIVARES','4.jpg',1,'OLIVARES','MSC'),(12,'Cris','',NULL,NULL,'12.jpg',NULL,'Garcia','ISC');
/*!40000 ALTER TABLE `instructores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materiales`
--

DROP TABLE IF EXISTS `materiales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materiales` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `nombre` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `tipo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `link` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT 'no',
  `date` varchar(20) CHARACTER SET utf8 NOT NULL,
  `curso` varchar(20) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materiales`
--

LOCK TABLES `materiales` WRITE;
/*!40000 ALTER TABLE `materiales` DISABLE KEYS */;
INSERT INTO `materiales` VALUES (1,'Cover','Presentations','presentations/0_Cover.pdf','no','MoFuSS'),(2,'09:00 - 09:10 Objectives and course structure','English','presentations/900_910_Objectives and structure_EN.pdf','no','MoFuSS'),(3,'09:10 - 09:45 Woodfuel enviromental impacts in dynamics landscapes','English','presentations/910_945_Woodfuel environ impacts_EN.pdf','no','MoFuSS'),(4,'10:00 - 10:30 How does MoFuSS work?','English','presentations/1000_1030_MoFuSS_EN.pdf','no','MoFuSS'),(5,'09:10 - 09:45 ModÃ©lisation des impacts environnementaux du bois de feu dans des paysages dynamiques','FranÃ§ais','presentations/910_945_woodfuel environ impacts_FR.pdf','no','MoFuSS'),(6,'10:00 - 10:30 Comment fonctionne MoFuSS?','FranÃ§ais','presentations/1000_1030_MoFuSS_FR.pdf','no','MoFuSS'),(7,'Dinamica EGO 2.4.1','Windows Installers','installers/DinamicaEGO-241.zip','no','MoFuSS'),(8,'English','Manuals','manual/English.pdf','no','MoFuSS'),(9,'FranÃ§ais','Manuals','manual/Francais.pdf','no','MoFuSS'),(10,'MoFuSS scripts','MoFuSS','material/MoFuSS.zip','no','MoFuSS'),(11,'Scientific paper describing MoFuSS','MoFuSS','paper/mofuss.pdf','no','MoFuSS'),(12,'HaitÃ­','Tier 3 datasets','material/Haiti_MoFuSS_Dataset_v1.zip','no','MoFuSS'),(13,'Honduras','Tier 3 datasets','material/Honduras_MoFuSS_Dataset_v1.zip','no','MoFuSS'),(14,'YucatÃ¡n','Tier 3 datasets','material/Yucatan_MoFuSS_Dataset_v1.zip','no','MoFuSS'),(15,'Karnataka (India)','Tier 3 datasets','material/Karnataka_MoFuSS_Dataset_v1.zip','no','MoFuSS'),(16,'Queryable pantropical dataset','Tier 1 dataset','http://redd.ciga.unam.mx/webtool','no','MoFuSS'),(17,'09:00 - 09:10 Objectifs et structure du cours','FranÃ§ais','presentations/900_910_Objectives and structure_FR.pdf','no','MoFuSS');
/*!40000 ALTER TABLE `materiales` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usermeta`
--

LOCK TABLES `usermeta` WRITE;
/*!40000 ALTER TABLE `usermeta` DISABLE KEYS */;
INSERT INTO `usermeta` VALUES (1,1,'last_login','2017-02-15 22:27:11'),(2,1,'last_login_ip','10.10.10.1'),(3,2,'last_login','2017-05-08 20:53:00'),(4,2,'last_login_ip','10.10.10.1'),(5,1,'prefix',''),(6,1,'first_name',''),(7,1,'last_name',''),(8,1,'display',''),(9,1,'researchertype','T'),(10,1,'researchareas',''),(11,1,'laboratory',''),(12,1,'phone',''),(13,1,'url',''),(14,1,'researchgate',''),(15,1,'gscholar',''),(16,1,'linkedin',''),(17,1,'academic',''),(18,1,'professional',''),(19,1,'researchlines',''),(20,1,'awards',''),(21,1,'students',''),(22,1,'publications',''),(23,2,'prefix',''),(24,2,'first_name',''),(25,2,'last_name',''),(26,2,'display',''),(27,2,'researchertype','T'),(28,2,'researchareas',''),(29,2,'laboratory',''),(30,2,'phone',''),(31,2,'url',''),(32,2,'researchgate',''),(33,2,'gscholar',''),(34,2,'linkedin',''),(35,2,'academic',''),(36,2,'professional',''),(37,2,'researchlines',''),(38,2,'awards',''),(39,2,'students',''),(40,2,'publications',''),(41,2,'avatar_image','2.jpg'),(42,2,'avatar_type','image'),(43,3,'prefix',''),(44,3,'first_name',''),(45,3,'last_name',''),(46,3,'display',''),(47,3,'researchertype','T'),(48,3,'researchareas',''),(49,3,'laboratory',''),(50,3,'phone',''),(51,3,'url',''),(52,3,'researchgate',''),(53,3,'gscholar',''),(54,3,'linkedin',''),(55,3,'academic',''),(56,3,'professional',''),(57,3,'researchlines',''),(58,3,'awards',''),(59,3,'students',''),(60,3,'publications','');
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
INSERT INTO `users` VALUES (1,'admin','webmaster@localhost.dev','$2y$10$qGtZp/BLP5qafh48fJ4sdeNHOMwUdc/v8/aGkF4YsSjiix8JXzkvS','admin','2014-08-06 22:44:27',1,1,NULL,''),(2,'cris','cristianjgu@hotmail.com','$2y$10$YGTHe8jfvAnIAIzV49mrQurqk4lOZzXNGexgSUiCjGkIZwhu1lpye','cris','2016-11-29 20:24:25',1,1,NULL,''),(3,'Adrian','aghilardi@ciga.unam.mx','$2y$10$vJw/TXY5rtqF7TQZTZ/vUeRUmHTM5c6mKIKwsa1AuCWFkBjwpI8U6','Adrian','2017-04-16 23:48:02',1,1,NULL,'0');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venue`
--

DROP TABLE IF EXISTS `venue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `place` varchar(50) NOT NULL,
  `date` varchar(20) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `info` text NOT NULL,
  `course` varchar(50) NOT NULL,
  `img` varchar(50) NOT NULL,
  `map` text NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venue`
--

LOCK TABLES `venue` WRITE;
/*!40000 ALTER TABLE `venue` DISABLE KEYS */;
INSERT INTO `venue` VALUES (1,'Faculty Of Science, University Of Chouaib Doukalla','University of Chouaib Doukalla','08:30 AM - 05:30 PM','aghilardi@ciga.unam.mx','This course will be held at the Faculty Of Science, University of Chouaib Doukalla, Route Ben Maachou, 24000, El Jadida, Morocco. Classroom to be determined at a later date. Participants will receive an email confirmation.','MoFuSS','images/course/university.png','https://www.google.com.mx/maps/place/College+of+Science/@33.2282779,-8.4941314,16.5z/data=!4m13!1m7!3m6!1s0xda91e036ed40d71:0xf4a7ddfc3364b7ca!2suniversite+Chouaib+Doukkali!3b1!8m2!3d33.228627!4d-8.488858!3m4!1s0x0000000000000000:0x5c170598a1c18e3f!8m2!3d33.2252284!4d-8.4873328','true');
/*!40000 ALTER TABLE `venue` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-11 16:41:17
