CREATE DATABASE  IF NOT EXISTS `mutya` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `mutya`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: 10.10.4.11    Database: mutya
-- ------------------------------------------------------
-- Server version	5.1.73

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
-- Table structure for table `tblTempScore`
--

DROP TABLE IF EXISTS `tblTempScore`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblTempScore` (
  `pk_tempScore` int(11) NOT NULL AUTO_INCREMENT,
  `fk_username` varchar(45) DEFAULT NULL,
  `fk_category` varchar(45) DEFAULT NULL,
  `score` decimal(10,0) DEFAULT NULL,
  `fk_candidate` int(11) DEFAULT NULL,
  PRIMARY KEY (`pk_tempScore`),
  KEY `fk_judgeysername_idx` (`fk_username`),
  KEY `fk_category1_idx` (`fk_category`),
  CONSTRAINT `fk_category1` FOREIGN KEY (`fk_category`) REFERENCES `tblcategory` (`pk_category`) ON UPDATE CASCADE,
  CONSTRAINT `fk_judgeysername` FOREIGN KEY (`fk_username`) REFERENCES `tbljudge` (`pk_username`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblTempScore`
--

LOCK TABLES `tblTempScore` WRITE;
/*!40000 ALTER TABLE `tblTempScore` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblTempScore` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcandidate`
--

DROP TABLE IF EXISTS `tblcandidate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblcandidate` (
  `pk_number` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `municipality` varchar(45) NOT NULL,
  `age` int(11) NOT NULL,
  `stat` varchar(45) NOT NULL,
  `prof_image` varchar(45) DEFAULT NULL,
  `nick` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`pk_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcandidate`
--

LOCK TABLES `tblcandidate` WRITE;
/*!40000 ALTER TABLE `tblcandidate` DISABLE KEYS */;
INSERT INTO `tblcandidate` VALUES (1,'Trizha B. Ocampo','AGOO',22,'',NULL,'TRIZH'),(2,'Noeda Jane C. Estalilla','ARINGAY',18,'',NULL,'JANE'),(3,'Mae Angelic C. Dawara','BACNOTAN',23,'',NULL,'ANGELIC'),(4,'Kahreen Lou Mondina','BAGULIN',19,'',NULL,'KARA'),(5,'Camille N. Familaran','BALAOAN',19,'',NULL,'CAMILLE'),(6,'Patricia Mae A. Sanglay','BANGAR',21,'',NULL,'TEESHA'),(7,'Danica Flor A. Madayag','BAUANG',17,'',NULL,'IKANG'),(8,'Dianne Arra A. Saculles','BURGOS',21,'',NULL,'DIANNE'),(9,'Ruth Stephani E. Cacapit','CABA',23,'',NULL,'STEPH'),(10,'Angelika Mae N.Pagaduan','LUNA',17,'',NULL,'MAI MAI'),(11,'Nathalie R. Nicolas','NAGUILIAN',19,'',NULL,'TALENG'),(12,'Danibelle B. Baguyos','PUGO',16,'',NULL,'DANA'),(13,'Paula Grace F. Picardal','ROSARIO',20,'',NULL,'PAU'),(14,'Michelle R. Munar','SAN FERNANDO',21,'',NULL,'CHEE'),(15,'Melody C. Buscayno','SAN GABRIEL',20,'',NULL,'MELOU'),(16,'Leny Grace C. Tawagon','SAN JUAN',20,'',NULL,'LENY'),(17,'Katherine Joy O. Adona','SANTOL',21,'',NULL,'KAT-KAT'),(18,'Eidrian G. Balcita','SANTO TOMAS',20,'',NULL,'DANG'),(19,'Maricris S.Monte','SUDIPEN',19,'',NULL,'MATET'),(20,'Dea Amor L. Refuerzo','TUBAO',18,'',NULL,'AMOR');
/*!40000 ALTER TABLE `tblcandidate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcategory`
--

DROP TABLE IF EXISTS `tblcategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblcategory` (
  `pk_category` varchar(45) NOT NULL,
  `category_sort` int(11) NOT NULL,
  `enable_status` int(11) DEFAULT NULL,
  `category_kind` varchar(45) DEFAULT NULL,
  `con_count` int(11) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`pk_category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcategory`
--

LOCK TABLES `tblcategory` WRITE;
/*!40000 ALTER TABLE `tblcategory` DISABLE KEYS */;
INSERT INTO `tblcategory` VALUES ('Casual Interview',1,1,'Prelim',20,'Casual Interview'),('Casual Interview Final',5,1,'Final',5,'Top 5 Q & A'),('Casual Interview Semi',4,1,'Semi',10,'Top 10 Q & A'),('Evening Gown',3,1,'Prelim',20,'Evening Gown'),('Swimsuit',2,1,'Prelim',20,'Swimsuit');
/*!40000 ALTER TABLE `tblcategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbljudge`
--

DROP TABLE IF EXISTS `tbljudge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbljudge` (
  `pk_username` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `help` int(11) DEFAULT '0',
  PRIMARY KEY (`pk_username`),
  UNIQUE KEY `username_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbljudge`
--

LOCK TABLES `tbljudge` WRITE;
/*!40000 ALTER TABLE `tbljudge` DISABLE KEYS */;
INSERT INTO `tbljudge` VALUES ('tj','Terry John Apigo','1234',1);
/*!40000 ALTER TABLE `tbljudge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblscore`
--

DROP TABLE IF EXISTS `tblscore`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblscore` (
  `fk_tblcandidate_pknumber` int(11) NOT NULL,
  `fk_category_pkcategory` varchar(45) NOT NULL,
  `score` int(11) NOT NULL,
  `fk_tbljudge_pkname` varchar(45) NOT NULL,
  UNIQUE KEY `unique` (`fk_tblcandidate_pknumber`,`fk_category_pkcategory`,`fk_tbljudge_pkname`),
  KEY `fk_tbljudge_uname_idx` (`fk_tbljudge_pkname`),
  CONSTRAINT `fk_judgename` FOREIGN KEY (`fk_tbljudge_pkname`) REFERENCES `tbljudge` (`pk_username`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblscore`
--

LOCK TABLES `tblscore` WRITE;
/*!40000 ALTER TABLE `tblscore` DISABLE KEYS */;
INSERT INTO `tblscore` VALUES (1,'Casual Interview',0,'tj'),(1,'Evening Gown',92,'tj'),(1,'Swimsuit',75,'tj'),(2,'Casual Interview',0,'tj'),(2,'Evening Gown',91,'tj'),(2,'Swimsuit',76,'tj'),(3,'Casual Interview',0,'tj'),(3,'Evening Gown',90,'tj'),(3,'Swimsuit',77,'tj'),(4,'Casual Interview',0,'tj'),(4,'Evening Gown',90,'tj'),(4,'Swimsuit',78,'tj'),(5,'Casual Interview',0,'tj'),(5,'Evening Gown',90,'tj'),(5,'Swimsuit',78,'tj'),(6,'Casual Interview',0,'tj'),(6,'Evening Gown',89,'tj'),(6,'Swimsuit',79,'tj'),(7,'Casual Interview',0,'tj'),(7,'Evening Gown',88,'tj'),(7,'Swimsuit',80,'tj'),(8,'Casual Interview',0,'tj'),(8,'Evening Gown',87,'tj'),(8,'Swimsuit',81,'tj'),(9,'Casual Interview',0,'tj'),(9,'Evening Gown',86,'tj'),(9,'Swimsuit',82,'tj'),(10,'Casual Interview',0,'tj'),(10,'Evening Gown',85,'tj'),(10,'Swimsuit',83,'tj'),(11,'Casual Interview',0,'tj'),(11,'Evening Gown',84,'tj'),(11,'Swimsuit',84,'tj'),(12,'Casual Interview',0,'tj'),(12,'Evening Gown',83,'tj'),(12,'Swimsuit',85,'tj'),(13,'Casual Interview',0,'tj'),(13,'Evening Gown',82,'tj'),(13,'Swimsuit',86,'tj'),(14,'Casual Interview',0,'tj'),(14,'Evening Gown',81,'tj'),(14,'Swimsuit',87,'tj'),(15,'Casual Interview',0,'tj'),(15,'Evening Gown',80,'tj'),(15,'Swimsuit',88,'tj'),(16,'Casual Interview',0,'tj'),(16,'Evening Gown',79,'tj'),(16,'Swimsuit',89,'tj'),(17,'Casual Interview',0,'tj'),(17,'Evening Gown',78,'tj'),(17,'Swimsuit',90,'tj'),(18,'Casual Interview',0,'tj'),(18,'Evening Gown',77,'tj'),(18,'Swimsuit',90,'tj'),(19,'Casual Interview',0,'tj'),(19,'Evening Gown',76,'tj'),(19,'Swimsuit',91,'tj'),(20,'Casual Interview',0,'tj'),(20,'Evening Gown',75,'tj'),(20,'Swimsuit',92,'tj');
/*!40000 ALTER TABLE `tblscore` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'mutya'
--

--
-- Dumping routines for database 'mutya'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-01 17:19:41
