CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT SELECT,UPDATE,INSERT ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE appDB;

CREATE TABLE IF NOT EXISTS users (
  ID INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(20) NOT NULL,
  surname VARCHAR(40) NOT NULL,
  password VARCHAR(240) NOT NULL,
  PRIMARY KEY (ID)
);

CREATE TABLE IF NOT EXISTS products (
    ID INT(11) NOT NULL AUTO_INCREMENT,
    description VARCHAR(20) NOT NULL,
    price int NOT NULL,
    PRIMARY KEY (ID)
    );

INSERT INTO users (name, surname, password)
VALUES ('admin', 'adminovich','admin');

INSERT INTO users (name, surname, password)
VALUES ('admin2', 'adminovich','{SHA}d033e22ae348aeb5660fc2140aec35850c4da997');

INSERT INTO users (name, surname, password)
VALUES ('admin3', 'adminovich','{SHA}QV77lL0gK8qvC/dLp1ugXj3pPeg=');

INSERT INTO users (name, surname, password)
VALUES ('neadmin', 'neadminovich','neadmin');

INSERT INTO users (name, surname, password)
VALUES ('geralt', 'riviya','gwint');

INSERT INTO products(description, price)
VALUES ('Bread', 40);

INSERT INTO products(description, price)
VALUES ('Meat', 240);

INSERT INTO products(description, price)
VALUES ('Cake', 300);

CREATE TABLE `country` (
                           `code` CHAR(2) NOT NULL PRIMARY KEY,
                           `name` CHAR(52) NOT NULL,
                           `population` INT(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `country` VALUES ('AU','Australia',24016400);
INSERT INTO `country` VALUES ('BR','Brazil',205722000);
INSERT INTO `country` VALUES ('CA','Canada',35985751);
INSERT INTO `country` VALUES ('CN','China',1375210000);
INSERT INTO `country` VALUES ('DE','Germany',81459000);
INSERT INTO `country` VALUES ('FR','France',64513242);
INSERT INTO `country` VALUES ('GB','United Kingdom',65097000);
INSERT INTO `country` VALUES ('IN','India',1285400000);
INSERT INTO `country` VALUES ('RU','Russia',146519759);
INSERT INTO `country` VALUES ('US','United States',322976000);
