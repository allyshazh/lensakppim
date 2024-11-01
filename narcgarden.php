<?php
include 'connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
} else {
   $user_id = '';
   header('location:home.php');
}

// Get landmark_id from URL
if(isset($_GET['landmark_id'])){
   $landmark_id = $_GET['landmark_id'];
} else {
   header('location:home.php');
}

// Like Landmark
if (isset($_POST['like_content'])) {
   if ($user_id != '') {
       $select_likes = $connect->prepare("SELECT * FROM `likes` WHERE userid = ? AND landmarkid = ?");
       $select_likes->execute([$user_id, $landmark_id]);
       
       if ($select_likes->rowCount() > 0) {
           $remove_likes = $connect->prepare("DELETE FROM `likes` WHERE userid = ? AND landmarkid = ?");
           $remove_likes->execute([$user_id, $landmark_id]);
           $message[] = 'Removed from Likes!';
       } else {
           $insert_likes = $connect->prepare("INSERT INTO `likes` (userid, landmarkid) VALUES (?, ?)");
           $insert_likes->execute([$user_id, $landmark_id]);
           $message[] = 'Added to Likes!';
       }
   } else {
       $message[] = 'Please Sign In First!';
   }
}

// Add Comment
if(isset($_POST['add_comment'])){
   $comment_box = $_POST['comment_box'];
   $comment_box = filter_var($comment_box, FILTER_SANITIZE_STRING);
   $stmt = $connect->prepare("INSERT INTO narcgarden (userid, comment, date) VALUES (?, ?, NOW())");
   $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
   $stmt->bindParam(2, $comment_box, PDO::PARAM_STR);
   $stmt->execute();
   $stmt->closeCursor();
}

//Edit Comment
if(isset($_POST['update_now'])){
   $update_id = $_POST['update_id'];
   $update_id = filter_var($update_id, FILTER_SANITIZE_STRING);
   $update_box = $_POST['update_box'];
   $update_box = filter_var($update_box, FILTER_SANITIZE_STRING);

   $verify_comment = $connect->prepare("SELECT * FROM `narcgarden` WHERE commentid = ? AND comment = ?");
   $verify_comment->execute([$update_id, $update_box]);

   if($verify_comment->rowCount() > 0){
      $message[] = 'Comment Already Added!';
   }else{
      $update_comment = $connect->prepare("UPDATE `narcgarden` SET comment = ? WHERE commentid = ?");
      $update_comment->execute([$update_box, $update_id]);
      $message[] = 'Comment Edited Successfully!';
   }
}

// Delete Comment
if(isset($_POST['delete_comment'])){
    $delete_id = $_POST['comment_id'];
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
    $stmt = $connect->prepare("DELETE FROM narcgarden WHERE commentid = ? AND userid = ?");
    $stmt->bindParam(1, $delete_id, PDO::PARAM_INT);
    $stmt->bindParam(2, $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->closeCursor();
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
   <title>NARC Garden</title>
   <link rel="icon" href="images/lensakppim-logo.png" type="image/png">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header.php'; ?>

<?php
// Edit Comment
if(isset($_POST['edit_comment'])){
   $edit_id = $_POST['comment_id'];
   $edit_id = filter_var($edit_id, FILTER_SANITIZE_STRING);
   $verify_comment = $connect->prepare("SELECT * FROM `narcgarden` WHERE commentid = ? LIMIT 1");
   $verify_comment->execute([$edit_id]);
   if($verify_comment->rowCount() > 0){
      $fetch_edit_comment = $verify_comment->fetch(PDO::FETCH_ASSOC);
?>

<section class="edit-comment">
   <h1 class="heading">Edit Comment</h1>
   <form action="" method="post">
      <input type="hidden" name="update_id" value="<?= $fetch_edit_comment['commentid']; ?>">
      <textarea name="update_box" class="box" maxlength="1000" required placeholder="please enter your comment" cols="30" rows="10"><?= $fetch_edit_comment['comment']; ?></textarea>
      <div class="flex">
         <a href="narcgarden.php?landmark_id=<?= $landmark_id ?>" class="inline-option-btn">Cancel Edit</a> <!-- Update link with landmark_id -->
         <input type="submit" value="Update Now" name="update_now" class="inline-btn">
      </div>
   </form>
</section>

<?php
   }else{
      $message[] = 'Comment Did Not Exist !';
   }
}
?>

<section class="landmark-details">
   <h1 class="heading">NARC Garden</h1>

   <div class="row">
      <div class="column">
         <form action="" method="post" class="like-landmark">
            
         <!--Landmark Like-->
            <input type="hidden" name="landmark_id" value="<?= $landmark_id; ?>">
            <?php
               // Fetch like count for the landmark
               $select_likes = $connect->prepare("SELECT * FROM `likes` WHERE userid = ? AND landmarkid = ?");
               $select_likes->execute([$user_id, $landmark_id]);
            
               if($select_likes-> rowCount() > 0){
            ?>
               <button type="submit" name="like_content"><i class="fas fa-heart"></i><span>Liked</span></button>
            <?php
               } else {
            ?>
               <button type="submit" name="like_content"><i class="far fa-heart"></i><span>Like</span></button>
            <?php
               }
            ?>

        </form>
   
         <div class="thumb">
            <img src="images/narc-garden-2.jpg" alt="">

         </div>
      </div>

      <div class="column">
         <div class="details">
            <h3>KPPIM Indoor Community Garden</h3>
            <p>The hidden garden acts as a communal spaces to encourage interaction among faculty members.
               Indoors green spaces has been shown to reduce stress, improve mood, and enhance mental well-being among a community. 
               An inviting and comfortable atmosphere in the Al-Khawarizmi building improves the campus experience for visitors and campus community.</p>
         </div>
      </div>
   </div>
</section>

<section class="comments">
    <h1 class="heading">Comments</h1>
    <form action="" class="add-comment" method="post">
       <h3>Add Comment</h3>
       <textarea name="comment_box" placeholder="Enter your Comment Here...." required maxlength="1000" cols="30" rows="10"></textarea>
       <input type="submit" value="Send Comment" class="inline-btn" name="add_comment">
    </form>
 
    <div class="box-container">
       <?php
       // Fetch comments for the specific user
       $select_comments = $connect->prepare("SELECT narcgarden.*, students.studentname, students.studentimage 
                                             FROM `narcgarden` 
                                             JOIN `students` 
                                             ON narcgarden.userid = students.userid 
                                             ORDER BY narcgarden.date DESC"); // Assuming you want to order comments by date
      $select_comments->execute(); // Execute the prepared statement

       while ($fetch_comment = $select_comments->fetch(PDO::FETCH_ASSOC)) {
       ?>
       <div class="box" style="<?php if($fetch_comment['commentid'] == $user_id){echo 'order:-1;';} ?>">
       <div class="student">
             <img src="uploaded_files/<?= $fetch_comment['studentimage']; ?>" alt="">
             <div>
                <h3><?= $fetch_comment['studentname']; ?></h3>
                <span><?= $fetch_comment['date']; ?></span>
             </div>
          </div>
          <div class="comment-box"><?= $fetch_comment['comment']; ?></div>
          <?php if($fetch_comment['userid'] == $user_id): ?>
          <form action="" class="flex-btn" method="post">
             <input type="hidden" name="comment_id" value="<?= $fetch_comment['commentid']; ?>">
             <button type="submit" name="edit_comment" class="inline-option-btn">Edit Comment</button>
             <button type="submit" name="delete_comment" class="inline-delete-btn" onclick="return confirm('Are you sure you want to delete this comment?');">Delete Comment</button>
          </form>
          <?php endif; ?>
       </div>
       <?php } ?>
    </div>
 </section>

 <?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>