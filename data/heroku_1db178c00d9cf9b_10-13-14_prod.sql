# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: us-cdbr-iron-east-01.cleardb.net (MySQL 5.5.37-log)
# Database: heroku_1db178c00d9cf9b
# Generation Time: 2014-10-13 22:06:19 +0000
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

LOCK TABLES `tblprod` WRITE;
/*!40000 ALTER TABLE `tblprod` DISABLE KEYS */;

INSERT INTO `tblprod` (`prodName`, `prodRemoteId`, `prodDescription`, `prodPhoto`, `prodUpc`, `prodUrl`, `prodTimeStamp`)
VALUES
	('ChargerCity Exclusive Apple iPad Mini Google Nexus',NULL,'','http://ecx.images-amazon.com/images/I/51qrzVbDVlL._SL160_.jpg',NULL,'http://www.amazon.com/ChargerCity-Exclusive-Recording-Adjustment-included/dp/B00B149NIE%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26','2014-10-13 18:35:09'),
	('Minecraft Think Geek Wall Torch by Think Geek',NULL,'','http://ecx.images-amazon.com/images/I/31PawUYEjdL._SL160_.jpg',NULL,'http://www.amazon.com/Minecraft-Think-Geek-Wall-Torch/dp/B00B0FV4FE%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativeASIN%3DB00B0','2014-10-13 18:35:37'),
	('Minecraft Redstone Ore by Think Geek',NULL,'','http://ecx.images-amazon.com/images/I/413mfEsR-nL._SL160_.jpg',NULL,'http://www.amazon.com/Minecraft-Redstone-Ore-Think-Geek/dp/B00B0FT1CW%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativeASIN%3DB00','2014-10-13 18:36:42'),
	('Mega Bloks Call of Duty Juggernaut',NULL,'','http://ecx.images-amazon.com/images/I/51cPMRalWbL._SL160_.jpg',NULL,'http://www.amazon.com/Mega-Bloks-Call-Duty-Juggernaut/dp/B00J05MTSC%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativeASIN%3DB00J0','2014-10-13 18:37:39'),
	('Mega Bloks Call of Duty Zombies Outbreak Collector',NULL,'','http://ecx.images-amazon.com/images/I/51OdPFmWg%2BL._SL160_.jpg',NULL,'http://www.amazon.com/Call-Duty-Zombies-Outbreak-Collector/dp/B00J05MWVQ%3FSubscriptionId%3DAKIAJNX6ZS7EMGNEGMFQ%26tag%3Dlistmas-20%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativeASIN%3D','2014-10-13 18:38:02');

/*!40000 ALTER TABLE `tblprod` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
