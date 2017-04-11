-- MySQL dump 10.13  Distrib 5.5.50, for debian-linux-gnu (x86_64)
--
-- Host: 0.0.0.0    Database: project1
-- ------------------------------------------------------
-- Server version	5.5.50-0ubuntu0.14.04.1

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
-- Table structure for table `college_info`
--

DROP TABLE IF EXISTS `college_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `college_info` (
  `Serial_number` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Reviews` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Serial_number`),
  UNIQUE KEY `Serial_number` (`Serial_number`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `college_info`
--

LOCK TABLES `college_info` WRITE;
/*!40000 ALTER TABLE `college_info` DISABLE KEYS */;
INSERT INTO `college_info` VALUES (1,'Amity University, Mumbai','Panvel, Mumbai',0),(2,'Indian Institute of Technology, Bombay','IIT Powai, Mumbai',9),(3,'Veermata Jijabai Technological Institute','Matunga West, Mumbai',3),(4,'Vidyalankar Institute of Technology (VIT Mumbai)','Wadala, Mumbai',10),(5,'Sardar Patel College of Engineering','Andheri West, Mumbai',0),(6,'Institute of Chemical Technology','Matunga East, Mumbai',5),(7,'Mukesh Patel School of Technology Management and Engineering','Vile Parle West, Mumbai',7),(8,'Dwarkadas J. Sanghvi College of Engineering','Vile Parle West, Mumbai',4),(9,'K. J. Somaiya College of Engineering (KJSCE)','Vidya Vihar, Mumbai',14),(10,'The L F College of Engineering & Management','Andheri East, Mumbai',0),(11,'Rajiv Gandhi Institute of Technology, Mumbai (RGIT, Mumbai)','Andheri West, Mumbai',4),(12,'Thakur College of Engineering and Technology','Kandivali East, Mumbai',0),(13,'Vivekananda Education Societys Institute of Technology','Chembur, Mumbai',15),(14,'Thadomal Shahani Engineering College (TSEC)','Bandra West, Mumbai',0),(15,'Sardar Patel Institute of Technology (SPIT)','Andheri West, Mumbai',5),(16,'Don Bosco Institute of Technology, Mumbai','Kurla West, Mumbai',0),(17,'St. Francis Institute of Technology','Borivali West, Mumbai',0),(18,'SIES Graduate School of Technology','Nerul, Mumbai',0),(19,'Fr. Conceicao Rodrigues College of Engineering','Bandra West, Mumbai',4),(20,'Universal College of Engineering','thane, Mumbai',4),(21,'Rizvi College of Engineering','Bandra West, Mumbai',5),(22,'M H Saboo Siddik College of Engineering','Byculla, Mumbai',5),(23,'Vidyavardhinis College of Engineering and Technology','Vasai Road, Mumbai',0),(24,'K.C.College of Engineering and Management Studies and Research (KCCOE)','thane, Mumbai',3),(25,'Atharva College of Engineering, The Atharva Educational Trust','Malad West, Mumbai',9),(26,'Mahavir Education Trust\'s Shah and Anchor Kutchhi Engineering College (SAKEC)','Chembur, Mumbai',7),(27,'Padmabhushan Vasantdada Patil Pratishthan College of Engineering','Chunnabhatti, Mumbai',3),(28,'Institution of Industrial Design & Technology','Vashi, Mumbai',0),(29,'Mumbai Institute Of International Studies','Cuffe Parade, Mumbai',0),(30,'Indian Maritime University- MERI Campus','Sewree, Mumbai',0);
/*!40000 ALTER TABLE `college_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infrastructure`
--

DROP TABLE IF EXISTS `infrastructure`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infrastructure` (
  `sr.no` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `college_id` int(11) NOT NULL,
  `facilities` varchar(50) NOT NULL,
  PRIMARY KEY (`sr.no`)
) ENGINE=InnoDB AUTO_INCREMENT=70884 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infrastructure`
--

LOCK TABLES `infrastructure` WRITE;
/*!40000 ALTER TABLE `infrastructure` DISABLE KEYS */;
INSERT INTO `infrastructure` VALUES (70672,1,'Moot Court (Law)'),(70673,1,'Design Studio'),(70674,1,'Library'),(70675,1,'Cafeteria'),(70676,1,'Hostel'),(70677,1,'Sports Complex'),(70678,1,'Gym'),(70679,1,'Hospital / Medical Facilities'),(70680,1,'Wi-Fi Campus'),(70681,1,'Shuttle Service'),(70682,1,'Auditorium'),(70683,1,'A/C Classrooms'),(70684,1,'Convenience Store'),(70685,1,'Labs'),(70686,2,'Library'),(70687,2,'Cafeteria'),(70688,2,'Hostel'),(70689,2,'Sports Complex'),(70690,2,'Gym'),(70691,2,'Hospital / Medical Facilities'),(70692,2,'Wi-Fi Campus'),(70693,2,'Auditorium'),(70694,2,'Labs'),(70695,3,'Library'),(70696,3,'Cafeteria'),(70697,3,'Hostel'),(70698,3,'Sports Complex'),(70699,3,'Gym'),(70700,3,'Auditorium'),(70701,3,'Convenience Store'),(70702,3,'Labs'),(70703,4,'Library'),(70704,4,'Cafeteria'),(70705,4,'Sports Complex'),(70706,4,'Hospital / Medical Facilities'),(70707,4,'Wi-Fi Campus'),(70708,4,'Auditorium'),(70709,4,'A/C Classrooms'),(70710,4,'Labs'),(70711,5,'Library'),(70712,5,'Cafeteria'),(70713,5,'Hostel'),(70714,5,'Sports Complex'),(70715,5,'Gym'),(70716,5,'Wi-Fi Campus'),(70717,5,'Auditorium'),(70718,5,'Labs'),(70719,6,'Library'),(70720,6,'Cafeteria'),(70721,6,'Hostel'),(70722,6,'Sports Complex'),(70723,6,'Gym'),(70724,6,'Hospital / Medical Facilities'),(70725,6,'Wi-Fi Campus'),(70726,6,'Auditorium'),(70727,6,'Labs'),(70728,7,'Library'),(70729,7,'Hostel'),(70730,7,'Labs'),(70731,8,'Library'),(70732,8,'Cafeteria'),(70733,8,'Hostel'),(70734,8,'Sports Complex'),(70735,8,'Gym'),(70736,8,'Hospital / Medical Facilities'),(70737,8,'Wi-Fi Campus'),(70738,8,'Auditorium'),(70739,8,'A/C Classrooms'),(70740,8,'Labs'),(70741,9,'Library'),(70742,9,'Cafeteria'),(70743,9,'Hostel'),(70744,9,'Sports Complex'),(70745,9,'Gym'),(70746,9,'Hospital / Medical Facilities'),(70747,9,'Auditorium'),(70748,9,'Labs'),(70749,10,'Library'),(70750,11,'Library'),(70751,11,'Hostel'),(70752,11,'Sports Complex'),(70753,11,'Shuttle Service'),(70754,11,'Auditorium'),(70755,11,'Labs'),(70756,12,'Library'),(70757,12,'Cafeteria'),(70758,12,'Hostel'),(70759,12,'Sports Complex'),(70760,12,'Hospital / Medical Facilities'),(70761,12,'Wi-Fi Campus'),(70762,12,'Shuttle Service'),(70763,12,'Auditorium'),(70764,12,'A/C Classrooms'),(70765,12,'Labs'),(70766,13,'Library'),(70767,13,'Cafeteria'),(70768,13,'Hostel'),(70769,13,'Sports Complex'),(70770,13,'Wi-Fi Campus'),(70771,13,'Auditorium'),(70772,13,'Labs'),(70773,14,'Library'),(70774,14,'Cafeteria'),(70775,14,'Sports Complex'),(70776,14,'Hospital / Medical Facilities'),(70777,14,'Wi-Fi Campus'),(70778,14,'Auditorium'),(70779,14,'Labs'),(70780,15,'Library'),(70781,15,'Cafeteria'),(70782,15,'Hostel'),(70783,15,'Sports Complex'),(70784,15,'Gym'),(70785,15,'Auditorium'),(70786,15,'Labs'),(70787,16,'Library'),(70788,16,'Cafeteria'),(70789,16,'Sports Complex'),(70790,16,'Gym'),(70791,16,'Hospital / Medical Facilities'),(70792,16,'Auditorium'),(70793,16,'Labs'),(70794,17,'Library'),(70795,17,'Cafeteria'),(70796,17,'Sports Complex'),(70797,17,'Gym'),(70798,17,'Hospital / Medical Facilities'),(70799,17,'Auditorium'),(70800,17,'Labs'),(70801,18,'Library'),(70802,18,'Cafeteria'),(70803,18,'Sports Complex'),(70804,18,'Gym'),(70805,18,'Wi-Fi Campus'),(70806,18,'Auditorium'),(70807,18,'Labs'),(70808,19,'Library'),(70809,19,'Cafeteria'),(70810,19,'Hostel'),(70811,19,'Sports Complex'),(70812,19,'Gym'),(70813,19,'Hospital / Medical Facilities'),(70814,19,'Wi-Fi Campus'),(70815,19,'Auditorium'),(70816,19,'Labs'),(70817,20,'Library'),(70818,20,'Cafeteria'),(70819,20,'Hostel'),(70820,20,'Sports Complex'),(70821,20,'Shuttle Service'),(70822,20,'Labs'),(70823,21,'Library'),(70824,21,'Cafeteria'),(70825,21,'Sports Complex'),(70826,21,'Auditorium'),(70827,21,'Labs'),(70828,22,'Library'),(70829,22,'Cafeteria'),(70830,22,'Hostel'),(70831,22,'Sports Complex'),(70832,22,'Auditorium'),(70833,22,'Labs'),(70834,23,'Library'),(70835,23,'Cafeteria'),(70836,23,'Sports Complex'),(70837,23,'Gym'),(70838,23,'Hospital / Medical Facilities'),(70839,23,'Auditorium'),(70840,23,'Labs'),(70841,24,'Library'),(70842,24,'Cafeteria'),(70843,24,'Sports Complex'),(70844,24,'Gym'),(70845,24,'Hospital / Medical Facilities'),(70846,24,'Auditorium'),(70847,24,'Labs'),(70848,25,'Library'),(70849,25,'Cafeteria'),(70850,25,'Sports Complex'),(70851,25,'Gym'),(70852,25,'Hospital / Medical Facilities'),(70853,25,'Wi-Fi Campus'),(70854,25,'Auditorium'),(70855,25,'Labs'),(70856,26,'Library'),(70857,26,'Cafeteria'),(70858,26,'Sports Complex'),(70859,26,'Gym'),(70860,26,'Wi-Fi Campus'),(70861,26,'Auditorium'),(70862,26,'A/C Classrooms'),(70863,26,'Labs'),(70864,27,'Library'),(70865,27,'Cafeteria'),(70866,27,'Hostel'),(70867,27,'Sports Complex'),(70868,27,'Gym'),(70869,27,'Auditorium'),(70870,27,'Labs'),(70871,28,'---'),(70872,29,'Library'),(70873,29,'Cafeteria'),(70874,29,'Sports Complex'),(70875,29,'Auditorium'),(70876,30,'Library'),(70877,30,'Cafeteria'),(70878,30,'Hostel'),(70879,30,'Sports Complex'),(70880,30,'Gym'),(70881,30,'Hospital / Medical Facilities'),(70882,30,'Shuttle Service'),(70883,30,'Labs');
/*!40000 ALTER TABLE `infrastructure` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-09  4:03:57
