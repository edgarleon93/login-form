CREATE DATABASE IF NOT EXISTS mydb;
USE mydb;

CREATE USER 'form'@'%' IDENTIFIED VIA mysql_native_password USING 'password';
GRANT ALL PRIVILEGES ON `mydb`.* TO 'form'@'%';

CREATE TABLE `mydb`.`users` ( 
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT , 
	`firstname` VARCHAR(255) NOT NULL , 
	`lastname` VARCHAR(255) NOT NULL , 
	`email` VARCHAR(255) NOT NULL , 
	`password` VARCHAR(255) NOT NULL , 
	PRIMARY KEY (`id`)
)