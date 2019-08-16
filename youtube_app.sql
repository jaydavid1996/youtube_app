-- MySQL dump 10.13  Distrib 5.7.27, for Linux (x86_64)
--
-- Host: localhost    Database: youtube_app
-- ------------------------------------------------------
-- Server version	5.7.27-0ubuntu0.18.04.1

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
-- Table structure for table `youtube_channel_videos`
--

DROP TABLE IF EXISTS `youtube_channel_videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `youtube_channel_videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `channel_id` varchar(150) NOT NULL,
  `title` varchar(255) NOT NULL,
  `descriptions` varchar(300) NOT NULL,
  `thumbnails` varchar(250) NOT NULL,
  `video_id` varchar(150) NOT NULL,
  `playlist_id` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `playlist_id_UNIQUE` (`playlist_id`,`video_id`),
  UNIQUE KEY `video_id_UNIQUE` (`video_id`,`playlist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `youtube_channel_videos`
--

LOCK TABLES `youtube_channel_videos` WRITE;
/*!40000 ALTER TABLE `youtube_channel_videos` DISABLE KEYS */;
/*!40000 ALTER TABLE `youtube_channel_videos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `youtube_channels`
--

DROP TABLE IF EXISTS `youtube_channels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `youtube_channels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `channel_id` varchar(150) NOT NULL,
  `title` varchar(255) NOT NULL,
  `descriptions` varchar(300) NOT NULL,
  `photo` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `channel_id` (`channel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `youtube_channels`
--

LOCK TABLES `youtube_channels` WRITE;
/*!40000 ALTER TABLE `youtube_channels` DISABLE KEYS */;
/*!40000 ALTER TABLE `youtube_channels` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-08-16 11:52:59
