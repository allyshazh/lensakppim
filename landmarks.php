<?php

include 'connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Landmarks</title>
   <link rel="icon" href="images/lensakppim-logo.png" type="image/png">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- Custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

   <?php include 'header.php'; ?>

<section class="landmarks">

   <h1 class="heading">College of Computing, Informatics & Mathematics (KPPIM) Landmarks</h1>

   <div class="box-container">

      <div class="box">
         <div class="place">
            <div class="info">
               <h3>Laman Najib</h3>
            </div>
         </div>
         <div class="thumb">
            <img src="images/laman-najib-1.jpg" alt="">
         </div>
         <h3 class="title">Located at CS1</h3>
         <!-- Pass landmark ID as a parameter in the URL -->
         <a href="lamannajib.php?landmark_id=1" class="inline-btn">View Landmark</a>
      </div>

      <div class="box">
        <div class="place">
           <div class="info">
              <h3>NARC Garden</h3>
           </div>
        </div>
        <div class="thumb">
           <img src="images/narc-garden-1.jpg" alt="">
        </div>
        <h3 class="title">Located at CS2</h3>
         <!-- Pass landmark ID as a parameter in the URL -->
        <a href="narcgarden.php?landmark_id=2" class="inline-btn">View Landmark</a>
     </div>

     <div class="box">
        <div class="place">
           <div class="info">
              <h3>Student Lounge</h3>
           </div>
        </div>
        <div class="thumb">
           <img src="images/student-lounge-1.jpg" alt="">
        </div>
        <h3 class="title">Located at CS2</h3>
         <!-- Pass landmark ID as a parameter in the URL -->
        <a href="studentlounge.php?landmark_id=3" class="inline-btn">View Landmark</a>
     </div>

     <div class="box">
        <div class="place">
           <div class="info">
              <h3>Al-Khawarizmi Building</h3>
           </div>
        </div>
        <div class="thumb">
           <img src="images/al-khawarizmi-1.jpg" alt="">
        </div>
        <h3 class="title">Located at CS2</h3>
         <!-- Pass landmark ID as a parameter in the URL -->
        <a href="alkhawarizmi.php?landmark_id=4" class="inline-btn">View Landmark</a>
     </div>

     <div class="box">
        <div class="place">
           <div class="info">
              <h3>He&She Cafe</h3>
           </div>
        </div>
        <div class="thumb">
           <img src="images/he-and-she-1.jpg" alt="">
        </div>
        <h3 class="title">Located at CS2</h3>
         <!-- Pass landmark ID as a parameter in the URL -->
        <a href="heandshe.php?landmark_id=5" class="inline-btn">View Landmark</a>
     </div>

   </div>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

   
</body>
</html>
