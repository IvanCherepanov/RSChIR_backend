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

create table car (
                     id INT PRIMARY KEY,
                     name VARCHAR(50),
                     year VARCHAR(50),
                     price INT
);
insert into car (id, name, year, price) values (1, '4000CS Quattro', 1987, 4923744);
insert into car (id, name, year, price) values (2, 'QX', 1999, 2860570);
insert into car (id, name, year, price) values (3, 'SRX', 2009, 3299241);
insert into car (id, name, year, price) values (4, 'Concorde', 2000, 2521714);
insert into car (id, name, year, price) values (5, 'Hombre', 1996, 3578007);
insert into car (id, name, year, price) values (6, 'FCX Clarity', 2012, 4825938);
insert into car (id, name, year, price) values (7, 'E-Class', 2004, 3966406);
insert into car (id, name, year, price) values (8, '911', 1993, 2302410);
insert into car (id, name, year, price) values (9, 'Regal', 2001, 3295496);
insert into car (id, name, year, price) values (10, 'Roadster', 2011, 2610274);
insert into car (id, name, year, price) values (11, 'Element', 2006, 4480005);
insert into car (id, name, year, price) values (12, 'Colorado', 2008, 4782963);
insert into car (id, name, year, price) values (13, 'Escalade EXT', 2012, 3350377);
insert into car (id, name, year, price) values (14, 'Park Avenue', 1999, 3347824);
insert into car (id, name, year, price) values (15, 'Suburban 1500', 1998, 1511401);
insert into car (id, name, year, price) values (16, 'Odyssey', 1995, 4497438);
insert into car (id, name, year, price) values (17, 'Laser', 1985, 3447126);
insert into car (id, name, year, price) values (18, 'Mustang', 2011, 1080031);
insert into car (id, name, year, price) values (19, 'Continental Mark VII', 1986, 1985803);
insert into car (id, name, year, price) values (20, 'Gallardo', 2007, 4339346);