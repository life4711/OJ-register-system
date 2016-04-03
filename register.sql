# Host: localhost  (Version: 5.5.47)
# Date: 2016-02-26 14:02:32
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES gb2312 */;

#
# Structure for table "contest_register_list"
#

DROP TABLE IF EXISTS `contest_register_list`;
CREATE TABLE `contest_register_list` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `start_time` date DEFAULT NULL,
  `end_time` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

#
# Data for table "contest_register_list"
#

/*!40000 ALTER TABLE `contest_register_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `contest_register_list` ENABLE KEYS */;

#
# Structure for table "contest_register_user"
#

DROP TABLE IF EXISTS `contest_register_user`;
CREATE TABLE `contest_register_user` (
  `id` bigint(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `major` varchar(255) DEFAULT NULL,
  `school` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `contest_id` int(11) DEFAULT NULL,
  `num` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

#
# Data for table "contest_register_user"
#

/*!40000 ALTER TABLE `contest_register_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `contest_register_user` ENABLE KEYS */;
