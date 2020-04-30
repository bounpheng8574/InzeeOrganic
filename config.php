<?php

	$DB_HOST = 'localhost';
	$DB_USER = 'root';
	$DB_PASS = '';
	$DB_NAME = 'organicfinal';
	
	try{
		$DB_con = new PDO("mysql:host={$DB_HOST};dbname={$DB_NAME}",$DB_USER,$DB_PASS);
		$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$DB_con->exec("set names utf8; SET time_zone = 'Aisa/Vientiane'");
		// $DB_con->exec("set names utf8; SET time_zone = 'Aisa/Vientiane'");
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	
?>