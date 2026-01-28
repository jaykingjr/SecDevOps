<?php
/*
	Class:		cop4433
	Project:	ACE Tutoring Lab
	Author:		Chaz
	Created:	10-20-2025
	Updated:	12-05-2025 Jay King
	Filename:	database.php

PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION is a configuration setting that instructs the PHP Data Objects (PDO) extension to throw a PDOException whenever a database error occurs. 

PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC is a configuration setting that tells the PHP Data Objects (PDO) extension to return database results as associative arrays by default. 
	
PDO::ATTR_EMULATE_PREPARES => false is a specific setting used when initializing a PHP Data Object (PDO) connection.
Purpose
- Enables "Real" Prepared Statements: Setting this attribute to false instructs PDO to use "real" prepared statements, which are natively supported by modern database drivers like MySQL.
- Security & Efficiency: This is generally considered a best practice for security against SQL injection attacks, as the query and the data are sent to the database server separately.	

*/
require_once "../errors/errorLog.php";
if ($_SERVER["HTTP_HOST"] == "domaintrusts.com") {
	$db   = "gvsdanet_ace";
	$user = "gvsdanet_ellis";
	$pass = "gulfcoaststatecollege";
} else {
	$db = "base_db";
	$user = "log_user";
	$pass = "pa55word";
}
$host = "localhost";
$charset = "utf8mb4";
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
	errorLog("database login", $e);
}
?>