<div class="block p-6 rounded-none shadow-lg bg-zinc-800 max-w-md w-3/5 jus">

<?php
if (!empty($_SESSION['user'])) {
?>
    <div class="alert alert-success text-white">Bienvenue <?=$_SESSION['user']['firstname']; ?></div>
    <br>
    <button type="submit" onclick="document.location.href='/index.php?page=logout'" class="
    w-full
    px-6
    py-2.5
    bg-zinc-600
    text-amber-300	
    font-medium
    text-xs
    leading-tight
    uppercase
    rounded-none
    shadow-md
    hover:hover:bg-zinc-400 hover:shadow-lg 
    focus:hover:bg-zinc-400 focus:shadow-lg focus:outline-none focus:ring-0
    active:bg-blue-800 active:shadow-lg
    transition
    duration-150
    ease-in-out">Sign out</button>
<?php
} else {
?>
    <div class="alert alert-danger text-white justify-center">Vous n'êtes pas connecté</div>
    <br>
    <button type="submit" onclick="document.location.href='/index.php?page=login'" class="
    w-full
    px-6
    py-2.5
    bg-zinc-600
    text-amber-200	
    font-medium
    text-xs
    leading-tight
    uppercase
    rounded-none
    shadow-md
    hover:bg-zinc-400 hover:shadow-lg 
    focus:bg-zinc-400 focus:shadow-lg focus:outline-none focus:ring-0
    active:bg-blue-800 active:shadow-lg
    transition
    duration-150
    ease-in-out">Sign in</button>
    <br><br>
    <button type="submit" onclick="document.location.href='/index.php?page=register'" class="
    w-full
    px-6
    py-2.5
    bg-zinc-600
    text-amber-200	
    font-medium
    text-xs
    leading-tight
    uppercase
    rounded-none
    shadow-md
    hover:bg-zinc-400 hover:shadow-lg
    focus:bg-zinc-400 focus:shadow-lg focus:outline-none focus:ring-0
    active:bg-blue-800 active:shadow-lg
    transition
    duration-150
    ease-in-out">Sign up</button>
<?php
}
?>

</div>