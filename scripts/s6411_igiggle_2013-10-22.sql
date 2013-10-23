# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.1.61)
# Database: s6411_igiggle
# Generation Time: 2013-10-21 22:11:02 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `user_hash` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `username`, `user_hash`, `first_name`, `last_name`, `email`)
VALUES
	(1,'di0fref','test','Fredrik','Fahlstad','fredrik@fahlstad.se');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table widget_data
# ------------------------------------------------------------

DROP TABLE IF EXISTS `widget_data`;

CREATE TABLE `widget_data` (
  `id` varchar(36) NOT NULL DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `nr_of_articles` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `widget_data` WRITE;
/*!40000 ALTER TABLE `widget_data` DISABLE KEYS */;

INSERT INTO `widget_data` (`id`, `user_id`, `url`, `title`, `nr_of_articles`)
VALUES
	('7b89735e-6ee7-4c8a-9651-a05f03564980',1,'https://news.google.se/news/feeds?pz=1&cf=all&ned=sv_se&hl=sv&topic=t&output=rss','Google News',NULL),
	('2c796a15-613f-48b6-8aff-bc000c001c15',1,'http://www.nyteknik.se/?service=rss','Ny Teknik',NULL),
	('1e954514-6997-4429-9490-93adb07b84cf',1,'http://svd.se/?service=rss','Svd',NULL),
	('8f72b634-6110-4fb9-9669-2483b143c9db',1,'http://www.affarsvarlden.se/?service=rss','AffÃ¤rsvÃ¤rlden',NULL),
	('9c276f07-e546-41ab-9353-ec837daaed22',1,'http://feeds.idg.se/ComputerSweden20SenasteNyheter','Computer Sweden',NULL),
	('19c92b7b-2172-48f7-8fcd-6c39e470dc7d',1,'http://svt.se/nyheter/rss.xml','svt.se',NULL),
	('41f4f2e0-52c2-4375-8af9-aae09da31c8b',1,'https://news.google.se/news/feeds?pz=1&cf=all&ned=sv_se&hl=sv&topic=t&output=rss','ed',NULL);

/*!40000 ALTER TABLE `widget_data` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table widgets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `widgets`;

CREATE TABLE `widgets` (
  `user_id` varchar(50) NOT NULL,
  `config` text NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `widgets` WRITE;
/*!40000 ALTER TABLE `widgets` DISABLE KEYS */;

INSERT INTO `widgets` (`user_id`, `config`)
VALUES
	('1','7b89735e-6ee7-4c8a-9651-a05f03564980,color-white,Google News,not-collapsed;2c796a15-613f-48b6-8aff-bc000c001c15,color-white,Ny Teknik,not-collapsed;41f4f2e0-52c2-4375-8af9-aae09da31c8b,color-white,ed,not-collapsed|9c276f07-e546-41ab-9353-ec837daaed22,color-white,Computer Sweden,not-collapsed;19c92b7b-2172-48f7-8fcd-6c39e470dc7d,color-white,svt.se,not-collapsed|1e954514-6997-4429-9490-93adb07b84cf,color-white,Svd,not-collapsed;8f72b634-6110-4fb9-9669-2483b143c9db,color-white,AffÃ¤rsvÃ¤rlden,not-collapsed');

/*!40000 ALTER TABLE `widgets` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
