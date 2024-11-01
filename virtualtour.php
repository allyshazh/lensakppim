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
   <title>Virtual Tour</title>
   <link rel="icon" href="images/lensakppim-logo.png" type="image/png">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header.php'; ?>

<section class="vt">

   <h1 class="heading">Virtual Tour</h1>

   <div class="box-container">
        <h3 class="title">Located at CS2</h3><br>

        <!-- Virtual Tour Link from CloudPano -->
        <div id="caIPeXGxX"><script type="text/javascript" async data-short="caIPeXGxX" data-path="tours" data-is-self-hosted="undefined" width="100%" height="500px" src="https://app.cloudpano.com/public/shareScript.js"></script></div>      
      </div>

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>