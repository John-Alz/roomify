<?php

$server = "localhost";
$dbName = "roomify";
$user = "root";
$password = "";


try {
    $conexion = new PDO("mysql:host=$server;dbname=$dbName", $user, $password);
    // echo "CONEXION ESTABLECIDA";
} catch (Exception $error) {
    echo $error -> getMessage();
}


