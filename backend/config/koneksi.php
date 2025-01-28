<?php 
$database_hostname = "localhost";
$database_password = "";
$database_username ="Irpan";
$database_name = "latihan9";

try{
    $db = new PDO("mysql:host=$database_hostname;dbname=$database_name", "$database_username", "$database_password");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    die("Koneksi database gagal: " . $e->getMessage());
}

?>