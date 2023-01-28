<?php
$errors = [];

if (!empty($_POST)) {
    if (empty($_POST['firstname'])) {
        $errors['firstname'] = 'First name is required';
    } elseif (strlen($_POST['firstname']) >= 255) {
        $errors['firstname'] = 'First name should be less than 255 characters';
    }

    if (empty($_POST['lastname'])) {
        $errors['lastname'] = 'Last name is required';
    } elseif (strlen($_POST['lastname']) >= 255) {
        $errors['lastname'] = 'Last name should be less than 255 characters';
    }

    if (empty($_POST['email'])) {
        $errors['email'] = 'Email is required';
    } elseif (strlen($_POST['email']) >= 255) {
        $errors['email'] = 'Email should be less than 255 characters';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email is not a valid email address';
    }

    if (empty($_POST['password'])) {
        $errors['password'] = 'Password is required';
    } elseif (strlen($_POST['password']) >= 255) {
        $errors['password'] = 'Password should be less than 255 characters';
    } elseif (strlen($_POST['password']) < 8) {
        $errors['password'] = 'Password should be at least 8 characters';
    }

    if (empty($_POST['password2'])) {
        $errors['password2'] = 'Password verification is required';
    } elseif ($_POST['password'] !== $_POST['password2']) {
        $errors['password2'] = 'Password verification is not the same as password';
    }

    if (empty($errors)) {
        $db = new PDO('mysql:host=database;dbname=mydb','form', 'password');
    }
}
// echo '<pre>';
// print_r($errors);
// echo '</pre>';
?>

<div class="block p-6 rounded-lg shadow-lg bg-white max-w-md w-3/5">
  <form method="post" action="index.php?page=register">
      <div class="form-group mb-6">
        <input type="text" name="firstname" class="form-control
          block
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
          focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInput123"
          aria-describedby="emailHelp123" placeholder="First name">

          <?=!empty($errors['firstname']) ? '<p>' . $errors['firstname'] . '</p>' : ''; ?>

      </div>
      <div class="form-group mb-6">
        <input type="text" name="lastname" class="form-control
          block
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
          focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInput124"
          aria-describedby="emailHelp124" placeholder="Last name">

          <?=!empty($errors['lastname']) ? '<p>' . $errors['lastname'] . '</p>' : ''; ?>

      </div>
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
    <div class="form-group mb-6">
      <input type="password" name="password2" class="form-control block
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
        placeholder="Repeat password">

        <?=!empty($errors['password2']) ? '<p>' . $errors['password2'] . '</p>' : ''; ?>

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
      ease-in-out">Sign up</button>
  </form>
</div>