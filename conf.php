<?php

$serverinimi = "localhost"; // d101711.mysql.zonevs.eu
$kasutaja = "belov21"; // d101711_belov1
$parool = "12345"; // parol
$andmebaas = "belov21"; //d101711_belov1
$yhendus = new mysqli ($serverinimi, $kasutaja, $parool, $andmebaas);
$yhendus->set_charset('UTF8');

/**
 * create table laulud(
id int primary key AUTO_INCREMENT,
laulunimi varchar (50),
lisamisaeg datetime,
punktid int DEFAULT 0,
kommentaarid text
)
 */