<?php

require_once "database.php";
require_once "user.php";

$username = $_POST["username"];
$email =  $_POST["email"];
$asal =  $_POST["asal"];
$password = $_POST["password"];
$password_ulang = $_POST["password_ulang"];


if(isset($_POST["setuju"])){
    echo "Anda telah menyetujui form";

    if($password != $password_ulang){
        echo "Password tidak sama";
        die;
    }

    $database = new Database;
    $koneksi_db = $database->koneksi();

    $user = new User($koneksi_db);
    $user->create($username, $email, $asal, $password);
    echo "<br>";
    echo "Database terhubung";
}else{
    echo "Anda harus menyutujui form";
}