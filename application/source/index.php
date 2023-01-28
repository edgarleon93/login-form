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
    <title>Document</title>
</head>
<body>
<div class="flex items-center justify-center h-screen" >
<?php

switch ($_GET['page'] ?? '') {
    case 'login':
        require 'login.php';
        break;

    case 'register':
        require 'register.php';
        break;

    default:
        print_r($_SESSION);
        break;
}

?>
</div>
</body>
</html>