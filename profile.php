<?php

include 'connect.php';

$message = []; //Initialize the message array

//Check if user is signed in based on cookie
if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

//Fetch the student's name from the database
if(!empty($user_id)) {
   $select_student = $connect->prepare("SELECT studentname FROM students WHERE userid = ?");
   $select_student->execute([$user_id]);
   $student = $select_student->fetch(PDO::FETCH_ASSOC);
   $studentname = $student['studentname'];
} else {
   $studentname = '';
}

//Count the total number of liked landmarks by the user
$select_liked_landmarks = $connect->prepare("SELECT COUNT(*) as total_likes FROM likes WHERE userid = ?");
$select_liked_landmarks->execute([$user_id]);
$liked_landmarks_result = $select_liked_landmarks->fetch(PDO::FETCH_ASSOC);
$total_likes = $liked_landmarks_result['total_likes'];

//Count the total number of comments made by the user on different landmarks
$total_comments = 0;

//Fetch comments count from each landmark table and sum them up
$landmark_tables = array('lamannajib', 'narcgarden', 'studentlounge', 'alkhawarizmi', 'heandshe');
foreach ($landmark_tables as $table) {
    $select_comments = $connect->prepare("SELECT COUNT(*) as total_comments FROM $table WHERE userid = ?");
    $select_comments->execute([$user_id]);
    $comments_result = $select_comments->fetch(PDO::FETCH_ASSOC);
    $total_comments += $comments_result['total_comments'];
}

?>

<!DOCTYPE html>
<html lang="en">

<!-- Header -->
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Student Profile</title>
   <link rel="icon" href="images/lensakppim-logo.png" type="image/png">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- Custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header.php'; ?>

<section class="user-profile">

   <h1 class="heading"><?php echo $studentname; ?>'s Profile</h1>


   <div class="info">
      <div class="user">
      <?php
            //Check if user is authenticated
            if($user_id) {
               $select_profile = $connect->prepare("SELECT * FROM `students` WHERE userid = ?");
               $select_profile->execute([$user_id]);
               if($select_profile->rowCount() > 0)
               {
                  $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                  ?>

         <img src="uploaded_files/<?= $fetch_profile['studentimage']; ?>" alt="">
         <h3><?= $fetch_profile['studentname']; ?></h3>
         <p>Student</p>
         <a href="update.php" class="inline-btn">Update Profile</a>
      <?php         
      }
            }
      ?>
      </div>

      <!-- Display total liked landmarks and total comments -->
      <div class="box-container">
   
         <div class="box">
            <div class="flex">
               <i class="fas fa-heart"></i>
               <div>
                  <span><?= $total_likes; ?></span>
                  <p>Liked Landmarks </p>
               </div>
            </div>
         </div>
   
         <div class="box">
            <div class="flex">
               <i class="fas fa-comment"></i>
               <div>
                  <span><?= $total_comments; ?></span>
                  <p>Landmarks Comments</p>
               </div>
            </div>
         </div>
   
      </div>
   </div>

</section>

<?php include 'footer.php'; ?>

<!-- Custom js file link  -->
<script src="js/script.js"></script>

   
</body>
</html>