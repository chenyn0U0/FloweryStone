CREATE DATABASE  IF NOT EXISTS `s1425535` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `s1425535`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: playground.eca.ed.ac.uk    Database: s1425535
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
-- Table structure for table `bigmonsters`
--

DROP TABLE IF EXISTS `bigmonsters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bigmonsters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ownerNum` varchar(45) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `houseid` varchar(45) NOT NULL,
  `finished` int(1) DEFAULT '0',
  `adopttime` varchar(45) NOT NULL,
  `adoptip` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bigmonsters`
--

LOCK TABLES `bigmonsters` WRITE;
/*!40000 ALTER TABLE `bigmonsters` DISABLE KEYS */;
INSERT INTO `bigmonsters` VALUES (31,'07510942062','Dynamic Web Design','John Lee','1',0,'2015-02-27 20:36:25','172.20.185.94'),(30,'07510942062','a new project','I am just a new project!','1',0,'2015-02-27 20:13:16','172.20.50.129'),(29,'07510942062','yoyoyoyoyoyo','lallalalalal','3',0,'2015-02-27 20:05:35','172.20.50.129'),(28,'07510942062','Design with data','data and data','2',0,'2015-02-27 20:05:28','172.20.50.129'),(27,'07955862092','Dynamic Web Design','','2',0,'2015-02-27 20:01:50','172.20.185.94'),(26,'07510942062','Buy some food','buy food!','3',0,'2015-02-27 20:01:32','172.20.50.129');
/*!40000 ALTER TABLE `bigmonsters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedhistory`
--

DROP TABLE IF EXISTS `feedhistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedhistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `smallmonsterid` int(11) NOT NULL,
  `starttime` datetime NOT NULL,
  `ip` varchar(45) NOT NULL,
  `finished` int(1) NOT NULL DEFAULT '0',
  `finishtime` datetime DEFAULT NULL,
  `acturalduration` varchar(45) DEFAULT '0:00',
  `attemptionforquit` varchar(300) DEFAULT NULL,
  `satisfied` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedhistory`
--

LOCK TABLES `feedhistory` WRITE;
/*!40000 ALTER TABLE `feedhistory` DISABLE KEYS */;
INSERT INTO `feedhistory` VALUES (11,39,'2015-02-27 20:02:40','172.20.50.129',0,NULL,'0:00',NULL,0),(12,40,'2015-02-27 20:02:59','172.20.185.94',1,'2015-02-27 20:05:27','0:00',NULL,1),(13,43,'2015-02-27 20:05:48','172.20.185.94',0,NULL,'0:00',NULL,0),(14,43,'2015-02-27 20:05:59','172.20.185.94',1,'2015-02-27 20:06:32','0:00',NULL,1),(15,42,'2015-02-27 20:07:16','172.20.185.94',1,'2015-02-27 20:07:37','0:00',NULL,1),(16,50,'2015-02-27 20:11:22','172.20.185.94',0,NULL,'0:00',NULL,0),(17,53,'2015-02-27 20:14:48','172.20.50.129',1,'2015-02-27 20:15:57','0:00',NULL,1),(18,53,'2015-02-27 20:28:19','172.20.185.94',1,'2015-02-27 20:28:53','0:00',NULL,1),(19,53,'2015-02-27 20:29:10','172.20.185.94',1,'2015-02-27 20:29:43','0:00',NULL,1),(20,53,'2015-02-27 20:29:54','172.20.185.94',1,'2015-02-27 20:32:24','0:00',NULL,1),(21,50,'2015-02-27 20:36:38','172.20.185.94',0,NULL,'0:00',NULL,0),(22,55,'2015-02-27 20:37:54','172.20.185.94',0,NULL,'0:00',NULL,0);
/*!40000 ALTER TABLE `feedhistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `houseinfo`
--

DROP TABLE IF EXISTS `houseinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `houseinfo` (
  `houseid` int(11) NOT NULL,
  `housepic` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`houseid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `houseinfo`
--

LOCK TABLES `houseinfo` WRITE;
/*!40000 ALTER TABLE `houseinfo` DISABLE KEYS */;
INSERT INTO `houseinfo` VALUES (1,'img/house/house1.png'),(2,'img/house/house2.png'),(3,'img/house/house3.png');
/*!40000 ALTER TABLE `houseinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `smallmonsters`
--

DROP TABLE IF EXISTS `smallmonsters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `smallmonsters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bigmonsterID` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  `smallmonsterID` varchar(45) NOT NULL,
  `totaltime` varchar(45) DEFAULT '00:00:00',
  `pizzaamount` int(11) DEFAULT '0',
  `finished` int(1) DEFAULT '0',
  `adopttime` varchar(45) DEFAULT NULL,
  `adoptip` varchar(45) DEFAULT NULL,
  `finishedtime` varchar(45) DEFAULT NULL,
  `finishedip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `smallmonsters`
--

LOCK TABLES `smallmonsters` WRITE;
/*!40000 ALTER TABLE `smallmonsters` DISABLE KEYS */;
INSERT INTO `smallmonsters` VALUES (39,'26','[Finished!] new monster','safds','4','00:00:00',10,1,'2015-02-27 20:02:00','172.20.50.129','2015-02-27 20:05:07','172.20.50.129'),(40,'27','[Finished!] API','due date: tonight','1','00:00:00',1,1,'2015-02-27 20:02:09','172.20.185.94','2015-02-27 20:05:37','172.20.185.94'),(41,'26','[Finished!] a little delay of network','~~~~~~~~~~~~','3','00:00:00',3,1,'2015-02-27 20:02:24','172.20.50.129','2015-02-27 20:05:02','172.20.50.129'),(42,'27','[Finished!] prototype','','2','00:00:00',1,1,'2015-02-27 20:02:25','172.20.185.94','2015-02-27 20:07:44','172.20.185.94'),(43,'27','[Finished!] ps','','1','00:00:00',1,1,'2015-02-27 20:02:32','172.20.185.94','2015-02-27 20:06:49','172.20.185.94'),(44,'27','web','','3','00:00:00',0,0,'2015-02-27 20:02:50','172.20.185.94',NULL,NULL),(38,'26','[Finished!] make a list','a list is a decision!','1','00:00:00',5,1,'2015-02-27 20:01:51','172.20.50.129','2015-02-27 20:05:13','172.20.50.129'),(45,'29','start yoyoyoyoyoyo','just yoyoyoyoyooyo','1','00:00:00',0,0,'2015-02-27 20:10:33','172.20.50.129',NULL,NULL),(46,'29','more yoyoyoyooyoy','happy yoyoyoyoyoyoyoy','4','00:00:00',0,0,'2015-02-27 20:10:49','172.20.50.129',NULL,NULL),(47,'29','and yoyoyoyyoy','yoyoyoyoyoyoyoyoyoy!','4','00:00:00',0,0,'2015-02-27 20:11:00','172.20.50.129',NULL,NULL),(48,'28','[Finished!] api','duedate:tonight','5','00:00:00',0,1,'2015-02-27 20:11:09','172.20.185.94','2015-02-27 20:11:55','172.20.50.129'),(49,'29','always yoyoyoy','yoooooooooooooooooooooooooooooooooooooooooo!','4','00:00:00',0,0,'2015-02-27 20:11:11','172.20.50.129',NULL,NULL),(50,'28','new monster','','1','00:00:00',0,0,'2015-02-27 20:11:13','172.20.185.94',NULL,NULL),(51,'30','[Finished!] first','first step!','5','00:00:00',2,1,'2015-02-27 20:13:38','172.20.50.129','2015-02-27 20:17:15','172.20.50.129'),(52,'30','[Finished!] second','a little delay of network','2','00:00:00',10,1,'2015-02-27 20:14:06','172.20.50.129','2015-02-27 20:17:00','172.20.50.129'),(53,'30','the third!','I am the third one!','2','00:00:00',4,0,'2015-02-27 20:14:23','172.20.50.129',NULL,NULL),(54,'30','[Finished!] the forth','the forth monster','5','00:00:00',3,1,'2015-02-27 20:14:37','172.20.50.129','2015-02-27 20:17:08','172.20.50.129'),(55,'28','prototype','due date: tonight','1','00:00:00',0,0,'2015-02-27 20:37:21','172.20.185.94',NULL,NULL),(56,'28','paper prototype','due date tonight','5','00:00:00',0,0,'2015-02-27 20:37:46','172.20.185.94',NULL,NULL);
/*!40000 ALTER TABLE `smallmonsters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `smallmonstersinfo`
--

DROP TABLE IF EXISTS `smallmonstersinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `smallmonstersinfo` (
  `smallmonsterid` int(11) NOT NULL,
  `normalpic` varchar(45) DEFAULT NULL,
  `happypic` varchar(45) DEFAULT NULL,
  `sadpic` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`smallmonsterid`),
  UNIQUE KEY `smpicID_UNIQUE` (`smallmonsterid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `smallmonstersinfo`
--

LOCK TABLES `smallmonstersinfo` WRITE;
/*!40000 ALTER TABLE `smallmonstersinfo` DISABLE KEYS */;
INSERT INTO `smallmonstersinfo` VALUES (1,'img/monsters/smons1.png',NULL,NULL),(2,'img/monsters/smons2.png',NULL,NULL),(3,'img/monsters/smons3.png',NULL,NULL),(4,'img/monsters/smons4.png',NULL,NULL),(5,'img/monsters/smons5.png',NULL,NULL);
/*!40000 ALTER TABLE `smallmonstersinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `phoneNumber` varchar(11) NOT NULL,
  `registerTime` datetime DEFAULT NULL,
  `registerIP` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`phoneNumber`),
  UNIQUE KEY `phoneNumber_UNIQUE` (`phoneNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('07510942062','2015-02-23 18:29:18','172.20.112.141'),('07955862092','2015-02-24 20:50:33','172.20.116.184');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-02-27 20:41:40
