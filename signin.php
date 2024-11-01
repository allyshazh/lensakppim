<?php

include 'connect.php';

if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
 }else{
    $user_id = '';
 }

if(isset($_POST['submit'])){

    $studentnum = $_POST['studentnum'];
    $studentnum = filter_var($studentnum, FILTER_SANITIZE_STRING);
    $studentpass = sha1($_POST['pass']);
    $studentpass = filter_var($studentpass, FILTER_SANITIZE_STRING);

   $select_user = $connect->prepare("SELECT * FROM `students` WHERE studentnum = ? AND studentpass = ? LIMIT 1");
   $select_user->execute([$studentnum, $studentpass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);
   
   if($select_user->rowCount() > 0){
    setcookie('user_id', $row['userid'], time() + 60*60*24*30, '/');
     header('location:home.php');
   }else{
      $message[] = 'Incorrect Student Number or Password!';
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

<!-- Header -->
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Student Sign In</title>
   <link rel="icon" href="images/lensakppim-logo.png" type="image/png">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- Custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

   <?php include 'header.php'; ?>

<!-- Sign in form -->
<section class="form-container">

   <form action="" method="post" enctype="multipart/form-data" class="signin">
      <h3>Sign In Now</h3>
      <p>Student Number <span>*</span></p>
      <input type="text" name="studentnum" placeholder="Enter your 10-digit Student Number" required maxlength="10" class="box">
      
      <p>Password <span>*</span></p>
      <input type="password" name="pass" placeholder="Enter your Password" required maxlength="30" class="box">
      
      <p class="link">Don't Have An Account? <a href="register.php">Register Now</a></p>

      <input type="submit" value="Sign In" name="submit" class="btn">
   </form>

</section>

<?php include 'footer.php'; ?>

<!-- Custom js file link  -->
<script src="js/script.js"></script>

   
</body>
</html>