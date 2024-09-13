<?php 
include "service/database.php";
session_start();

$login_message = "";

if(isset($_SESSION["is_login"])) {
    header("location: dashboard.php");
}

   if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST ['email'];
    $no_tlp = $_POST ['no_tlp'];

    $sql = "SELECT * FROM user WHERE 
    username='$username' AND 
    password='$password' AND
    email='$email' AND
    no_tlp=$no_tlp
    ";

    $result = $db->query($sql);

    if($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $_SESSION["username"] = $data["username"];
        $_SESSION["is_login"] = true;
        
      header("location: dashboard.php");

    } else {
        $login_message = "Akun tidak ditemukan";
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
    <link rel="stylesheet" href="style_login.css">
</head>
<body>
    <?php include "layout/header.html" ?>
    <h3> Masuk Akun</h3>

     <i> <?= $login_message ?> </i>

    <form action="login.php" method="POST">
        <input type="text" placeholder="username" name="username">
        <input type="text" placeholder="email" name="email"> 
        <input type="password" placeholder="password" name="password">
        <input type="text" placeholder="no_tlp" name="no_tlp">
        <button type="submit" name="login">Masuk Sekarang</button>
    </form>
</body>
</html>