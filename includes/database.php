<?php
$host = "localhost";
$dbname = "logindata";
$database = "mysql:host=$host;dbname=$dbname";
$dbusername = "root";
$dbpassword = "Tokidoki123";


try{
    $pdo = new PDO($database,$dbusername,$dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

