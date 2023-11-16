<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <link rel="stylesheet" href="../css/style.css">

</head>
<body>
   
<div class="container">

   <div class="content">
      <h3>Hi, <span><?php echo $_SESSION['admin_name'] ?></span></h3>
      <h1>Welcome to<span> Online Book Store</span></h1>
      <p>this is an ADMIN page</p>
      <a href="index.php" class="btn">Continue</a>
   </div>

</div>

</body>
</html>