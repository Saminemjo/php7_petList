## MySQL tables :


CREATE TABLE IF NOT EXISTS `users` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `username` varchar(50) NOT NULL,
 `email` varchar(50) NOT NULL,
 `password` varchar(50) NOT NULL,
 `trn_date` datetime NOT NULL,
 PRIMARY KEY (`id`)
 );

 CREATE TABLE IF NOT EXISTS `pets` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user` varchar(50) NOT NULL,
 `specie` varchar(50),
 `name` varchar(50),
 `specie` varchar(50),
 `identity` varchar(50),
 `birthdate` varchar(25),
 `sex`  varchar(50),
 `food` varchar(50),
 `description` text,
 PRIMARY KEY (`id`)
 );
