<?php
session_start();

require_once("database.php");
require_once("user.php");

if(isset($_POST["input_username"]) && isset($_POST["input_password"])){

$username = $_POST["input_username"];
$password = $_POST["input_password"];

$db = new Database();
$conn = $db->koneksi();
$user = new User($conn);



$ditemukan = $user->login ($username, $password);

if($ditemukan == false){
    $_SESSION ['pesan_kesalahan']="Login gagal";
    header ("Location: index.php");
    exit;
}else{
    $_SESSION['is_logged_in'] = true;
    header ("Location: dashboard/index.php");
    exit;
}

if($password == $password_valid &&
    $username == $username_valid)

echo "Selamat Datang" . $username;
echo "<br/>";
echo "Password anda" . $password;

if($ditemukan){
    session_start();
    $_SESSION['username'] = $username;
    
    $sql = "UPDATE user SET jumlah_login = jumlah_login + 1
            WHERE username='$username'";
    
    mysqli_query($conn,$sql);
    header("Location: dashboard/index.php");
}

//$username_valid = "Amalia";
//$password_valid = "12345678";
//if($password == $password_valid && $username == $username_valid ){
//   echo "Selamat Datang ".$username ; 
//}else{
//    echo "Password salah";
//}
}
