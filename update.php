<?php

include 'connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
    header('Location: signin.php');
    exit(); // Ensure script stops executing if redirected.
}

$message = []; // Define an array to hold messages.

if (isset($_POST['submit'])) {

    $select_user = $connect->prepare("SELECT * FROM `students` WHERE userid = ? LIMIT 1");
    $select_user->execute([$user_id]);
    $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

    $prev_pass = $fetch_user['studentpass']; 
    $prev_image = $fetch_user['studentimage'];

    //Student Number
    $studentnumber = $_POST['studentnumber'] ?? '';
    $studentnumber = filter_var($studentnumber, FILTER_SANITIZE_STRING);

    if (!empty($studentnumber)) {
        $select_number = $connect->prepare("SELECT studentnum FROM `students` WHERE studentnum = ?");
        $select_number->execute([$studentnumber]);
        if ($select_number->rowCount() > 0) {
            $message[] = 'Student Number Already Registered !';
        } else {
            $update_number = $connect->prepare("UPDATE `students` SET studentnum = ? WHERE userid = ?");
            $update_number->execute([$studentnumber, $user_id]);
            $message[] = 'Student Number Updated Successfully!';
        }
    }

    //Student Name
    $studentname = $_POST['name'] ?? '';
    $studentname = filter_var($studentname, FILTER_SANITIZE_STRING);

    if (!empty($studentname)) {
        $update_name = $connect->prepare("UPDATE `students` SET studentname = ? WHERE userid = ?");
        $update_name->execute([$studentname, $user_id]);
        $message[] = 'Student Name Updated Successfully !';
    }

    //Student Email
    $studentemail = $_POST['email'] ?? '';
    $studentemail = filter_var($studentemail, FILTER_SANITIZE_EMAIL);

    if (!empty($studentemail)) {
        $select_email = $connect->prepare("SELECT studentemail FROM `students` WHERE studentemail = ?");
        $select_email->execute([$studentemail]);
        if ($select_email->rowCount() == 0) { // If no other user has this email, update it.
            $update_email = $connect->prepare("UPDATE `students` SET studentemail = ? WHERE userid = ?");
            $update_email->execute([$studentemail, $user_id]);
            $message[] = 'Email Updated Successfully !';
        } else {
            $message[] = 'Email already exists!';
        }
    }

    //Student Password
    $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
    $old_pass = sha1($_POST['old_pass']);
    $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
    $new_pass = sha1($_POST['new_pass']);
    $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    // Check if old password matches the one in the database
   if($old_pass != $empty_pass){
      if($old_pass != $prev_pass){
         $message[] = 'Old Password Did Not Matched!';
      }elseif($new_pass != $cpass){
         $message[] = 'Confirm Password Did Not Matched!';
      }else{
         if($new_pass != $empty_pass){
            $update_pass = $connect->prepare("UPDATE `students` SET studentpass = ? WHERE userid = ?");
            $update_pass->execute([$cpass, $user_id]);
            $message[] = 'Password Updated Successfully!';
         }else{
            $message[] = 'Please Enter A New Password!';
         }
      }
   }

    //Student Image
    $image = $_FILES['image']['name'] ?? '';
    $image_size = $_FILES['image']['size'] ?? 0;
    $image_tmp_name = $_FILES['image']['tmp_name'] ?? '';
   
   if (!empty($image)) {
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $rename = strtolower(str_replace(' ', '_', $studentname)) . '_' . time() . '.' . $ext;
        $image_folder = 'uploaded_files/' . $rename;
        
        if ($image_size > 2000000) {
            $message[] = 'Image Size Too Large!';
        } else {
            $update_image = $connect->prepare("UPDATE `students` SET studentimage = ? WHERE userid = ?");
            $update_image->execute([$rename, $user_id]);
            move_uploaded_file($image_tmp_name, $image_folder);
            
            if ($prev_image != '' && file_exists('uploaded_files/' . $prev_image)) {
                unlink('uploaded_files/' . $prev_image);
            }
            $message[] = 'Image Updated Successfully!';
        }
    }
}

if (isset($message)) {
    foreach ($message as $msg) {
        echo '
      <div class="message">
         <span>'.$msg.'</span>
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
   <title>Update Student Profile</title>
   <link rel="icon" href="images/lensakppim-logo.png" type="image/png">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- Custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header.php'; ?>


<section class="form-container" style="min-height: calc(100vh - 19rem);">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>Update Profile</h3>
      <div class="flex">
         <div class="col">
            <p>Update Student Number <span>*</span></p>
            <input type="text" name="studentnumber" placeholder="Update your 10-digit Student Number" required pattern="\d{10}" maxlength="10" class="box">

            <p>Update Student Name</p>
            <input type="text" name="name" placeholder="Student Name" maxlength="50" class="box">
            
            <p>Update Email</p>
            <input type="email" name="email" placeholder="student@gmail.com" maxlength="50" class="box">
        </div>

        <div class="col">
            <p>Previous Password</p>
            <input type="password" name="old_pass" placeholder="Enter your Old Password" maxlength="20" class="box">
            
            <p>New Password</p>
            <input type="password" name="new_pass" placeholder="Enter your New Password" maxlength="20" class="box">
            
            <p>Confirm New Password</p>
            <input type="password" name="cpass" placeholder="Confirm your New Password" maxlength="20" class="box">
        </div>
    </div>
    
            <p>Update Profile Picture</p>
            <input type="file" name="image" accept="image/*" class="box">
            
            <input type="submit" value="Update Profile" name="submit" class="btn">
   </form>

</section>

<?php include 'footer.php'; ?>

<!-- Custom js file link  -->
<script src="js/script.js"></script>

   
</body>
</html>