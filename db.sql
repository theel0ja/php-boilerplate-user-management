CREATE DATABASE app_database CHARACTER SET utf8 COLLATE utf8_swedish_ci;

USE app_database;

CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` TEXT NOT NULL,
  `password` TEXT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARSET utf8;
