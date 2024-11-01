<?php
include 'connect.php';

if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
 }else{
    $user_id = '';
 }

if(isset($_POST['submit'])) {

    $studentnum = $_POST['studentnum'];
    $studentnum = filter_var($studentnum, FILTER_SANITIZE_STRING);

    $studentname = $_POST['name'];
    $studentname = filter_var($studentname, FILTER_SANITIZE_STRING);

    $studentemail = $_POST['email'];
    $studentemail = filter_var($studentemail, FILTER_SANITIZE_STRING);

    $studentpass = sha1($_POST['pass']); 
    $studentpass = filter_var($studentpass, FILTER_SANITIZE_STRING);

    $cpass = sha1($_POST['cpass']); 
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    
    //Generate file name based on student's name
    $filename = strtolower(str_replace(' ', '_', $studentname)) . '_' . time() . '.' . $ext; 
   
    //File path
    $image_folder = 'uploaded_files/'.$filename;

    //Check if all required fields are set
    $select_user = $connect->prepare("SELECT * FROM `students` WHERE studentnum = ?");
    $select_user->execute([$studentnum]);
       
        if($select_user->rowCount() > 0) 
        {

            //Verify Student Number
            $message[] = "Student number is already registered !";
        } 
        
        else 
        {
            //Verify if password and confirm password match
            if($studentpass != $cpass) 
            {
                $message[] = "Confirmed password did not match !";
            } 
            
            else 
            {
                //Insert new student record
                $insert_user = $connect->prepare("INSERT INTO `students`(userid, studentnum, studentname, studentemail, studentpass, studentimage) VALUES(?,?,?,?,?,?)");
                $insert_user->execute([$userid, $studentnum, $studentname, $studentemail, $cpass, $filename]);
                move_uploaded_file($_FILES['image']['tmp_name'], $image_folder);
                
                $verify_user = $connect->prepare("SELECT * FROM `students` WHERE studentnum = ? AND studentpass = ? LIMIT 1");
                $verify_user->execute([$studentnum, $studentpass]);
                $row = $verify_user->fetch(PDO::FETCH_ASSOC);
                
                if($verify_user->rowCount() > 0){
                    setcookie('user_id', $row['userid'], time() + 60*60*24*30, '/');
                    header('location:home.php');
                }

            }
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
   <title>Student Create Account</title>
   <link rel="icon" href="images/lensakppim-logo.png" type="image/png">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- Custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header.php'; ?>

<section class="form-container">

<!--Registration Form-->
   <form class="register" action="" method="post" enctype="multipart/form-data">
      <h3>Create your Account !</h3>
      <div class="flex">
        <div class="col">
            
            <!--Make Student Number max 10 digits only-->
            <p>Student Number <span>*</span></p>
            <input type="text" name="studentnum" placeholder="Enter your 10-digit Student Number" required pattern="\d{10}" maxlength="10" class="box">
            
            <p>Student Name<span>*</span></p>
            <input type="text" name="name" placeholder="Enter your Name" required maxlength="50" class="box">
                
            <p>Email<span>*</span></p>
            <input type="email" name="email" placeholder="Enter your Email" required maxlength="50" class="box">
        </div>

        <div class="col">
            <p>Password<span>*</span></p>
            <input type="password" name="pass" placeholder="Enter your Password" required maxlength="30" class="box">
                
            <p>Confirm Password <span>*</span></p>
            <input type="password" name="cpass" placeholder="Confirm your Password" required maxlength="30" class="box">
        
            <p>Select Profile Picture <span>*</span></p>
            <input type="file" name="image" accept="image/*" required class="box">
            </div>
        </div>

      <input type="submit" value="Create Account" name="submit" class="btn">
   </form>

</section>

<?php include 'footer.php'; ?>

<!-- Custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>