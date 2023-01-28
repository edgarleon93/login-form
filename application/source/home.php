<div class="block p-6 rounded-lg shadow-lg bg-white max-w-md w-3/5">

<?php
if (!empty($_SESSION['user'])) {
?>
    <div class="alert alert-success">Bienvenue <?=$_SESSION['user']['firstname']; ?></div>
    <br>
    <button type="submit" onclick="document.location.href='/index.php?page=logout'" class="
    w-full
    px-6
    py-2.5
    bg-blue-600
    text-white
    font-medium
    text-xs
    leading-tight
    uppercase
    rounded
    shadow-md
    hover:bg-blue-700 hover:shadow-lg
    focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
    active:bg-blue-800 active:shadow-lg
    transition
    duration-150
    ease-in-out">Sign out</button>
<?php
} else {
?>
    <div class="alert alert-danger">Vous n'êtes pas connecté</div>
    <br>
    <button type="submit" onclick="document.location.href='/index.php?page=login'" class="
    w-full
    px-6
    py-2.5
    bg-blue-600
    text-white
    font-medium
    text-xs
    leading-tight
    uppercase
    rounded
    shadow-md
    hover:bg-blue-700 hover:shadow-lg
    focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
    active:bg-blue-800 active:shadow-lg
    transition
    duration-150
    ease-in-out">Sign in</button>
    <br><br>
    <button type="submit" onclick="document.location.href='/index.php?page=register'" class="
    w-full
    px-6
    py-2.5
    bg-blue-600
    text-white
    font-medium
    text-xs
    leading-tight
    uppercase
    rounded
    shadow-md
    hover:bg-blue-700 hover:shadow-lg
    focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
    active:bg-blue-800 active:shadow-lg
    transition
    duration-150
    ease-in-out">Sign up</button>
<?php
}
?>

</div>