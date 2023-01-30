<?php
// demarage session php
session_start(); 

// initialisation du connecteur mySQL
$db = new PDO('mysql:host=database;dbname=mydb','form', 'password');
?>
<style><?php include './index.css'; ?></style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./index.css" rel="stylesheet">
     <script src="https://cdn.tailwindcss.com"></script>
    <title>Login form</title>
</head>
<body>


<nav class="bg-white border-gray-200 px-2 sm:px-2 py-1 rounded-none dark:bg-zinc-900">
  <div class="container flex flex-wrap items-center justify-between mx-auto">
  <div class="flex md:order-1">
  <button type="submit" onclick="document.location.href='/index.php?page=login'" class="
    w-full
    px-6
    py-2.5
    bg-zinc-800
    text-amber-200	
    font-medium
    text-xs
    leading-tight
    uppercase
    rounded-sm
    shadow-md
    border border-amber-200
    hover:bg-zinc-600 hover:shadow-lg hover:text-amber-300 hover:border-amber-300
    focus:bg-zinc-600 focus:shadow-lg focus:outline-none focus:ring-0
    active:bg-blue-800 active:shadow-lg
    transition
    duration-300
    ease-in-out">Login</button>
    </button>
  </div>

  <div class="flex md:order-2">
  <button type="submit" onclick="document.location.href='/index.php?page=register'" class="
    w-full
    px-6
    py-2.5
    bg-zinc-800
    text-amber-200	
    font-medium
    text-xs
    leading-tight
    uppercase
    rounded-sm
    shadow-md
    border border-amber-200
    hover:bg-zinc-600 hover:shadow-lg hover:text-amber-300 hover:border-amber-300
    focus:bg-zinc-600 focus:shadow-lg focus:outline-none focus:ring-0
    active:bg-blue-800 active:shadow-lg
    transition
    duration-300
    ease-in-out">Register</button>
    </button>
  </div>

</nav>
    
<div class="flex items-center justify-center h-screen bg-gradient-to-r from-neutral-800 to-slate-800 " >
<?php

switch ($_GET['page'] ?? '') {
    case 'index';
        require 'index.php';
        break;

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