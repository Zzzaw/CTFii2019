-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: ctf_01
-- ------------------------------------------------------
-- Server version	5.5.47-0ubuntu0.14.04.1

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
-- Current Database: `ctf_01`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `ctf_01` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `ctf_01`;

--
-- Table structure for table `challenges`
--

DROP TABLE IF EXISTS `challenges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `challenges` (
  `challenge_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `challenge_desc` varchar(200) DEFAULT NULL,
  `is_docker` int(2) NOT NULL DEFAULT '0',
  `docker_dir` varchar(100) DEFAULT NULL,
  `base_score` int(10) NOT NULL DEFAULT '0',
  `current_score` int(10) NOT NULL DEFAULT '0',
  `attached_file` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `flag` varchar(50) NOT NULL DEFAULT 'flag{}',
  `is_open` int(2) NOT NULL DEFAULT '0',
  `solved` int(10) NOT NULL DEFAULT '0',
  `title` varchar(20) NOT NULL DEFAULT 'empty',
  PRIMARY KEY (`challenge_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `challenges`
--

LOCK TABLES `challenges` WRITE;
/*!40000 ALTER TABLE `challenges` DISABLE KEYS */;
INSERT INTO `challenges` VALUES (1,'web','flag is \"flag\"',0,NULL,0,500,'file1=upload/1.txt;file2=upload/2.txt','123.123.123:8002','flag',1,512,'test_title'),(2,'web','flag is \"flag\"',0,NULL,0,357,NULL,'123.123.123:8001/index','flag',1,7,'test_title'),(3,'misc','flag is \"flag\"',0,NULL,0,500,NULL,'href3','flag',1,1,'test_title'),(4,'misc','flag is \"flag\"',0,NULL,0,500,NULL,NULL,'flag',1,0,'test_title'),(5,'pwn','flag is \"flag\"',0,NULL,0,500,NULL,NULL,'flag',1,1,'test_title'),(6,'pwn','flag is \"flag\"',0,NULL,0,500,NULL,NULL,'flag',1,0,'test_title'),(7,'crypto','flag is \"flag\"',0,NULL,0,500,NULL,NULL,'flag',1,0,'test_title'),(8,'crypto','flag is \"flag\"',0,NULL,0,500,NULL,NULL,'flag',1,0,'test_title'),(9,'reserve','flag is \"flag\"',0,NULL,0,500,NULL,NULL,'flag',1,1,'test_title'),(10,'reserve','flag is \"flag\"',0,NULL,0,500,NULL,NULL,'flag',1,0,'test_title');
/*!40000 ALTER TABLE `challenges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nickname` varchar(40) NOT NULL,
  `stu_number` varchar(15) DEFAULT NULL,
  `is_jnu` int(2) unsigned NOT NULL,
  `name` varchar(10) NOT NULL,
  `score` int(10) NOT NULL DEFAULT '0',
  `is_using_docker` int(2) unsigned DEFAULT '0',
  `solved_challenge_id` varchar(100) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `last_update_date` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','2017000000',1,'XiaoMing',0,0,'1;2;1;3;2;5;9','admin','password','2019-10-25-12-22-22'),(2,'test02',NULL,0,'',0,0,NULL,'','',NULL),(3,'',NULL,0,'',0,0,'2','test02@test02.com','',NULL),(8,'ww',NULL,0,'',0,0,'1','test03@test03.com','',NULL),(10,'ww',NULL,0,'',0,0,'1','test04@test02.com','',NULL),(12,'ww',NULL,0,'',0,0,'1','test05@test.com','',NULL),(13,'password',NULL,0,'',0,0,'1','ab','',NULL),(14,'password',NULL,0,'',0,0,'1','test01@test01.com','',NULL),(20,'test06','2018000006',0,'小黄',0,0,'1;2','test06@test01.com','password6',NULL),(21,'test07','2018000007',0,'小黑',0,0,'2;1;1','test07@test.com','password7','2019-10-24-18-49-24'),(22,'test03','2018000001',0,'ww',0,0,NULL,'email3','password3',NULL),(25,'test04','2018000001',0,'ww',0,0,NULL,'email4','password',NULL),(26,'test05','2018000001',1,'ww',0,0,NULL,'email5','password',NULL),(27,'test06','2018000001',0,'ww',0,0,NULL,'email6','password',NULL),(28,'test08',NULL,0,'ww',0,0,NULL,'email8','password',NULL),(30,'test09',NULL,0,'ww',0,0,NULL,'email9','password',NULL);
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

-- Dump completed on 2019-10-25  4:48:58
