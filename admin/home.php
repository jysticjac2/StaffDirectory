<?php

session_start();

if (!isset($_SESSION['user']))
{
	header("Location: ../login.php");
	exit;
}  
?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Staff Directory - Admin</title>
<link rel = "stylesheet" type = "text/css" href = "../assets/style.css" />

<?php //include_once '../header.html';?>

</head>

<body>

<?php //include_once '../body_top.html';?>

<div class="header">
  <h2>Staff Directory - Admin Panel</h2>
  <?php if (isset($_SESSION['user'])) echo '<h5>User: '.$_SESSION['user'].'</h5>';?>
</div>

<div class="row">

  <div class="side">
  	  <h4>
	  <?php include_once('navmenu.php'); generateMenu(); ?>
	  </h2>
  </div>
  
  <div class="main">
  
    <h2>Welcome <?php if (isset($_SESSION['user'])) echo $_SESSION['user']."!"; ?></h2>

  </div>
</div>

<?php include_once '../footer.html'; ?>

</body>
</html>
