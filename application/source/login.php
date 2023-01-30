<?php
$errors = [];

// conditions si formulaire a ete envoyé 
if (!empty($_POST)) {

    // validation email
    if (empty($_POST['email'])) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email is not a valid email address';
    }

    // validation password
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password is required';
    }

    // si pas d'erreurs verifier que le user est en db
    if (empty($errors)) {

        // sanitize les string d'input 
        $data = [
            'email' => trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)),
            'password' => md5($_POST['password']),
        ];

        // demander le nombre de user qui on cette email et son mdp
        $query = $db->prepare('SELECT firstname, lastname, email FROM users WHERE email = :email AND password = :password');
        $query->bindValue(':email', $data['email']);
        $query->bindValue(':password', $data['password']);
        $query->execute();


        
        // store le resultat de la query
        $user = $query->fetch(PDO::FETCH_ASSOC);
        
        // si le user n'existe pas, afficher une erreurs
        if (!$user) {
            $errors['global'] = 'No user found with these credentials';
        }
        
        // si user existe, ob le met en session
        else {
            $_SESSION['user'] = $user;

            echo '<script>document.location.href = "/index.php";</script>';
            exit;    
        }     
    }
}
?>

<div class="block p-6 rounded-sm shadow-lg bg-zinc-900 max-w-md w-3/5">
  <form method="post" action="index.php?page=login">
    <div class="form-group mb-6 border-b border-gray-200">
      <input type="email" name="email"  class="form-control block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-200
        bg-transparent
        border-none
        rounded-sm
        transition
        ease-in-out
        m-0 
        focus:outline-none 
        " id="exampleInput125"
        placeholder="Email address">

        <?=!empty($errors['email']) ? '<p class="text-red-300">' . $errors['email'] . '</p>' : ''; ?>

    </div>
    <div class="form-group mb-6 border-b border-gray-200">
      <input type="password" name="password" class="form-control block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-200
        bg-transparent
        border-none
        rounded-sm
        transition
        ease-in-out
        m-0   
        focus:outline-none     
        "id="exampleInput126"
        placeholder="Password">

        <?=!empty($errors['password']) ? '<p class="text-red-300">' . $errors['password'] . '</p>' : ''; ?>

    </div>   
    <button type="submit" class="
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
      hover:bg-zinc-600 hover:shadow-lg hover:amber-100
      focus:bg-zinc-600 focus:shadow-lg focus:outline-none focus:ring-0
      active:bg-blue-800 active:shadow-lg
      transition
      duration-300
      ease-in-out">Sign in</button>

      <?=!empty($errors['global']) ? '<p class="text-red-300">' . $errors['global'] . '</p>' : ''; ?>
  </form>
  <div class="form-group mt-6 text-gray-200">
  <button type="" onclick="document.location.href='/index.php?page=register'" class="
    w-full
    py-2.5
    text-amber-200	
    text-xs
    leading-tight
    rounded-sm
    hover:bg-zinc-800 hover:shadow-lg hover:amber-100
    focus:bg-zinc-800 focus:shadow-lg focus:outline-none focus:ring-0
    active:bg-blue-800 active:shadow-lg
    transition
    duration-300
    ease-in-out">Not registered yet?</button>
  </div> 
</div>