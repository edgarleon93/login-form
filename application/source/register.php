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

        // if there are no errors, insert the user into the database
    if (empty($errors)) {
        // sanitize the input strings
        $data = [
            'firstname' => trim(htmlspecialchars($_POST['firstname'])),
            'lastname' => trim(htmlspecialchars($_POST['lastname'])),
            'email' => trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)),
            'password' => md5($_POST['password']),
        ];

        // check if the email already exists
        $emailExists = $db->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $emailExists->bindValue(":email", $data['email']);
        $emailExists->execute();

        if ($emailExists->fetchColumn() == 0) {
            // if the email does not exist, insert the user
            $query = $db->prepare('INSERT INTO users (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)');

            foreach ($data as $param => $value) {
                $query->bindValue(':' . $param, $value);
            }

            $query->execute();
        } else {
            // if the email exists, display an error
            $errors['email'] = 'Email is already used';
        }
    }

}

?>
<div class="block p-6 rounded-sm bg-zinc-900 max-w-md w-4/5">
    <h1 class="
    text-start 
    text-3xl
    text-white
    font-bold
    ">Welcome to LogForm</h1>
    <p class="
    text-slate-400
    text-sm 

    ">Creat your account</p>
    <br>
  <form method="post" action="index.php?page=register">
      <div class="form-group mb-6">
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="firstname" class="block 
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
            >Firstname</label>
        </div>
        <?=!empty($errors['firstname']) ? '<p class="text-red-300">' . $errors['firstname'] . '</p>' : ''; ?>
      </div>

      <div class="form-group mb-6">
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="lastname" class="block 
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
            >Laststname</label>
        </div>
          <?=!empty($errors['lastname']) ? '<p class="text-red-300">' . $errors['lastname'] . '</p>' : ''; ?>
      </div>

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

    <div class="form-group mb-6">
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

    <div class="form-group mb-6">
      <div class="relative z-0 w-full mb-6 group">
            <input type="password" name="password2" class="block 
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
            >Repeat Password</label>
        </div>
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
      hover:bg-zinc-600 hover:shadow-lg hover:text-amber-300
      focus:bg-zinc-600 focus:shadow-lg focus:outline-none focus:ring-0
      active:bg-blue-800 active:shadow-lg
      transition
      duration-300
      ease-in-out">Create my account</button>
      <div class="form-group mt-6 text-gray-200">
  </form>


</div>
<button type="" onclick="document.location.href='/index.php?page=login'" class="

    w-50
    py-2.5
    text-amber-200	
    text-xs
    leading-tight
    rounded-sm
    hover:text-amber-300
    focus:bg-zinc-800 focus:shadow-lg focus:outline-none focus:ring-0
    active:bg-blue-800 active:shadow-lg
    transition
    duration-300
    text-start
    ease-in-out">Already registered?</button>
  </div> 