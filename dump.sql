CREATE DATABASE  IF NOT EXISTS `mutya` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `mutya`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: mutya
-- ------------------------------------------------------
-- Server version	5.6.26

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
INSERT INTO `tblcategory` VALUES ('Casual Interview',1,0,'Prelim',20,'Casual Interview'),('Casual Interview Final',5,1,'Final',5,'Top 5 Q & A'),('Casual Interview Semi',4,1,'Semi',10,'Top 10 Q & A'),('Evening Gown',3,1,'Prelim',20,'Evening Gown'),('Swimsuit',2,1,'Prelim',20,'Swimsuit');
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
INSERT INTO `tbljudge` VALUES ('bb','Bb Gandanghari','1',0),('derek','Derek Ramsey','1',0),('ian','Ian Veneracion','1',0),('lucy','Lucy Torres Gomez','1',0),('marj','Marjorie Barreto','1',0),('ruffa','Ruffa Guttierez','1',0);
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
INSERT INTO `tblscore` VALUES (1,'Casual Interview',0,'bb'),(1,'Casual Interview',0,'derek'),(1,'Casual Interview',0,'ian'),(1,'Casual Interview',0,'lucy'),(1,'Casual Interview',0,'marj'),(1,'Casual Interview',0,'ruffa'),(1,'Casual Interview Final',92,'bb'),(1,'Casual Interview Final',95,'derek'),(1,'Casual Interview Final',90,'ian'),(1,'Casual Interview Final',80,'lucy'),(1,'Casual Interview Final',90,'marj'),(1,'Casual Interview Final',99,'ruffa'),(1,'Casual Interview Semi',90,'bb'),(1,'Casual Interview Semi',90,'derek'),(1,'Casual Interview Semi',90,'ian'),(1,'Casual Interview Semi',88,'lucy'),(1,'Casual Interview Semi',95,'marj'),(1,'Casual Interview Semi',99,'ruffa'),(1,'Evening Gown',95,'bb'),(1,'Evening Gown',95,'derek'),(1,'Evening Gown',80,'ian'),(1,'Evening Gown',91,'lucy'),(1,'Evening Gown',90,'marj'),(1,'Evening Gown',100,'ruffa'),(1,'Swimsuit',95,'bb'),(1,'Swimsuit',95,'derek'),(1,'Swimsuit',80,'ian'),(1,'Swimsuit',90,'lucy'),(1,'Swimsuit',90,'marj'),(1,'Swimsuit',98,'ruffa'),(2,'Casual Interview',0,'bb'),(2,'Casual Interview',0,'derek'),(2,'Casual Interview',0,'ian'),(2,'Casual Interview',0,'lucy'),(2,'Casual Interview',0,'marj'),(2,'Casual Interview',0,'ruffa'),(2,'Casual Interview Semi',91,'bb'),(2,'Casual Interview Semi',95,'derek'),(2,'Casual Interview Semi',70,'ian'),(2,'Casual Interview Semi',83,'lucy'),(2,'Casual Interview Semi',80,'marj'),(2,'Casual Interview Semi',85,'ruffa'),(2,'Evening Gown',85,'bb'),(2,'Evening Gown',92,'derek'),(2,'Evening Gown',85,'ian'),(2,'Evening Gown',90,'lucy'),(2,'Evening Gown',95,'marj'),(2,'Evening Gown',93,'ruffa'),(2,'Swimsuit',85,'bb'),(2,'Swimsuit',87,'derek'),(2,'Swimsuit',80,'ian'),(2,'Swimsuit',88,'lucy'),(2,'Swimsuit',85,'marj'),(2,'Swimsuit',90,'ruffa'),(3,'Casual Interview',0,'bb'),(3,'Casual Interview',0,'derek'),(3,'Casual Interview',0,'ian'),(3,'Casual Interview',0,'lucy'),(3,'Casual Interview',0,'marj'),(3,'Casual Interview',0,'ruffa'),(3,'Casual Interview Semi',92,'bb'),(3,'Casual Interview Semi',95,'derek'),(3,'Casual Interview Semi',70,'ian'),(3,'Casual Interview Semi',84,'lucy'),(3,'Casual Interview Semi',80,'marj'),(3,'Casual Interview Semi',90,'ruffa'),(3,'Evening Gown',90,'bb'),(3,'Evening Gown',90,'derek'),(3,'Evening Gown',85,'ian'),(3,'Evening Gown',90,'lucy'),(3,'Evening Gown',85,'marj'),(3,'Evening Gown',85,'ruffa'),(3,'Swimsuit',90,'bb'),(3,'Swimsuit',85,'derek'),(3,'Swimsuit',85,'ian'),(3,'Swimsuit',92,'lucy'),(3,'Swimsuit',85,'marj'),(3,'Swimsuit',90,'ruffa'),(4,'Casual Interview',0,'bb'),(4,'Casual Interview',0,'derek'),(4,'Casual Interview',0,'ian'),(4,'Casual Interview',0,'lucy'),(4,'Casual Interview',0,'marj'),(4,'Casual Interview',0,'ruffa'),(4,'Evening Gown',80,'bb'),(4,'Evening Gown',85,'derek'),(4,'Evening Gown',80,'ian'),(4,'Evening Gown',84,'lucy'),(4,'Evening Gown',80,'marj'),(4,'Evening Gown',80,'ruffa'),(4,'Swimsuit',80,'bb'),(4,'Swimsuit',80,'derek'),(4,'Swimsuit',70,'ian'),(4,'Swimsuit',85,'lucy'),(4,'Swimsuit',80,'marj'),(4,'Swimsuit',80,'ruffa'),(5,'Casual Interview',0,'bb'),(5,'Casual Interview',0,'derek'),(5,'Casual Interview',0,'ian'),(5,'Casual Interview',0,'lucy'),(5,'Casual Interview',0,'marj'),(5,'Casual Interview',0,'ruffa'),(5,'Evening Gown',87,'bb'),(5,'Evening Gown',82,'derek'),(5,'Evening Gown',90,'ian'),(5,'Evening Gown',82,'lucy'),(5,'Evening Gown',90,'marj'),(5,'Evening Gown',83,'ruffa'),(5,'Swimsuit',84,'bb'),(5,'Swimsuit',85,'derek'),(5,'Swimsuit',80,'ian'),(5,'Swimsuit',84,'lucy'),(5,'Swimsuit',85,'marj'),(5,'Swimsuit',79,'ruffa'),(6,'Casual Interview',0,'bb'),(6,'Casual Interview',0,'derek'),(6,'Casual Interview',0,'ian'),(6,'Casual Interview',0,'lucy'),(6,'Casual Interview',0,'marj'),(6,'Casual Interview',0,'ruffa'),(6,'Evening Gown',86,'bb'),(6,'Evening Gown',80,'derek'),(6,'Evening Gown',80,'ian'),(6,'Evening Gown',82,'lucy'),(6,'Evening Gown',80,'marj'),(6,'Evening Gown',79,'ruffa'),(6,'Swimsuit',83,'bb'),(6,'Swimsuit',82,'derek'),(6,'Swimsuit',75,'ian'),(6,'Swimsuit',80,'lucy'),(6,'Swimsuit',80,'marj'),(6,'Swimsuit',79,'ruffa'),(7,'Casual Interview',0,'bb'),(7,'Casual Interview',0,'derek'),(7,'Casual Interview',0,'ian'),(7,'Casual Interview',0,'lucy'),(7,'Casual Interview',0,'marj'),(7,'Casual Interview',0,'ruffa'),(7,'Casual Interview Final',90,'bb'),(7,'Casual Interview Final',95,'derek'),(7,'Casual Interview Final',70,'ian'),(7,'Casual Interview Final',80,'lucy'),(7,'Casual Interview Final',85,'marj'),(7,'Casual Interview Final',95,'ruffa'),(7,'Casual Interview Semi',88,'bb'),(7,'Casual Interview Semi',92,'derek'),(7,'Casual Interview Semi',85,'ian'),(7,'Casual Interview Semi',83,'lucy'),(7,'Casual Interview Semi',85,'marj'),(7,'Casual Interview Semi',95,'ruffa'),(7,'Evening Gown',90,'bb'),(7,'Evening Gown',85,'derek'),(7,'Evening Gown',85,'ian'),(7,'Evening Gown',88,'lucy'),(7,'Evening Gown',90,'marj'),(7,'Evening Gown',90,'ruffa'),(7,'Swimsuit',90,'bb'),(7,'Swimsuit',87,'derek'),(7,'Swimsuit',85,'ian'),(7,'Swimsuit',90,'lucy'),(7,'Swimsuit',85,'marj'),(7,'Swimsuit',89,'ruffa'),(8,'Casual Interview',0,'bb'),(8,'Casual Interview',0,'derek'),(8,'Casual Interview',0,'ian'),(8,'Casual Interview',0,'lucy'),(8,'Casual Interview',0,'marj'),(8,'Casual Interview',0,'ruffa'),(8,'Evening Gown',80,'bb'),(8,'Evening Gown',80,'derek'),(8,'Evening Gown',75,'ian'),(8,'Evening Gown',80,'lucy'),(8,'Evening Gown',90,'marj'),(8,'Evening Gown',79,'ruffa'),(8,'Swimsuit',82,'bb'),(8,'Swimsuit',82,'derek'),(8,'Swimsuit',80,'ian'),(8,'Swimsuit',88,'lucy'),(8,'Swimsuit',80,'marj'),(8,'Swimsuit',79,'ruffa'),(9,'Casual Interview',0,'bb'),(9,'Casual Interview',0,'derek'),(9,'Casual Interview',0,'ian'),(9,'Casual Interview',0,'lucy'),(9,'Casual Interview',0,'marj'),(9,'Casual Interview',0,'ruffa'),(9,'Evening Gown',88,'bb'),(9,'Evening Gown',85,'derek'),(9,'Evening Gown',80,'ian'),(9,'Evening Gown',85,'lucy'),(9,'Evening Gown',80,'marj'),(9,'Evening Gown',80,'ruffa'),(9,'Swimsuit',83,'bb'),(9,'Swimsuit',86,'derek'),(9,'Swimsuit',80,'ian'),(9,'Swimsuit',82,'lucy'),(9,'Swimsuit',95,'marj'),(9,'Swimsuit',80,'ruffa'),(10,'Casual Interview',0,'bb'),(10,'Casual Interview',0,'derek'),(10,'Casual Interview',0,'ian'),(10,'Casual Interview',0,'lucy'),(10,'Casual Interview',0,'marj'),(10,'Casual Interview',0,'ruffa'),(10,'Casual Interview Final',90,'bb'),(10,'Casual Interview Final',90,'derek'),(10,'Casual Interview Final',85,'ian'),(10,'Casual Interview Final',82,'lucy'),(10,'Casual Interview Final',95,'marj'),(10,'Casual Interview Final',94,'ruffa'),(10,'Casual Interview Semi',93,'bb'),(10,'Casual Interview Semi',93,'derek'),(10,'Casual Interview Semi',75,'ian'),(10,'Casual Interview Semi',86,'lucy'),(10,'Casual Interview Semi',95,'marj'),(10,'Casual Interview Semi',83,'ruffa'),(10,'Evening Gown',86,'bb'),(10,'Evening Gown',85,'derek'),(10,'Evening Gown',70,'ian'),(10,'Evening Gown',85,'lucy'),(10,'Evening Gown',90,'marj'),(10,'Evening Gown',89,'ruffa'),(10,'Swimsuit',87,'bb'),(10,'Swimsuit',84,'derek'),(10,'Swimsuit',80,'ian'),(10,'Swimsuit',85,'lucy'),(10,'Swimsuit',95,'marj'),(10,'Swimsuit',93,'ruffa'),(11,'Casual Interview',0,'bb'),(11,'Casual Interview',0,'derek'),(11,'Casual Interview',0,'ian'),(11,'Casual Interview',0,'lucy'),(11,'Casual Interview',0,'marj'),(11,'Casual Interview',0,'ruffa'),(11,'Evening Gown',84,'bb'),(11,'Evening Gown',86,'derek'),(11,'Evening Gown',80,'ian'),(11,'Evening Gown',84,'lucy'),(11,'Evening Gown',80,'marj'),(11,'Evening Gown',89,'ruffa'),(11,'Swimsuit',82,'bb'),(11,'Swimsuit',87,'derek'),(11,'Swimsuit',80,'ian'),(11,'Swimsuit',82,'lucy'),(11,'Swimsuit',85,'marj'),(11,'Swimsuit',89,'ruffa'),(12,'Casual Interview',0,'bb'),(12,'Casual Interview',0,'derek'),(12,'Casual Interview',0,'ian'),(12,'Casual Interview',0,'lucy'),(12,'Casual Interview',0,'marj'),(12,'Casual Interview',0,'ruffa'),(12,'Casual Interview Semi',87,'bb'),(12,'Casual Interview Semi',85,'derek'),(12,'Casual Interview Semi',70,'ian'),(12,'Casual Interview Semi',83,'lucy'),(12,'Casual Interview Semi',80,'marj'),(12,'Casual Interview Semi',79,'ruffa'),(12,'Evening Gown',90,'bb'),(12,'Evening Gown',85,'derek'),(12,'Evening Gown',85,'ian'),(12,'Evening Gown',85,'lucy'),(12,'Evening Gown',90,'marj'),(12,'Evening Gown',90,'ruffa'),(12,'Swimsuit',88,'bb'),(12,'Swimsuit',87,'derek'),(12,'Swimsuit',80,'ian'),(12,'Swimsuit',85,'lucy'),(12,'Swimsuit',85,'marj'),(12,'Swimsuit',88,'ruffa'),(13,'Casual Interview',0,'bb'),(13,'Casual Interview',0,'derek'),(13,'Casual Interview',0,'ian'),(13,'Casual Interview',0,'lucy'),(13,'Casual Interview',0,'marj'),(13,'Casual Interview',0,'ruffa'),(13,'Casual Interview Semi',92,'bb'),(13,'Casual Interview Semi',88,'derek'),(13,'Casual Interview Semi',75,'ian'),(13,'Casual Interview Semi',86,'lucy'),(13,'Casual Interview Semi',80,'marj'),(13,'Casual Interview Semi',80,'ruffa'),(13,'Evening Gown',88,'bb'),(13,'Evening Gown',85,'derek'),(13,'Evening Gown',80,'ian'),(13,'Evening Gown',91,'lucy'),(13,'Evening Gown',85,'marj'),(13,'Evening Gown',89,'ruffa'),(13,'Swimsuit',89,'bb'),(13,'Swimsuit',86,'derek'),(13,'Swimsuit',85,'ian'),(13,'Swimsuit',90,'lucy'),(13,'Swimsuit',90,'marj'),(13,'Swimsuit',90,'ruffa'),(14,'Casual Interview',0,'bb'),(14,'Casual Interview',0,'derek'),(14,'Casual Interview',0,'ian'),(14,'Casual Interview',0,'lucy'),(14,'Casual Interview',0,'marj'),(14,'Casual Interview',0,'ruffa'),(14,'Casual Interview Final',80,'bb'),(14,'Casual Interview Final',85,'derek'),(14,'Casual Interview Final',70,'ian'),(14,'Casual Interview Final',75,'lucy'),(14,'Casual Interview Final',85,'marj'),(14,'Casual Interview Final',90,'ruffa'),(14,'Casual Interview Semi',88,'bb'),(14,'Casual Interview Semi',88,'derek'),(14,'Casual Interview Semi',85,'ian'),(14,'Casual Interview Semi',86,'lucy'),(14,'Casual Interview Semi',90,'marj'),(14,'Casual Interview Semi',90,'ruffa'),(14,'Evening Gown',87,'bb'),(14,'Evening Gown',87,'derek'),(14,'Evening Gown',95,'ian'),(14,'Evening Gown',90,'lucy'),(14,'Evening Gown',90,'marj'),(14,'Evening Gown',87,'ruffa'),(14,'Swimsuit',85,'bb'),(14,'Swimsuit',82,'derek'),(14,'Swimsuit',90,'ian'),(14,'Swimsuit',88,'lucy'),(14,'Swimsuit',98,'marj'),(14,'Swimsuit',85,'ruffa'),(15,'Casual Interview',0,'bb'),(15,'Casual Interview',0,'derek'),(15,'Casual Interview',0,'ian'),(15,'Casual Interview',0,'lucy'),(15,'Casual Interview',0,'marj'),(15,'Casual Interview',0,'ruffa'),(15,'Evening Gown',85,'bb'),(15,'Evening Gown',84,'derek'),(15,'Evening Gown',85,'ian'),(15,'Evening Gown',88,'lucy'),(15,'Evening Gown',85,'marj'),(15,'Evening Gown',80,'ruffa'),(15,'Swimsuit',90,'bb'),(15,'Swimsuit',80,'derek'),(15,'Swimsuit',80,'ian'),(15,'Swimsuit',80,'lucy'),(15,'Swimsuit',85,'marj'),(15,'Swimsuit',86,'ruffa'),(16,'Casual Interview',0,'bb'),(16,'Casual Interview',0,'derek'),(16,'Casual Interview',0,'ian'),(16,'Casual Interview',0,'lucy'),(16,'Casual Interview',0,'marj'),(16,'Casual Interview',0,'ruffa'),(16,'Evening Gown',88,'bb'),(16,'Evening Gown',82,'derek'),(16,'Evening Gown',75,'ian'),(16,'Evening Gown',83,'lucy'),(16,'Evening Gown',80,'marj'),(16,'Evening Gown',88,'ruffa'),(16,'Swimsuit',83,'bb'),(16,'Swimsuit',82,'derek'),(16,'Swimsuit',80,'ian'),(16,'Swimsuit',80,'lucy'),(16,'Swimsuit',80,'marj'),(16,'Swimsuit',90,'ruffa'),(17,'Casual Interview',0,'bb'),(17,'Casual Interview',0,'derek'),(17,'Casual Interview',0,'ian'),(17,'Casual Interview',0,'lucy'),(17,'Casual Interview',0,'marj'),(17,'Casual Interview',0,'ruffa'),(17,'Evening Gown',87,'bb'),(17,'Evening Gown',82,'derek'),(17,'Evening Gown',75,'ian'),(17,'Evening Gown',90,'lucy'),(17,'Evening Gown',95,'marj'),(17,'Evening Gown',80,'ruffa'),(17,'Swimsuit',94,'bb'),(17,'Swimsuit',87,'derek'),(17,'Swimsuit',85,'ian'),(17,'Swimsuit',90,'lucy'),(17,'Swimsuit',80,'marj'),(17,'Swimsuit',83,'ruffa'),(18,'Casual Interview',0,'bb'),(18,'Casual Interview',0,'derek'),(18,'Casual Interview',0,'ian'),(18,'Casual Interview',0,'lucy'),(18,'Casual Interview',0,'marj'),(18,'Casual Interview',0,'ruffa'),(18,'Casual Interview Semi',93,'bb'),(18,'Casual Interview Semi',90,'derek'),(18,'Casual Interview Semi',80,'ian'),(18,'Casual Interview Semi',88,'lucy'),(18,'Casual Interview Semi',80,'marj'),(18,'Casual Interview Semi',85,'ruffa'),(18,'Evening Gown',93,'bb'),(18,'Evening Gown',87,'derek'),(18,'Evening Gown',80,'ian'),(18,'Evening Gown',92,'lucy'),(18,'Evening Gown',85,'marj'),(18,'Evening Gown',89,'ruffa'),(18,'Swimsuit',91,'bb'),(18,'Swimsuit',88,'derek'),(18,'Swimsuit',85,'ian'),(18,'Swimsuit',92,'lucy'),(18,'Swimsuit',90,'marj'),(18,'Swimsuit',80,'ruffa'),(19,'Casual Interview',0,'bb'),(19,'Casual Interview',0,'derek'),(19,'Casual Interview',0,'ian'),(19,'Casual Interview',0,'lucy'),(19,'Casual Interview',0,'marj'),(19,'Casual Interview',0,'ruffa'),(19,'Evening Gown',93,'bb'),(19,'Evening Gown',85,'derek'),(19,'Evening Gown',80,'ian'),(19,'Evening Gown',84,'lucy'),(19,'Evening Gown',80,'marj'),(19,'Evening Gown',85,'ruffa'),(19,'Swimsuit',92,'bb'),(19,'Swimsuit',84,'derek'),(19,'Swimsuit',80,'ian'),(19,'Swimsuit',83,'lucy'),(19,'Swimsuit',80,'marj'),(19,'Swimsuit',83,'ruffa'),(20,'Casual Interview',0,'bb'),(20,'Casual Interview',0,'derek'),(20,'Casual Interview',0,'ian'),(20,'Casual Interview',0,'lucy'),(20,'Casual Interview',0,'marj'),(20,'Casual Interview',0,'ruffa'),(20,'Casual Interview Final',91,'bb'),(20,'Casual Interview Final',95,'derek'),(20,'Casual Interview Final',80,'ian'),(20,'Casual Interview Final',98,'lucy'),(20,'Casual Interview Final',80,'marj'),(20,'Casual Interview Final',96,'ruffa'),(20,'Casual Interview Semi',89,'bb'),(20,'Casual Interview Semi',90,'derek'),(20,'Casual Interview Semi',80,'ian'),(20,'Casual Interview Semi',87,'lucy'),(20,'Casual Interview Semi',85,'marj'),(20,'Casual Interview Semi',96,'ruffa'),(20,'Evening Gown',95,'bb'),(20,'Evening Gown',96,'derek'),(20,'Evening Gown',80,'ian'),(20,'Evening Gown',92,'lucy'),(20,'Evening Gown',90,'marj'),(20,'Evening Gown',100,'ruffa'),(20,'Swimsuit',95,'bb'),(20,'Swimsuit',96,'derek'),(20,'Swimsuit',85,'ian'),(20,'Swimsuit',94,'lucy'),(20,'Swimsuit',80,'marj'),(20,'Swimsuit',95,'ruffa');
/*!40000 ALTER TABLE `tblscore` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltempscore`
--

DROP TABLE IF EXISTS `tbltempscore`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbltempscore` (
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
-- Dumping data for table `tbltempscore`
--

LOCK TABLES `tbltempscore` WRITE;
/*!40000 ALTER TABLE `tbltempscore` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltempscore` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-04  9:20:57
