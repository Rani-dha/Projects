
Databases and Tables Required for the Assignment
You already should have a PHP hosting environment such as MAMP or XAMPP installed or have some other access to a MySQL client to run commands.

You will need to create a database, a user to connect to the database and a password for that user using commands similar to the following:

create database bankingsystem;

GRANT ALL ON bankingsystem.* TO 'intern'@'localhost' IDENTIFIED BY 'spark';
GRANT ALL ON bankingsystem.* TO 'intern'@'127.0.0.1' IDENTIFIED BY 'spark';

You will need to make a connection to that database in a file like this if you are using MAMP (Macintosh):
<?php
$pdo = new PDO('mysql:host=localhost;port=8889;dbname=bankingsystem', 'intern', 'spark');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


If you are using XAMPP or Linux you should change the port to 3306:
<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bankingsystem', 'intern', 'spark');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

Usually this file is named pdo.php and is included in each of the files that want to use the database. You will need to change the user name and password on both your GRANT statements and in the code that makes the PDO connection.
You will also need to create and configure a table in the new "bankingsystem" database using the following SQL commands:

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(100) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `email_id` varchar(1000) NOT NULL,
  `balance` double NOT NULL DEFAULT '0'
)  ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `customer` (`id`, `customer_name`, `email_id`, `balance`) VALUES
(1, 'Dennis Ritchie', 'dennis.c@gmail.com', 10000),
(2, 'Linus Torvalds', 'linus.os@gmail.com', 60000),
(3, 'Bjarne Stroustrup', 'bjarne.cplusplus@gmail.com', 10000),
(4, 'Tim Berners-Lee', 'Tim.www@gmail.com', 20000),
(5, 'Donald Knuth', 'donald.algo@gmail.com', 50000),
(6, 'Ken Thompson', 'ken.unixos@gmail.com', 45000),
(7, 'Guido van Rossum', 'guido.py@gmail.com', 30000),
(8, 'James Gosling', 'james.java@gmail.com', 200000),
(9, ' Bill Gates', 'billgates.programmer@gmail.com', 60000),
(10, 'Ada Lovelace', 'adalove.maths@gmail.com', 80000),
(11, 'Mark Zuckerberg ', 'mark.facebook@gmail.com', 65000),
(12, 'Daphne Koller', 'daphne.coursera@gmail.com', 35000);
