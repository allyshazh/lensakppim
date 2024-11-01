<?php
include 'connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

//Getting total likes for each landmark
$get_likes = $connect->prepare("SELECT landmarkid, COUNT(*) as total_likes FROM `likes` GROUP BY landmarkid");
$get_likes->execute();
$likes_data = $get_likes->fetchAll(PDO::FETCH_ASSOC);
$likes_by_landmark = array_column($likes_data, 'total_likes', 'landmarkid');

//Count comments
function countComments($connect, $tableName) {
    $stmt = $connect->prepare("SELECT COUNT(*) as total_comments FROM `$tableName`");
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['total_comments'];
}

$comments_lamannajib = countComments($connect, "lamannajib");
$comments_narcgarden = countComments($connect, "narcgarden");
$comments_studentlounge = countComments($connect, "studentlounge");
$comments_alkhawarizmi = countComments($connect, "alkhawarizmi");
$comments_heandshe = countComments($connect, "heandshe");

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Review</title>
   <link rel="icon" href="images/lensakppim-logo.png" type="image/png">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- Custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

   <?php include 'header.php'; ?>

<!-- Landmark Analysis -->
<section class="analysis">

   <h1 class="heading">Landmarks Review</h1>

   <div class="box-container">

      <div class="box">
         <div class="landmarks">
            <img src="images/laman-najib-3.jpg" alt="">
            <div>
               <h3>Laman Najib</h3>
            </div>
         </div>
         <p>Total Likes : <span><?= $likes_by_landmark['1'] ?? 0; ?></span></p>
         <p>Total Comments : <span><?= $comments_lamannajib ?></span></p>
         <a href="lamannajib.php?landmark_id=1" class="inline-btn">View Landmark</a>
      </div>

      <div class="box">
         <div class="landmarks">
            <img src="images/narc-garden-3.jpg" alt="">
            <div>
               <h3>NARC Garden</h3>
            </div>
         </div>
         <p>Total Likes : <span><?= $likes_by_landmark['2'] ?? 0; ?></span></p>
         <p>Total Comments : <span><?= $comments_narcgarden ?></span></p>
         <a href="narcgarden.php?landmark_id=2" class="inline-btn">View Landmark</a>
      </div>

      <div class="box">
         <div class="landmarks">
            <img src="images/student-lounge-3.jpg" alt="">
            <div>
               <h3>Student Lounge</h3>
            </div>
         </div>
         <p>Total Likes : <span><?= $likes_by_landmark['3'] ?? 0; ?></span></p>
         <p>Total Comments : <span><?= $comments_studentlounge ?></span></p>
         <a href="studentlounge.php?landmark_id=3" class="inline-btn">View Landmark</a>
      </div>

      <div class="box">
         <div class="landmarks">
            <img src="images/al-khawarizmi-3.jpg" alt="">
            <div>
               <h3>Al-Khawarizmi Building</h3>
            </div>
         </div>
         <p>Total Likes : <span><?= $likes_by_landmark['4'] ?? 0; ?></span></p>
         <p>Total Comments : <span><?= $comments_alkhawarizmi ?></span></p>
         <a href="alkhawarizmi.php?landmark_id=4" class="inline-btn">View Landmark</a>
      </div>

      <div class="box">
         <div class="landmarks">
            <img src="images/he-and-she-3.jpg" alt="">
            <div>
               <h3>He&She Cafe</h3>
            </div>
         </div>
         <p>Total Likes : <span><?= $likes_by_landmark['5'] ?? 0; ?></span></p>
         <p>Total Comments : <span><?= $comments_heandshe ?></span></p>
         <a href="heandshe.php?landmark_id=5" class="inline-btn">View Landmark</a>
      </div>
   </div>

</section>

<!-- Journey Timeline Section -->
<section class="timeline">

    <h1 class="heading">Journey Timeline</h1>
 
    <div class="details">
    <section class="cd-horizontal-timeline">
	<div class="timeline">
		<div class="events-wrapper">
			<div class="events">
					<a href="#0" data-date="28/02/2014" class="selected">Kolej Melati</a>
					<a href="#0" data-date="20/04/2014">Student Parking</a>
					<a href="#0" data-date="20/05/2014">Lecturer Parking</a>
					<a href="#0" data-date="09/07/2014">Al-Khawarizmi</a>
					<a href="#0" data-date="30/08/2014">He&She</a>
					<a href="#0" data-date="15/09/2014">End</a>

				<span class="filling-line" aria-hidden="true"></span>
			</div> 
		</div> 
			
		<ul class="cd-timeline-navigation">
			<a href="#0" class="prev inactive">Prev</a>
			<a href="#0" class="next">Next</a>
		</ul> 
	</div> 

	<div class="events-content">
			<li class="selected" data-date="28/02/2014">
				<h4>Kolej Melati</h4>
				<em>Residential College</em>
				<p>	
					Your walking journey to KPPIM specifically the He&She Cafe starts here. Let's go !
				</p>
			</li>

			<li data-date="20/04/2014">
				<h4>Student Parking</h4>
				<em>Time taken: 5 minutes</em>
				<p>	
               Sharing Students' Parking Space				
            </p>
			</li>

			<li data-date="20/05/2014">
				<h4>Lecturer Parking</h4>
				<em>Time Taken: 5 minutes</em>
				<p>	
               CS2 Lecturer's Parking Space				
            </p>
			</li>

			<li data-date="09/07/2014">
				<h4>Al-Khawarizmi Building</h4>
				<em>Time taken: 5 minutes</em>
				<p>	
               Located at CS2				
            </p>
			</li>

			<li data-date="30/08/2014">
				<h4>He&She Cafe</h4>
				<em>Time taken: 5 minutes</em>
				<p>	
               Located at CS2				
            </p>
			</li>

			<li data-date="15/09/2014">
				<h4>End</h4>
				<em>Estimated Walking Journey Time: 20 minutes</em>
				<p>	
					It is advisable for students to allocate 20 minutes if you are staying at the
               Melati Residential College to attend class.
				</p>
			</li>
	</div>
</section>
    </div>
</section>

<?php include 'footer.php'; ?>

<!-- Custom js file link  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/script.js"></script>

   
</body>
</html>