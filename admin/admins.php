<?php

session_start();

if (!isset($_SESSION['user']))
{
	header("Location: ../login.php");
	exit;
}

include_once 'config/db_conn.php';
include_once 'data/user.php';

$db_conn = new DBconn();
$conn = $db_conn->db_connection();
  
$user_info = new User();

$error_msg ="";
$userid  = "";

if (isset($_GET['userid']))  $userid = $_GET['userid'];
if (isset($_POST['userid'])) $userid = $_POST['userid'];

$rs_edit = $user_info->get_user($conn, $userid);

if (!empty($rs_edit))
  $row_edit = $rs_edit->fetch_assoc();

if (isset($_GET['delete']))
{
	$rs_delete = $user_info->delete_user($conn, $_GET['delete']);	
	
	if ($rs_delete)
		header("location : admins.php");
	else
		$error_msg = "Error deleting user.";
}

if (isset($_POST['cmdupdate']))
{
	$rs_pw = $user_info->check_password($conn, $userid, $_POST['oldpassword']);	
	
	if ($rs_pw && $rs_pw->num_rows == 0 )
	{
		$error_msg = "Error: Incorrect Password. Please try again";
	}
	else
	{
		$rs_update = $user_info->update_user($conn, $userid, $_POST[newpword]);	

		if( isset($_GET['userid']) ) unset($_GET['userid']);
		header("location : admins.php");
	}
}

if (isset($_POST['Submit']))
{ 
	$error_msg = "";
	$username = $_POST["username"];
	$pword = $_POST["newpword"];

	$result = $user_info->check_login($conn, $username);

	$user_name = "";

	if ($result)
	{
		$row = $result->fetch_assoc();
		$user_name = $row['user_name']; 
	}

	if ($user_name != $username)
	{
		$result = $user_info->add_user($conn, $username, $pword);	
	}
	elseif ($user_name != "")
	{
  		$error_msg = "<b><i> User already exists. </b></i>";
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Staff Directory - Admin</title>
<link rel = "stylesheet" type = "text/css" href = "../assets/style.css" />

<script>

function promptDelete(delurl, prompt)
{
  var ans= confirm(prompt);
if (ans==true)
  document.location.href=delurl;
}

function validateInput()
{
	if (document.form1.username.value=="") 
	{
		alert("Please enter a value for Username");
		document.form1.username.focus();
		return false;
	}
	if (document.form1.newpword.value=="") 
	{
		alert("Please enter the password of the user");
		document.form1.newpword.focus();
		return false;
	}

	if (document.form1.userid.value != "" ) //we are in edit mode and we will validate for entering old password
	{
		if (document.form1.oldpassword.value == "") 
		{
			alert("Please enter your old password"); 
			document.form1.oldpassword.focus(); 
			return false;
		}
	}
}

</script>

</head>

<body>

<div class="header">
  <h2>Staff Directory Admin Panel</h2>
  <?php if (isset($_SESSION['user'])) echo '<h5>User: '.$_SESSION['user'].'</h5>';?>
</div>

<div class="row">


  <div class="side">
  	  <h4>
	  <?php include_once('navmenu.php'); generateMenu(); ?>
	  </h4>
  </div>
 
 
  <div class="main" style="">
  
    <h3>Manage Users</h3>
    
		<div style="width:400px">

			<form name="form1" method="post" action="admins.php" onSubmit="return validateInput()">

			<p class='elements'>
			<label for "username">Username</label>
        	<input type="text" name="username" value="<?php if (isset($row_edit['user_name']) ) print $row_edit['user_name']?>" />                    
        	</p>
        	
        	<p class='elements'>
        <?php
        if (isset($_GET['userid'])) //then we are in edit mode...
        { ?>
        	Enter Old Password
				<input type="password" name="oldpassword">
				<br/>
        <?php 
        }
        if (isset($_GET['userid'])) 
        	echo "Enter new password"; else echo "Password";
        ?>
        <input  type="password" name="newpword">
        </p>
        
        <p>
        
			<input TYPE="hidden" name="userid" value="<?php print $userid;?>">
    		
    		<?php
    		if (isset($_GET['userid'])) 
    		{?>
      	<input name="cmdupdate" type="submit" class="" value="Update">
         <input name="cmdCancel" type="button" class="button" onClick="document.location.href='admins.php'" value="Cancel">
        <?php 
        }	else {?>
        	<input name="Submit" type="submit" class="" value="Save">
        <?php } ?>              
        </p>
        
        <br/>
        <p class='elements'>
        <strong>Existing Users:</strong>
        <table width="70%" border="0" align="" cellpadding="0" cellspacing="0">
        	<?php
				$result = $user_info->all_users($conn);

				if ($result->num_rows > 0) 
				{
					while ($row = $result->fetch_assoc())
					{
            	?>
             	<tr> 
               <td width="" align="center"><?php print $row['user_name'];?></td>
               <td width="" align="center">&nbsp;</td>
               <td width=""><a href="?userid=<?php print $row['id'];?>">Edit</a> | 
               <a href="javascript: promptDelete('?delete=<?php print $row['id'];?>',
                  'Are you sure you want to delete this user?')">Delete</a>
               </td>
               </tr>
             <?php
              }
            }
            ?>
          </table>
          </p>
       </form>
		</div>

  </div>
</div>

<?php include_once '../footer.html'; ?>

</body>
</html>
