<?php
$errors = [];

// conditions si formulaire a ete envoyé 
if (!empty($_POST)) {

    // validation firstname
    if (empty($_POST['firstname'])) {
        $errors['firstname'] = 'First name is required';
    } elseif (strlen($_POST['firstname']) >= 255) {
        $errors['firstname'] = 'First name should be less than 255 characters';
    }

    // validation lastname
    if (empty($_POST['lastname'])) {
        $errors['lastname'] = 'Last name is required';
    } elseif (strlen($_POST['lastname']) >= 255) {
        $errors['lastname'] = 'Last name should be less than 255 characters';
    }

    // validation email
    if (empty($_POST['email'])) {
        $errors['email'] = 'Email is required';
    } elseif (strlen($_POST['email']) >= 255) {
        $errors['email'] = 'Email should be less than 255 characters';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email is not a valid email address';
    }

    // validation password
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password is required';
    } elseif (strlen($_POST['password']) >= 255) {
        $errors['password'] = 'Password should be less than 255 characters';
    } elseif (strlen($_POST['password']) < 8) {
        $errors['password'] = 'Password should be at least 8 characters';
    }

    // validation password2
    if (empty($_POST['password2'])) {
        $errors['password2'] = 'Password verification is required';
    } elseif ($_POST['password'] !== $_POST['password2']) {
        $errors['password2'] = 'Password verification is not the same as password';
    }

    // si pas d'erreurs mettre user en db
    if (empty($errors)) {

        // sanitize les string d'input 
        $data = [
            'firstname' => trim(htmlspecialchars($_POST['firstname'])),
            'lastname' => trim(htmlspecialchars($_POST['lastname'])),
            'email' => trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)),
            'password' => md5($_POST['password']),
        ];

        // demander le nombre de user qui on cette email
        $query = $db->prepare('SELECT COUNT(*) FROM users WHERE email = :email');
        $query->bindValue(':email', $data['email']);
        $query->execute();
        
        // store le resultat de la query
        // $userExists = $query->fetchColumn() !== 0;

        echo '<pre>';
        print_r($query->fetchColumn());
        echo '</pre>';

        // si le user n'existe pas, inserer en db
        if (empty($query->fetchColumn)) {
            $query = $db->prepare('INSERT INTO users (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)');
            
            foreach ($data as $param => $value) {
                $query->bindValue(':' . $param, $value);
            }

            $query->execute();
        }
        
        // si user existe, afficher une erreur
        else {
            $errors['email'] = 'Email is already used';
        }     
    }
}

?>

<div class="block p-6 rounded-sm bg-zinc-900 max-w-md w-3/5 border-gradient-to-br from-red-200 via-red-300 to-yellow-200">
  <form method="post" action="index.php?page=register">
      <div class="form-group mb-6 border-b">
        <input type="text" name="firstname" class="form-control
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-200
        bg-transparent
        border-none
        border border-b border-amber-200
        rounded-sm
        transition
        ease-in-out
        m-0"
        placeholder="John">

          <?=!empty($errors['firstname']) ? '<p class="text-red-300">' . $errors['firstname'] . '</p>' : ''; ?>

      </div>
      <div class="form-group mb-6 border-b">
        <input type="text" name="lastname" class="form-control
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-200
        bg-transparent
        border-none
        border border-b border-amber-200
        rounded-sm
        transition
        ease-in-out
        m-0  "
        placeholder="Doe">

          <?=!empty($errors['lastname']) ? '<p class="text-red-300">' . $errors['lastname'] . '</p>' : ''; ?>

      </div>
    <div class="form-group mb-6 border-b">
      <input type="email" name="email"  class="form-control block
      w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-200
        bg-transparent
        border-none
        border border-b border-amber-200
        rounded-sm
        transition
        ease-in-out
        m-0  " 
        placeholder="johndoe@2023.com">

        <?=!empty($errors['email']) ? '<p class="text-red-300">' . $errors['email'] . '</p>' : ''; ?>

    </div>
    <div class="form-group mb-6 border-b">
      <input type="password" name="password" class="form-control block
      w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-200
        bg-transparent
        border-none
        border border-b border-amber-200
        rounded-sm
        transition
        ease-in-out
        m-0  " 
        placeholder="8+ strong character">

        <?=!empty($errors['password']) ? '<p class="text-red-300">' . $errors['password'] . '</p>' : ''; ?>

    </div>
    <div class="form-group mb-6 border-b">
      <input type="password" name="password2" class="form-control block
      w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-200
        bg-transparent
        border-none
        border border-b border-amber-200
        rounded-sm
        transition
        ease-in-out
        m-0  " 
        placeholder="Repeat 8+ strong character">

        <?=!empty($errors['password2']) ? '<p class="text-red-300">' . $errors['password2'] . '</p>' : ''; ?>

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
      ease-in-out">Create an account</button>
      <div class="form-group mt-6 text-gray-200">
  </form>


</div>
<button type="" onclick="document.location.href='/index.php?page=login'" class="
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
    ease-in-out">Already registered?</button>
  </div> 