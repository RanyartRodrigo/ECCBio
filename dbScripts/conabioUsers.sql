-- MySQL dump 10.13  Distrib 5.6.43, for Linux (x86_64)
--
-- Host: localhost    Database: conabio
-- ------------------------------------------------------
-- Server version	5.6.43

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
  `country` int(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,'roberto','robert@hotmail.com','$2y$10$$$$$$$$$$$$$$$$$$$$$$.fTMgXXighVFI/3wNWzNbdE3KlvrRdM.','roberto','2017-02-22 18:51:27',1,1,NULL,'',-1),(5,'ranyart','ranyart.rodrigo@gmail.com','$2y$10$mGq3XgbNTp76F/4jcoLYMejGrYWApTzJfRrCcGaG8zvmW9yvVABwK','ranyart','2018-05-11 03:03:09',1,1,NULL,'',1),(6,'jlcaballero','jlcaballerobios@gmail.com','$2y$10$$$$$$$$$$$$$$$$$$$$$$.gLaYZgcC/Zx.QbQK4hzQKYFqetgrCNG','jlcaballero','2018-05-11 08:20:50',1,3,NULL,'',NULL),(7,'dramirez','dramirez@conabio.gob.mx','$2y$10$quZeFnqKB.87YUc53RTFdeZ6LA2aBvh6Y1IkjInIMnqmxZcdlcHs2','dramirez','2018-11-14 18:28:35',1,1,NULL,'',1),(8,'acuervo','acuervo@conabio.gob.mx','$2y$10$5IXG4A1ezFHsdk3Is6pM2.ln2ooISdYQIuaIwIl74j9y5XqpFdJeW','acuervo','2018-11-14 18:29:01',1,1,NULL,'0',1),(9,'jalarcon','jalarcon@conabio.gob.mx','$2y$10$JgSYTqKCSweMIdF4R/i/BO5xN9Z7BnfqJJHnt/YNeXrmbXpH4gR.6','jalarcon','2018-11-14 18:29:23',1,1,NULL,'0',1),(10,'ogodinez','ogodinez@conabio.gob.mx','$2y$10$ZIDHv7foOZiBrWIrit0WgOGeISGUEnnSA8.7ExHd.0P6XWSjS7DGm','ogodinez','2018-11-14 18:29:50',1,1,NULL,'',1),(11,'turquiza','turquiza@conabio.gob.mx','$2y$10$quAkf6O2E4EX9yiL90RZLOV7eTDHfqCUcxSDWoMv59gqKcunv1o6q','turquiza','2018-11-14 18:30:22',1,1,NULL,'',1),(12,'Wolke','wtobon@conabio.gob.mx','$2y$10$OKf7Nutff5QKd3wNt637TeQ9XcvDY6F4ywdW4q5cpQ/hH144rFoIe','wtobon','2018-11-14 18:30:49',1,1,NULL,'',1),(13,'sruiz','sruiz@conabio.gob.mx','$2y$10$jXAUrODgXE5sv/ZNJ2qNpu0gDmlkS0A4O90s6sQGMUbW8CCs6u0qe','sruiz','2018-11-14 18:31:04',1,1,NULL,'0',1);
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

-- Dump completed on 2020-06-10 20:39:21
