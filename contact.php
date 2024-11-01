<?php

include 'connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['submit'])){

   $name = $_POST['name']; 
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email']; 
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number']; 
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $msg = $_POST['message']; 
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   $select_contact = $connect->prepare("SELECT * FROM `contact` WHERE userid = ? AND name = ? AND email = ? AND number = ? AND message = ?");
   $select_contact->execute([$user_id, $name, $email, $number, $msg]);

   if($select_contact->rowCount() > 0){
      $message[] = 'Message already sent !';
   }else{
      $insert_message = $connect->prepare("INSERT INTO `contact`(userid, name, email, number, message) VALUES(?,?,?,?,?)");
      $insert_message->execute([$user_id, $name, $email, $number, $msg]);
      $message[] = 'Message have been successfully sent !';
   }

}

if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact Us</title>
   <link rel="icon" href="images/lensakppim-logo.png" type="image/png">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- Custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header.php'; ?>

<section class="contact">

   <div class="row">

      <div class="image">
         <img src="images/contact.svg" alt="">
      </div>

      <form action="" method="post">
         <h3>Get in Touch</h3>
         <input type="text" placeholder="Enter your Name" name="name" required maxlength="59" class="box">
         <input type="email" placeholder="Enter your Email" name="email" required maxlength="50" class="box">
         <input type="text" placeholder="Enter your Phone Number" name="number" required maxlength="11" class="box">
         <textarea name="message" class="box" placeholder="Enter your Message" required maxlength="1000" cols="30" rows="10"></textarea>
         <input type="submit" value="Send Message" class="inline-btn" name="submit" href="home.php">
      </form>

   </div>

   <div class="box-container">

      <div class="box">
         <i class="fas fa-phone"></i>
         <h3>Phone Number</h3>
         <a href="tel:133334500">013-3335600</a>
      </div>
      
      <div class="box">
         <i class="fas fa-envelope"></i>
         <h3>Email Address</h3>
         <a href="mailto:2022800668@student.uitm.edu.my">2022800668@student.uitm.edu.my</a>
      </div>

      <div class="box">
         <i class="fas fa-map-marker-alt"></i>
         <h3>Location</h3>
         <a href="#">KPPIM UiTM Shah Alam, Selangor</a>
      </div>

   </div>

</section>

<?php include 'footer.php'; ?>  

<!-- Custom js file link  -->
<script src="js/script.js"></script>

   
</body>
</html>