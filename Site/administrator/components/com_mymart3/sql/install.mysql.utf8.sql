DROP TABLE IF EXISTS `#__mymart3users`;
 
CREATE TABLE `#__mymart3users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `mymart3id` varchar(36) NOT NULL,
  `onlinelearningenabled` BOOL NOT NULL, 
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__mymart3groups`;
 
CREATE TABLE `#__mymart3groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupid` int(11) NOT NULL,
  `onlinelearning` BOOL NOT NULL, 
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;