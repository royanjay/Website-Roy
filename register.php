<?php
include "service/database.php";
session_start();

$register_message = "";

if(isset($_SESSION["is_login"])) {
  header("location: dashboard.php");
}

if (isset($_POST["register"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $email = $_POST["email"];
  $no_tlp = $_POST["no_tlp"];

  try {
    $sql = "INSERT INTO user (username, password, email, no_tlp) VALUES
    ('$username' , '$password' , '$email' , '$no_tlp')";

   if ($db->query($sql)) {
   $register_message = "daftar akun berhasil, silahkan login";
   } else {
   $register_message = "Daftar akun gagal,Silahkan Coba lagi";
   }
  }catch (mysqli_sql_exception) {
     $register_message = "Username sudah digunakan,Silahkan ganti yang lain";
  }
  $db->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style_register.css">
</head>

<body>
  <?php include "layout/header.html" ?>
  
  <h3> Daftar Akun</h3>
  <i> <?= $register_message ?> </i>

  <form action="register.php" method="POST">
    <input type="text" placeholder="username" name="username">
    <input type="text" placeholder="email" name="email"> 
    <input type="password" placeholder="password" name="password">
    <input type="text" placeholder="no_tlp" name="no_tlp">
    <button type="submit" name="register">Daftar Sekarang</button>
  </form>
</body>

</html>