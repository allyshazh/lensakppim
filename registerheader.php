<?php

include 'connect.php';

// Start the session
session_start();

$message = []; // Initialize the message array

// Check if user is signed in based on cookie
if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

// Redirect users to sign-in page if not signed in and trying to access restricted pages
if (!$user_id && !in_array(basename($_SERVER['PHP_SELF']), array('signin.php', 'register.php'))) {
    header('Location: signin.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<header class="header">
   
   <section class="flex">

    <!-- Add img Logo -->
      <a href="home.php" class="logo">LensaKPPIM</a>

      <div class="icons">
         <div id="toggle-btn" class="fas fa-sun"></div>
      </div>

   </section>

</header>   

</html>