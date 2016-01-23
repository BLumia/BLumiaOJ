set names utf8; 

CREATE TABLE  `videores` (
  `vid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `videodesc` varchar(90) NOT NULL,
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `url` varchar(80) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `pid` int(11) NOT NULL,
  `author_id` varchar(20) NOT NULL,
  PRIMARY KEY (`vid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

