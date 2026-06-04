<?php

session_start();

require_once("database.php");
require_once("user.php");

$username = $_POST["input_username"];
$password = $_POST["input_password"];

$db = new Database();
$conn = $db->koneksi();
$user = new User($conn);

$ditemukan = $user->login ($username, $password);

if($ditemukan == false){
    $_SESSION ['pesan_kesalahan']="Login gagal"
    header ("Location: index.html");
    exit;
}else{
    $_SESSION['is_logged_in'] = true;
    header ("Location: dashboard/index.php");
    exit;
}

$_SESSION['is_logged_in'] = true;
$_SESSION['username'] = $username;
header("Location: dashboard/index.php");
exit;

//$username_valid = "Amalia";
//$password_valid = "12345678";
//if($password == $password_valid && $username == $username_valid ){
//   echo "Selamat Datang ".$username ; 
//}else{
//    echo "Password salah";
//}
