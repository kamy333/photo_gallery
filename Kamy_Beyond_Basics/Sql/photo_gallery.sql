



# copy from kamy

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `hashed_password` varchar(60) NOT NULL,
  `nom` varchar(60) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `user_type` varchar(60) DEFAULT NULL,
  `user_type_id` int(11) NOT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `cp` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `country` varchar(60) DEFAULT NULL,
  `phone` varchar(60) DEFAULT NULL,
  `mobile` varchar(60) DEFAULT NULL,
  `img` longblob,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `user_type_id` (`user_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;
--
-- Dumping data for table `admins`
--

select * from admins WHERE username='kamy';

INSERT INTO admins (id, username, hashed_password, nom, email, user_type, user_type_id, first_name, last_name, address, cp, city, country, phone, mobile, img) VALUES (1, 'admin', '$2y$10$YzYyN2U3MjBkNGQ4MTliOOYg0RfXSbg5pFOVsO1vOeEFamBhPdnYS', 'admin', 'webmaster@ikamy.ch', 'admin', 1, null, null, null, null, null, null, null, null, null);
INSERT INTO admins (id, username, hashed_password, nom, email, user_type, user_type_id, first_name, last_name, address, cp, city, country, phone, mobile, img) VALUES (2, 'kamy', '$2y$10$MmY3YTUwNTA4MzZjYWZiOORpVvLvjpsyBJ1a0p/vVfQLUNGu1e76W', 'Kamran NAFISSPOUR', 'nafisspour@bluewin.ch', 'admin', 1, 'Kamran', 'Nafisspour', '68 rue des Vollandes', '1207', 'Genève', 'Suisse', '+41 (22) 7350120', '+41 (79) 350 21 32', null);
INSERT INTO admins (id, username, hashed_password, nom, email, user_type, user_type_id, first_name, last_name, address, cp, city, country, phone, mobile, img) VALUES (4, 'pablo', '$2y$10$OGEwYmRkMjc5NTNhMTVhNeS9iamczbZH3ag9qt2EXM8EliS2UwUTO', 'Pablo Arza', 'transmed@bluewin.ch', 'employee', 4, null, null, null, null, null, null, null, null, null);
INSERT INTO admins (id, username, hashed_password, nom, email, user_type, user_type_id, first_name, last_name, address, cp, city, country, phone, mobile, img) VALUES (5, 'kamy333', '$2y$10$OTAyYzczMGNmMzI2Y2ZjN.faDoYq2/ZSaAK42684GEbpTJ2/Q2Lyq', 'Kamy Manager', 'kamy333@hotmail.com', 'manager', 2, null, null, null, null, null, null, null, null, null);
INSERT INTO admins (id, username, hashed_password, nom, email, user_type, user_type_id, first_name, last_name, address, cp, city, country, phone, mobile, img) VALUES (7, 'gmail', '$2y$10$MWU4N2E5MDcwNDRjYjM1Mu2URCsGI9fUp9JCdmPZCX1cYOlmzeu5O', 'Kamy employee', 'kamran.nafisspour@gmail.com', 'employee', 4, null, null, null, null, null, null, null, null, null);


DROP TABLE IF EXISTS photograph;
CREATE TABLE IF NOT EXISTS photographs (
  `id` int(11) NOT NULL AUTO_INCREMENT ,
  `filename` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `size` int(11) NOT NULL ,
  `caption` varchar(255) NOT NULL ,
      PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;


DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL auto_increment,
  `photograph_id` int(11) NOT NULL ,
  `created` datetime NOT NULL,
  `author` varchar(255) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `photograph_id` (`photograph_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

SHOW INDEXES FROM comments;
--
-- Dumping data for table `comments`
--
# INSERT INTO `comments` VALUES (1,1,'2009-01-01 11:30:39','Kevin','I love this picture!');



CREATE TABLE links_category (
  id int(11) NOT NULL AUTO_INCREMENT ,
  category varchar(50) NOT NULL UNIQUE ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;



CREATE TABLE links (
  id int(11) NOT NULL AUTO_INCREMENT ,
  name varchar(50) NOT NULL ,
  web_address text DEFAULT NULL,
  description text DEFAULT NULL,
  category varchar(50) NOT NULL DEFAULT 'Others',
  sub_category_1 varchar(50) NULL ,
  sub_category_2 varchar(50) NULL ,
  privacy TINYINT(1) DEFAULT 0,
  rank INT(11) DEFAULT 0,
  username varchar(50) NOT NULL ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

