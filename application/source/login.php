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

<div class="block p-6 rounded-sm shadow-lg bg-zinc-900 max-w-md w-4/5">
  <form method="post" action="index.php?page=login">
    <div class="form-group mb-6">
    <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="email" class="block 
            py-2.5 
            px-0 
            w-full 
            text-sm 
            text-gray-900 
            bg-transparent 
            border-0 
            border-b-2 
            border-gray-300 
            appearance-none 
            dark:text-white 
            dark:border-gray-600 
            dark:focus:border-amber-200 
            focus:outline-none 
            focus:ring-0 
            focus:border-blue-600 
            peer" placeholder=" " required />
            <label for="floating_email" class="peer-focus:font-medium
             absolute 
             text-sm 
             text-gray-500 
             dark:text-gray-400 
             duration-300 
             transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] 
             peer-focus:left-0 
             peer-focus:text-amber-200 
             peer-focus:dark:text-amber-200 
             peer-placeholder-shown:scale-100 
             peer-placeholder-shown:translate-y-0 
             peer-focus:scale-75 peer-focus:-translate-y-6"
            >Address email</label>
        </div>

        <?=!empty($errors['email']) ? '<p class="text-red-300">' . $errors['email'] . '</p>' : ''; ?>

    </div>
    <div class="form-group mb-6 border-gray-200">
    <div class="relative z-0 w-full mb-6 group">
            <input type="password" name="password" class="block 
            py-2.5 
            px-0 
            w-full 
            text-sm 
            text-gray-900 
            bg-transparent 
            border-0 
            border-b-2 
            border-gray-300 
            appearance-none 
            dark:text-white 
            dark:border-gray-600 
            dark:focus:border-amber-200 
            focus:outline-none 
            focus:ring-0 
            focus:border-blue-600 
            peer" placeholder=" " required />
            <label for="floating_email" class="peer-focus:font-medium
             absolute 
             text-sm 
             text-gray-500 
             dark:text-gray-400 
             duration-300 
             transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] 
             peer-focus:left-0 
             peer-focus:text-amber-200 
             peer-focus:dark:text-amber-200 
             peer-placeholder-shown:scale-100 
             peer-placeholder-shown:translate-y-0 
             peer-focus:scale-75 peer-focus:-translate-y-6"
            >Password</label>
        </div>

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