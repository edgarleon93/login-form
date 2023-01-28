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

<div class="block p-6 rounded-lg shadow-lg bg-white max-w-md w-3/5">
  <form method="post" action="index.php?page=login">
    <div class="form-group mb-6">
      <input type="email" name="email"  class="form-control block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInput125"
        placeholder="Email address">

        <?=!empty($errors['email']) ? '<p>' . $errors['email'] . '</p>' : ''; ?>

    </div>
    <div class="form-group mb-6">
      <input type="password" name="password" class="form-control block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInput126"
        placeholder="Password">

        <?=!empty($errors['password']) ? '<p>' . $errors['password'] . '</p>' : ''; ?>

    </div>   
    <button type="submit" class="
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

      <?=!empty($errors['global']) ? '<p>' . $errors['global'] . '</p>' : ''; ?>
  </form>
</div>