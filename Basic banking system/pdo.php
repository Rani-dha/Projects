<?php
// You must grant privileges to access the database in PhpMyAdmin by using SQL query.
// GRANT ALL PRIVILEGES TO intern@'localhost' IDENTIFIED BY 'spark';
// FLUSH PRIVILEGES; // to update without loading flush privileges are used.

try 
{   //Development database connection 
    // $pdo = new PDO('mysql:host=localhost;port=3306;dbname=bankingsystem', 'intern', 'spark');

    // Remote Database Connection
    $pdo = new PDO('mysql:host=remotemysql.com;port=3306;dbname=iJLW6yxWAP', 'iJLW6yxWAP', '8W486dzHK0');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // set the PDO error mode to exception
}
catch(PDOException $e)
{   
    echo "Connection failed: " . $e->getMessage();
    die();
}
