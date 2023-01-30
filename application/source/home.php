<div class="block p-6 rounded-sm shadow-lg bg-zinc-900 max-w-md w-3/5 jus">

<?php
if (!empty($_SESSION['user'])) {
?>
    <div class="text-center font-bold text-transparent text-3xl bg-clip-text text-white"> Bienvenue 
    <span class="font-extrabold text-transparent text-3xl bg-clip-text bg-gradient-to-r from-red-300 to-amber-300 text-center"> <?=$_SESSION['user']['firstname']; ?></span></div>
    <br>
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
    hover:hover:bg-zinc-600 hover:shadow-lg hover:text-amber-300
    focus:hover:bg-zinc-600 focus:shadow-lg focus:outline-none focus:ring-0
    active:bg-blue-800 active:shadow-lg
    transition
    duration-300
    ease-in-out">Sign out</button>
<?php
} else {
?>
    <div class="font-extrabold alert text-4xl alert-danger text-white  justify-center text-center">Vous n'êtes pas connecté</div>
    <br>
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
    hover:bg-zinc-600 hover:shadow-lg 
    focus:bg-zinc-600 focus:shadow-lg focus:outline-none focus:ring-0
    active:bg-blue-800 active:shadow-lg
    transition
    duration-300
    ease-in-out">Sign in</button>
    <br><br>
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
    hover:bg-zinc-600 hover:shadow-lg
    focus:bg-zinc-600 focus:shadow-lg focus:outline-none focus:ring-0
    active:bg-blue-800 active:shadow-lg
    transition
    duration-300
    ease-in-out">Register</button>
<?php
}
?>

</div>