<?php
include 'connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
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
?>

<!DOCTYPE html>
<html lang="en">

<!-- Header -->
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>
   <link rel="icon" href="images/lensakppim-logo.png" type="image/png">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- Custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

   <?php include 'header.php'; ?>

   <div class="welcome-container">
    <div class="overlay"></div>
    <div class="content">
        <!-- Display student's name -->
        <h1>Welcome, <?php echo $studentname; ?> !</h1>
    </div>
</div>

<!-- Home Page Starts -->
<section class="home-grid">

   <h1 class="heading">Quick Links</h1>

   <div class="box-container">
      <div class="quicklink">
         <div class="containers">
                 <div class="container" style="background-image: url(images/home-virtual-tour-bg.jpeg)">
                  <div class="details">
                         <div>
                             <div class="name">Virtual Tour</div>
                             <a class="button" href="virtualtour.php">Immerse Yourself</a>
                         </div>
                     </div>
                 </div>
         </div>
     </div>

     <div class="quicklink">
      <div class="containers">
              <div class="container" style="background-image: url(images/home-landmark-bg.jpg)">
               <div class="details">
                      <div>
                          <div class="name">Landmarks</div>
                          <a class="button" href="landmarks.php">View Landmarks</a>
                      </div>
                  </div>
              </div>
      </div>
  </div>

  <div class="quicklink">
   <div class="containers">
           <div class="container" style="background-image: url(images/home-anaylsis-bg.jpg)">
            <div class="details">
                   <div>
                       <div class="name">Review</div>
                       <a class="button" href="analysis.php">Review Landmarks</a>
                   </div>
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
