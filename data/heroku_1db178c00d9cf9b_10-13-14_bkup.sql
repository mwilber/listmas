# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: us-cdbr-iron-east-01.cleardb.net (MySQL 5.5.37-log)
# Database: heroku_1db178c00d9cf9b
# Generation Time: 2014-10-13 18:30:44 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table tblprod
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tblprod`;

CREATE TABLE `tblprod` (
  `prodId` bigint(11) NOT NULL AUTO_INCREMENT,
  `prodName` varchar(50) DEFAULT NULL,
  `prodRemoteId` int(11) DEFAULT NULL,
  `prodDescription` varchar(200) DEFAULT NULL,
  `prodPhoto` varchar(200) DEFAULT NULL,
  `prodUpc` varchar(50) DEFAULT NULL,
  `prodUrl` varchar(200) DEFAULT NULL,
  `prodTimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`prodId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tblprod` WRITE;
/*!40000 ALTER TABLE `tblprod` DISABLE KEYS */;

INSERT INTO `tblprod` (`prodId`, `prodName`, `prodRemoteId`, `prodDescription`, `prodPhoto`, `prodUpc`, `prodUrl`, `prodTimeStamp`)
VALUES
	(571,'Lego Cup',2,'Everything is awesome!','http://s3.amazonaws.com/listmas/1413087080_214.jpg',NULL,NULL,'2014-10-12 04:11:20'),
	(591,'Candle Holder',8,NULL,'http://s3.amazonaws.com/listmas/1413087279_488.jpg',NULL,NULL,'2014-10-12 04:14:40'),
	(601,'Lego Cup',13,NULL,'http://s3.amazonaws.com/listmas/1413087280_583.jpg',NULL,NULL,'2014-10-12 04:14:40'),
	(631,'Frankenstone',1,NULL,'http://s3.amazonaws.com/listmas/1413087368_237.jpg',NULL,NULL,'2014-10-12 04:16:09'),
	(641,'Plants vs Zombies Garden Warfare - PlayStation 3',NULL,NULL,'http://ecx.images-amazon.com/images/I/614rtdTys4L._SL160_.jpg','014633731804','http://www.amazon.com/Plants-Zombies-Garden-Warfare-PlayStation-3/dp/B00KLMOY54%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creative','2014-10-12 04:41:40'),
	(651,'Lego Cupp',2,'Everything is awesome!','http://s3.amazonaws.com/listmas/1413127038_762.jpg',NULL,NULL,'2014-10-12 15:17:19'),
	(661,'Plants vs Zombies Garden Warfare - PlayStation 3',3,NULL,'http://ecx.images-amazon.com/images/I/614rtdTys4L._SL160_.jpg','014633731804','http2://www.amazon.com/Plants-Zombies-Garden-Warfare-PlayStation-3/dp/B00KLMOY54%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativ','2014-10-12 15:17:19'),
	(671,'Frankenstone',1,NULL,'http://s3.amazonaws.com/listmas/1413128034_222.jpg',NULL,NULL,'2014-10-12 15:33:55'),
	(681,'Count Chocula Monster Cereal 10.4 Ounce Box (Pack ',3,NULL,'http://ecx.images-amazon.com/images/I/51XS2w%2BFjBL._SL160_.jpg','016000275836','http://www.amazon.com/Count-Chocula-Monster-Cereal-Ounce/dp/B00NMQW8H2%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativeASIN%3DB0','2014-10-12 15:33:55'),
	(691,'2 Teenage Mutant Ninja Turtles TMNT Notebooks--Mik',4,NULL,'http://ecx.images-amazon.com/images/I/51BeLhlwWrL._SL160_.jpg','844331056929','http://www.amazon.com/Teenage-Mutant-Ninja-Turtles-Notebooks-Mikey/dp/B00EYR74CC%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativ','2014-10-12 15:33:55'),
	(701,'Plants vs Zombies Garden Warfare - PlayStation 3',5,NULL,'http://ecx.images-amazon.com/images/I/614rtdTys4L._SL160_.jpg','014633731804','http://www.amazon.com/Plants-Zombies-Garden-Warfare-PlayStation-3/dp/B00KLMOY54%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creative','2014-10-12 15:33:55'),
	(711,'2 Teenage Mutant Ninja Turtles TMNT Notebooks--Mik',1,NULL,'http://ecx.images-amazon.com/images/I/51BeLhlwWrL._SL160_.jpg','844331056929',NULL,'2014-10-12 15:45:20'),
	(721,'Candle Holder',2,NULL,'http://s3.amazonaws.com/listmas/1413128720_183.jpg',NULL,NULL,'2014-10-12 15:45:21'),
	(731,'2 Teenage Mutant Ninja Turtles TMNT Notebooks--Mik',1,NULL,'http://ecx.images-amazon.com/images/I/51BeLhlwWrL._SL160_.jpg','844331056929',NULL,'2014-10-12 15:46:00'),
	(741,'Candle Holder',2,NULL,'http://s3.amazonaws.com/listmas/1413128760_806.jpg',NULL,NULL,'2014-10-12 15:46:01'),
	(751,'2 Teenage Mutant Ninja Turtles TMNT Notebooks--Mik',1,NULL,'http://ecx.images-amazon.com/images/I/51BeLhlwWrL._SL160_.jpg','844331056929',NULL,'2014-10-12 15:46:31'),
	(801,'Truvia - Nature\'s Calorie Free Erythritol Sweetene',3,NULL,'http://ecx.images-amazon.com/images/I/41hhawgEa2L._SL160_.jpg','013600000790','http://www.amazon.com/Truvia-Natures-Calorie-Erythritol-Sweetener/dp/B00CQ7YV64%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creative','2014-10-12 17:35:52'),
	(811,'Lego Cupp',2,'Everything is awesome!','http://s3.amazonaws.com/listmas/1413165950_672.jpg',NULL,NULL,'2014-10-13 02:05:51'),
	(821,'Plants vs Zombies Garden Warfare - PlayStation 3',3,NULL,'http://ecx.images-amazon.com/images/I/614rtdTys4L._SL160_.jpg','014633731804','http2://www.amazon.com/Plants-Zombies-Garden-Warfare-PlayStation-3/dp/B00KLMOY54%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativ','2014-10-13 02:05:51'),
	(841,'Lego Cupp',2,'Everything is awesome!','http://s3.amazonaws.com/listmas/1413165965_865.jpg',NULL,NULL,'2014-10-13 02:06:06'),
	(851,'Plants vs Zombies Garden Warfare - PlayStation 3',3,'','http://ecx.images-amazon.com/images/I/614rtdTys4L._SL160_.jpg','014633731804','http://www.amazon.com/Plants-Zombies-Garden-Warfare-PlayStation-3/dp/B00KLMOY54%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativ','2014-10-13 12:42:15'),
	(871,'Frankenstone',1,NULL,'http://s3.amazonaws.com/listmas/1413166374_441.jpg',NULL,NULL,'2014-10-13 02:12:54'),
	(891,'2 Teenage Mutant Ninja Turtles TMNT Notebooks--Mik',4,NULL,'http://ecx.images-amazon.com/images/I/51BeLhlwWrL._SL160_.jpg','844331056929','http://www.amazon.com/Teenage-Mutant-Ninja-Turtles-Notebooks-Mikey/dp/B00EYR74CC%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativ','2014-10-13 02:12:54'),
	(901,'Plants vs Zombies Garden Warfare - PlayStation 3',5,NULL,'http://ecx.images-amazon.com/images/I/614rtdTys4L._SL160_.jpg','014633731804','http://www.amazon.com/Plants-Zombies-Garden-Warfare-PlayStation-3/dp/B00KLMOY54%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creative','2014-10-13 02:12:54'),
	(911,'Feit ML75A/BL 75W A19 Incandescent Black Light, 1-',6,NULL,'http://ecx.images-amazon.com/images/I/41B%2Bnei0kPL._SL160_.jpg','017801098235','http://www.amazon.com/Feit-ML75A-BL-Incandescent-1-Pack/dp/B00HZ3FBE0%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativeASIN%3DB00','2014-10-13 02:12:54'),
	(921,'UTZ Tortillas Chips, White Corn, 17 Ounce',7,NULL,'','041780003850','http://www.amazon.com/UTZ-Tortillas-Chips-White-Ounce/dp/B0005ZYFLU%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativeASIN%3DB0005','2014-10-13 02:12:54'),
	(931,'ChargerCity Exclusive Apple iPad Mini Google Nexus',NULL,'','http://ecx.images-amazon.com/images/I/51qrzVbDVlL._SL160_.jpg',NULL,'http://www.amazon.com/ChargerCity-Exclusive-Recording-Adjustment-included/dp/B00B149NIE%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26','2014-10-13 13:43:26'),
	(941,'Minecraft Think Geek Wall Torch by Think Geek',NULL,'','http://ecx.images-amazon.com/images/I/31PawUYEjdL._SL160_.jpg',NULL,'http://www.amazon.com/Minecraft-Think-Geek-Wall-Torch/dp/B00B0FV4FE%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativeASIN%3DB00B0','2014-10-13 13:47:03'),
	(951,'Minecraft Redstone Ore by Think Geek',NULL,'','http://ecx.images-amazon.com/images/I/413mfEsR-nL._SL160_.jpg',NULL,'http://www.amazon.com/Minecraft-Redstone-Ore-Think-Geek/dp/B00B0FT1CW%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativeASIN%3DB00','2014-10-13 13:48:27'),
	(991,'Mega Bloks Call of Duty Zombies Outbreak Collector',4,NULL,'http://ecx.images-amazon.com/images/I/51OdPFmWg%2BL._SL160_.jpg','065541068490','http://www.amazon.com/Call-Duty-Zombies-Outbreak-Collector/dp/B00J05MWVQ%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativeASIN%3D','2014-10-13 13:50:31'),
	(1001,'Mega Bloks Call of Duty Juggernaut',5,NULL,'http://ecx.images-amazon.com/images/I/51cPMRalWbL._SL160_.jpg','065541068513','http://www.amazon.com/Mega-Bloks-Call-Duty-Juggernaut/dp/B00J05MTSC%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativeASIN%3DB00J0','2014-10-13 13:50:31'),
	(1021,'Truvia - Nature\'s Calorie Free Erythritol Sweetene',1,NULL,'http://ecx.images-amazon.com/images/I/41hhawgEa2L._SL160_.jpg','013600000790','http://www.amazon.com/Truvia-Natures-Calorie-Erythritol-Sweetener/dp/B00CQ7YV64%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creative','2014-10-13 16:13:45'),
	(1031,'Feit ML75A/BL 75W A19 Incandescent Black Light, 1-',1,NULL,'http://ecx.images-amazon.com/images/I/41B%2Bnei0kPL._SL160_.jpg','017801098235','http://www.amazon.com/Feit-ML75A-BL-Incandescent-1-Pack/dp/B00HZ3FBE0%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativeASIN%3DB00','2014-10-13 18:08:54');

/*!40000 ALTER TABLE `tblprod` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tblprod_sav
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tblprod_sav`;

CREATE TABLE `tblprod_sav` (
  `prodId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `prodName` varchar(50) DEFAULT NULL,
  `prodRemoteId` int(11) DEFAULT NULL,
  `prodDescription` varchar(200) DEFAULT NULL,
  `prodPhoto` varchar(100) DEFAULT NULL,
  `prodUpc` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`prodId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table tblprodlist
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tblprodlist`;

CREATE TABLE `tblprodlist` (
  `prodListId` int(11) NOT NULL AUTO_INCREMENT,
  `shopListId` int(11) DEFAULT NULL,
  `prodId` int(11) DEFAULT NULL,
  `prodListDateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`prodListId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tblprodlist` WRITE;
/*!40000 ALTER TABLE `tblprodlist` DISABLE KEYS */;

INSERT INTO `tblprodlist` (`prodListId`, `shopListId`, `prodId`, `prodListDateAdded`)
VALUES
	(1,11,191,'2014-10-12 01:17:21'),
	(11,11,201,'2014-10-12 01:17:21'),
	(21,31,211,'2014-10-12 01:43:08'),
	(31,31,221,'2014-10-12 01:43:09'),
	(41,41,231,'2014-10-12 01:47:01'),
	(51,41,241,'2014-10-12 01:47:02'),
	(61,51,251,'2014-10-12 01:51:51'),
	(71,51,261,'2014-10-12 01:51:52'),
	(81,61,271,'2014-10-12 02:00:53'),
	(91,61,281,'2014-10-12 02:00:54'),
	(101,71,291,'2014-10-12 02:03:38'),
	(111,71,301,'2014-10-12 02:03:40'),
	(121,81,311,'2014-10-12 02:06:10'),
	(131,81,321,'2014-10-12 02:06:11'),
	(141,91,331,'2014-10-12 02:07:11'),
	(151,91,341,'2014-10-12 02:07:12'),
	(221,NULL,411,'2014-10-12 02:19:37'),
	(231,NULL,421,'2014-10-12 02:19:38'),
	(241,NULL,431,'2014-10-12 02:20:55'),
	(251,NULL,441,'2014-10-12 02:20:56'),
	(321,101,511,'2014-10-12 02:30:49'),
	(331,101,521,'2014-10-12 02:30:50'),
	(341,201,551,'2014-10-12 03:10:41'),
	(381,231,591,'2014-10-12 04:14:40'),
	(391,231,601,'2014-10-12 04:14:40'),
	(401,231,611,'2014-10-12 04:14:41'),
	(411,231,621,'2014-10-12 04:14:41'),
	(491,261,711,'2014-10-12 15:45:20'),
	(501,261,721,'2014-10-12 15:45:21'),
	(511,271,731,'2014-10-12 15:46:00'),
	(521,271,741,'2014-10-12 15:46:01'),
	(531,281,751,'2014-10-12 15:46:31'),
	(541,281,761,'2014-10-12 15:46:31'),
	(551,291,771,'2014-10-12 15:48:52'),
	(651,241,871,'2014-10-13 02:12:54'),
	(661,241,881,'2014-10-13 02:12:54'),
	(671,241,891,'2014-10-13 02:12:54'),
	(681,241,901,'2014-10-13 02:12:54'),
	(691,241,911,'2014-10-13 02:12:54'),
	(701,241,921,'2014-10-13 02:12:54'),
	(711,221,931,'0000-00-00 00:00:00'),
	(721,221,941,'0000-00-00 00:00:00'),
	(731,221,951,'0000-00-00 00:00:00'),
	(741,301,961,'2014-10-13 13:50:31'),
	(751,301,971,'2014-10-13 13:50:31'),
	(761,301,981,'2014-10-13 13:50:31'),
	(771,301,991,'2014-10-13 13:50:31'),
	(781,301,1001,'2014-10-13 13:50:31'),
	(791,301,1011,'2014-10-13 13:50:31'),
	(801,221,1001,'0000-00-00 00:00:00'),
	(811,221,991,'0000-00-00 00:00:00'),
	(821,331,1021,'2014-10-13 16:13:45'),
	(831,341,1031,'2014-10-13 18:08:54');

/*!40000 ALTER TABLE `tblprodlist` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tblshoplist
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tblshoplist`;

CREATE TABLE `tblshoplist` (
  `shopListId` int(11) NOT NULL AUTO_INCREMENT,
  `shopListName` varchar(50) DEFAULT NULL,
  `shopListData` varchar(500) DEFAULT NULL,
  `storeId` int(11) DEFAULT NULL,
  `profileId` int(11) DEFAULT NULL,
  `shopListCheckoff` tinyint(4) DEFAULT NULL,
  `shopListDateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`shopListId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tblshoplist` WRITE;
/*!40000 ALTER TABLE `tblshoplist` DISABLE KEYS */;

INSERT INTO `tblshoplist` (`shopListId`, `shopListName`, `shopListData`, `storeId`, `profileId`, `shopListCheckoff`, `shopListDateAdded`)
VALUES
	(1,'James',NULL,NULL,NULL,NULL,'2014-10-12 01:14:31'),
	(11,'James',NULL,NULL,NULL,NULL,'2014-10-12 01:17:21'),
	(21,'James',NULL,NULL,NULL,NULL,'2014-10-12 01:39:07'),
	(31,'James',NULL,NULL,NULL,NULL,'2014-10-12 01:43:08'),
	(41,'James',NULL,NULL,NULL,NULL,'2014-10-12 01:47:01'),
	(51,'James',NULL,NULL,NULL,NULL,'2014-10-12 01:51:51'),
	(61,'James',NULL,NULL,NULL,NULL,'2014-10-12 02:00:53'),
	(71,'James',NULL,NULL,NULL,NULL,'2014-10-12 02:03:38'),
	(81,'James',NULL,NULL,NULL,NULL,'2014-10-12 02:06:10'),
	(91,'James',NULL,NULL,NULL,NULL,'2014-10-12 02:07:11'),
	(101,'James',NULL,NULL,NULL,NULL,'2014-10-12 02:09:44'),
	(111,'James',NULL,NULL,NULL,NULL,'2014-10-12 02:57:20'),
	(121,NULL,NULL,NULL,NULL,NULL,'2014-10-12 02:59:05'),
	(131,NULL,NULL,NULL,NULL,NULL,'2014-10-12 03:02:15'),
	(141,'James',NULL,NULL,NULL,NULL,'2014-10-12 03:03:48'),
	(151,'James',NULL,NULL,NULL,NULL,'2014-10-12 03:04:08'),
	(161,NULL,NULL,NULL,NULL,NULL,'2014-10-12 03:04:50'),
	(171,NULL,NULL,NULL,NULL,NULL,'2014-10-12 03:05:04'),
	(181,NULL,NULL,NULL,NULL,NULL,'2014-10-12 03:06:58'),
	(221,'James',NULL,NULL,NULL,NULL,'2014-10-12 04:11:20'),
	(241,'James 2',NULL,NULL,NULL,NULL,'2014-10-12 04:16:09'),
	(291,'Test 1',NULL,NULL,NULL,NULL,'2014-10-12 15:48:52'),
	(301,'Test 3',NULL,NULL,NULL,NULL,'2014-10-12 17:35:52'),
	(331,'One',NULL,NULL,NULL,NULL,'2014-10-13 16:13:45'),
	(341,'Test 5',NULL,NULL,NULL,NULL,'2014-10-13 18:08:54');

/*!40000 ALTER TABLE `tblshoplist` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tblupc
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tblupc`;

CREATE TABLE `tblupc` (
  `upcId` int(11) NOT NULL AUTO_INCREMENT,
  `upcName` varchar(50) DEFAULT NULL,
  `upcRemoteId` int(11) DEFAULT NULL,
  `upcDescription` varchar(200) DEFAULT NULL,
  `upcPhoto` varchar(200) DEFAULT NULL,
  `upcUrl` varchar(200) DEFAULT NULL,
  `upcUpc` varchar(50) DEFAULT NULL,
  `upcTimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`upcId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tblupc` WRITE;
/*!40000 ALTER TABLE `tblupc` DISABLE KEYS */;

INSERT INTO `tblupc` (`upcId`, `upcName`, `upcRemoteId`, `upcDescription`, `upcPhoto`, `upcUrl`, `upcUpc`, `upcTimeStamp`)
VALUES
	(21,'Count Chocula Monster Cereal 10.4 Ounce Box (Pack ',NULL,NULL,'http://ecx.images-amazon.com/images/I/51XS2w%2BFjBL._SL160_.jpg','http://www.amazon.com/Count-Chocula-Monster-Cereal-Ounce/dp/B00NMQW8H2%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativeASIN%3DB0','016000275836','2014-10-12 05:18:31'),
	(31,'2 Teenage Mutant Ninja Turtles TMNT Notebooks--Mik',NULL,NULL,'http://ecx.images-amazon.com/images/I/51BeLhlwWrL._SL160_.jpg','http://www.amazon.com/Teenage-Mutant-Ninja-Turtles-Notebooks-Mikey/dp/B00EYR74CC%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativ','844331056929','2014-10-12 05:26:05'),
	(41,'Plants vs Zombies Garden Warfare - PlayStation 3',NULL,NULL,'http://ecx.images-amazon.com/images/I/614rtdTys4L._SL160_.jpg','http://www.amazon.com/Plants-Zombies-Garden-Warfare-PlayStation-3/dp/B00KLMOY54%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creative','014633731804','2014-10-12 05:26:51'),
	(51,'Gatorade Thirst Quencher - Mainline Orange, 32-oun',NULL,NULL,'http://ecx.images-amazon.com/images/I/413EGO0LbtL._SL160_.jpg','http://www.amazon.com/Gatorade-Thirst-Quencher-Mainline-32-ounce/dp/B007WDX32U%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativeA','052000338768','2014-10-12 15:48:47'),
	(61,'Truvia - Nature\'s Calorie Free Erythritol Sweetene',NULL,NULL,'http://ecx.images-amazon.com/images/I/41hhawgEa2L._SL160_.jpg','http://www.amazon.com/Truvia-Natures-Calorie-Erythritol-Sweetener/dp/B00CQ7YV64%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creative','013600000790','2014-10-12 17:35:42'),
	(71,'Mega Bloks Call of Duty Zombies Outbreak Collector',NULL,NULL,'http://ecx.images-amazon.com/images/I/51OdPFmWg%2BL._SL160_.jpg','http://www.amazon.com/Call-Duty-Zombies-Outbreak-Collector/dp/B00J05MWVQ%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativeASIN%3D','065541068490','2014-10-12 20:04:49'),
	(81,'Mega Bloks Call of Duty Juggernaut',NULL,NULL,'http://ecx.images-amazon.com/images/I/51cPMRalWbL._SL160_.jpg','http://www.amazon.com/Mega-Bloks-Call-Duty-Juggernaut/dp/B00J05MTSC%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativeASIN%3DB00J0','065541068513','2014-10-12 20:05:10'),
	(91,'Feit ML75A/BL 75W A19 Incandescent Black Light, 1-',NULL,NULL,'http://ecx.images-amazon.com/images/I/41B%2Bnei0kPL._SL160_.jpg','http://www.amazon.com/Feit-ML75A-BL-Incandescent-1-Pack/dp/B00HZ3FBE0%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativeASIN%3DB00','017801098235','2014-10-13 02:07:29'),
	(101,'UTZ Tortillas Chips, White Corn, 17 Ounce',NULL,NULL,'','http://www.amazon.com/UTZ-Tortillas-Chips-White-Ounce/dp/B0005ZYFLU%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativeASIN%3DB0005','041780003850','2014-10-13 02:07:58');

/*!40000 ALTER TABLE `tblupc` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `userEmail` varchar(128) NOT NULL,
  `userPassword` varchar(32) NOT NULL,
  `userStatus` varchar(50) NOT NULL DEFAULT 'active',
  PRIMARY KEY (`userId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`userId`, `userEmail`, `userPassword`, `userStatus`)
VALUES
	(6,'admin','21232f297a57a5a743894a0e4a801fc3','active');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
