<?php
// demarage session php
session_start(); 

// initialisation du connecteur mySQL
$db = new PDO('mysql:host=database;dbname=mydb','form', 'password');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="index.css">
    <title>Login form</title>
</head>
<body>
<div class="flex items-center justify-center h-screen bg-slate-800 " >
<?php

switch ($_GET['page'] ?? '') {
    case 'login':
        require 'login.php';
        break;

    case 'register':
        require 'register.php';
        break;
    
    case 'logout':
        session_destroy();
        echo '<script>document.location.href = "/index.php";</script>';
        exit; 

    default:
        require 'home.php';
        break;
}

?>
</div>
</body>
</html>