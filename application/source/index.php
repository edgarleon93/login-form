
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
<!-- <div class="flex items-center justify-center h-screen" > -->
<?php

switch ($_GET['page'] ?? '') {
    case 'login':
        echo 'login';
        break;

    case 'register':
        require 'register.php';
        break;

    default:
        echo 'default';
        break;
}

?>
<!-- </div> -->
</body>
</html>