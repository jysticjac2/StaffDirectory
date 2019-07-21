<?php
session_start();

if (isset($_SESSION['user']))
{
	unset($_SESSION['user']);
}

//include_once $_SERVER['DOCUMENT_ROOT'].'/StaffDirectory/admin/config/db_conn.php';
include_once 'admin/config/db_conn.php';
include_once 'admin/data/user.php';

$db_conn = new DBconn();
$conn = $db_conn->db_connection();
  
$user_info = new User();

$error = "";
$username = "";
$pword = "";


if (isset($_POST['submit']))
//if (isset($_POST['user_name']))
{
//die('test');
	$user_name = $_POST["user_name"];
	$password = $_POST["password"];

//	$password = md5($_POST["password"]);
	
	$result = $user_info->check_login($conn, $user_name);

	if ($result)
	{
		$row = $result->fetch_row();
		$username = $row[0];
		$pword = $row[1];
	}	

	if ($user_name != $username)
	{
		$error = "<b><i> Invalid user...</b></i>";
	}

	elseIf ($password != $pword)
	{
		$error = "<b><i> Invalid password...</b></i>";
	} 
	else
	{
		$_SESSION['user'] = $row[1];

		header("location: admin/home.php");
	} 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Staff Directory - Login</title>

<?php include_once 'header.html';?>

</head>

<body>

<?php include_once'body_top.html';?>

<div class="row" style="width: 50%; margin: auto;">

  <div class="main">
  <!--<div class="main" style="width: 50%">-->
    
    <h2>Login</h2>
    <h5>Login to Administration Panel</h5>
    
     <p></p>

<form action="login.php" method="post">

  <div class="" style="width:400px; margin: auto;">
  	<p class='elements'>
    <label for="user_name"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="user_name" required>
    </p>
	<p class='elements'>
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
    </p>
	<p class='elements'>
    <input type="submit" name="submit" value="Submit">
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
    </p>

  </div>

  <div class="logincontainer" style="background-color:#f1f1f1">
    <span><?php if (isset($error) && $error != "") echo $error;?></span>    
  </div>
</form>

    <br>
 
  </div>
 
</div>

<?php include_once 'footer.html'; ?>

</body>
</html>