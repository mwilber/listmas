# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: us-cdbr-iron-east-01.cleardb.net (MySQL 5.5.37-log)
# Database: heroku_1db178c00d9cf9b
# Generation Time: 2014-10-13 22:05:28 +0000
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
  `prodListId` bigint(11) NOT NULL AUTO_INCREMENT,
  `shopListId` int(11) DEFAULT NULL,
  `prodId` bigint(11) DEFAULT NULL,
  `prodListDateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`prodListId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



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
