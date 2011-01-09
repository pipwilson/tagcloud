# --------------------------------------------------------
# Host:                         127.0.0.1
# Database:                     tagcloudtest
# Server version:               5.1.37
# Server OS:                    Win32
# HeidiSQL version:             5.0.0.3272
# Date/time:                    2011-01-09 22:07:24
# --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

# Dumping structure for table tagcloudtest.tagcloud_content
CREATE TABLE IF NOT EXISTS `tagcloud_content` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `post_content` varchar(6000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

# Data exporting was unselected.


# Dumping structure for table tagcloudtest.tagcloud_tags
CREATE TABLE IF NOT EXISTS `tagcloud_tags` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `tag` varchar(40) NOT NULL,
  `weight` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag` (`tag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

# Data exporting was unselected.
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
