CREATE TABLE IF NOT EXISTS `#__obacht_instagram` (
	`id` int(10) NOT NULL,
	`token` varchar(255) NOT NULL,
	`expire_time` DATETIME NOT NULL,

  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

INSERT INTO `#__obacht_instagram` (`id`, `token`, `expire_time`) VALUES (1, 'NO TOKEN', NOW());