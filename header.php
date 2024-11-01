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

<header class="header">
   <section class="flex">
      <a href="home.php" class="logo">
         <img src="images/lensakppim-logo.png" alt="LensaKPPIM">
      </a>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="search-btn" class="fas fa-search"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="toggle-btn" class="fas fa-sun"></div>
      </div>

      <div class="profile">
         <?php
            // Check if user is authenticated
            if($user_id) {
               $select_profile = $connect->prepare("SELECT * FROM `students` WHERE userid = ?");
               $select_profile->execute([$user_id]);
               if($select_profile->rowCount() > 0)
               {
                  $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                  ?>

                  <img src="uploaded_files/<?= $fetch_profile['studentimage']; ?>" alt="">
                  <h3><?= $fetch_profile['studentname']; ?></h3>
                  <span>Student</span>
                  <a href="profile.php" class="btn">View Profile</a>
                  <a href="signout.php" onclick="return confirm('Sign Out from This Website ?');" class="delete-btn">Sign Out</a>
                  <?php
               }
            } else {
               // If not authenticated, display sign-in and register options
               ?>
               <h3>Please Sign in or Register to your account</h3>
               <div class="flex-btn">
                  <a href="signin.php" class="option-btn">Sign In</a>
                  <a href="register.php" class="option-btn">Register</a>
               </div>
               <?php
            }
         ?> 
      </div>

   </section>

</header>   

<!--Side Bar-->
<div class="side-bar">

   <div class="close-side-bar">
      <i class="fas fa-times"></i>
   </div>

   <div class="profile">
   <?php
      // Check if user is authenticated
      if($user_id) {
         $select_profile = $connect->prepare("SELECT * FROM `students` WHERE userid = ?");
         $select_profile->execute([$user_id]);
         if($select_profile->rowCount() > 0)
         {
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>

            <img src="uploaded_files/<?= $fetch_profile['studentimage']; ?>" alt="">
            <h3><?= $fetch_profile['studentname']; ?></h3>
            <span>Student</span>
            <a href="profile.php" class="btn">View Profile</a>
            <?php
         }
      } else {
         // If not authenticated, display sign-in and register options
         ?>
         <h3>Please Sign in or Register to your account</h3>
         <div class="flex-btn" style="padding-top: .5rem;">
            <a href="signin.php" class="option-btn">Sign In</a>
            <a href="register.php" class="option-btn">Register</a>
         </div>
         <?php
      }
   ?> 
   </div>

   <nav class="navbar">
    <a href="home.php"><i class="fas fa-home"></i><span>Home</span></a>
    <a href="virtualtour.php"><i class="fas fa-route"></i><span>Virtual Tour</span></a>
    <a href="landmarks.php"><i class="fas fa-school"></i><span>Landmarks</span></a>
    <a href="analysis.php"><i class="fas fa-route"></i><span>Review</span></a>
    <a href="contact.php"><i class="fas fa-headset"></i><span>Contact Us</span></a>
 </nav>

</div> 
