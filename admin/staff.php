<?php

session_start();

if (!isset($_SESSION['user']))
{
	header("Location: ../login.php");
	exit;
}

include_once 'config/db_conn.php';
include_once 'data/employee.php';
include_once 'data/department.php';

$db_conn = new DBconn();
$conn = $db_conn->db_connection();
  
$emp = new Employee();
$dept = new Department();

$error_msg =" ";
$empid  = "";

if (isset($_GET['empid']))  $empid = $_GET['empid'];
if (isset($_POST['empid'])) $empid = $_POST['empid'];

$rs_edit = $emp->get_employee($conn, $empid);

if (!empty($rs_edit))
  $row_edit = $rs_edit->fetch_assoc();

if (isset($_GET['delete']))
{
	$rs_delete = $emp->delete_employee($conn, $_GET['delete']);	
	
	if ($rs_delete)
		header("location : staff.php");
	else
		$error_msg = "Error deleting employee ".$_GET['delete'];
}

if (isset($_POST['cmdupdate']))
{
		$rs_update = $emp->update_employee($conn, $empid, $_POST);	

		if (isset($_GET['empid'])) unset($_GET['empid']);
			header("location : staff.php");
}

if (isset($_POST['Submit']))
{ 
	$error_msg = "";
	$first_name = $_POST["first_name"];

//print_r($_POST);
//die();

	if ($first_name != "")
	{
		//file handling
 		if ((($_FILES["photo"]["type"] == "image/gif")
  		|| ($_FILES["photo"]["type"] == "image/jpeg")
  		|| ($_FILES["photo"]["type"] == "image/pjpeg"))
 		//&& ($_FILES["photo"]["size"] < 20000)
		)
  		{
   		if ($_FILES["photo"]["error"] > 0)
    		{
      		echo "Return Code: " . $_FILES["photo"]["error"] . "<br />";
    		}
    		else
    		{
        	move_uploaded_file($_FILES["photo"]["tmp_name"], "../upload/" . $_FILES["photo"]["name"]);
    		}
  		}
  		else
  		{
    		echo "Invalid file";
  		}
  		// end file handling

  		$photo = $_FILES["photo"]["name"];
  		
		$emp->add_employee($conn, $_POST, $photo);
	}
	else
	{
  		$error_msg = "<b><i> Employee name is empty. </b></i>";
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
	if (document.getElementById('first_name').value == "") 
	{
		alert("Please enter first name.");
		document.getElementById('first_name').focus();
		return false;
	}
	
	if (document.getElementById('last_name').value == "") 
	{
		alert("Please enter last name.");
		document.getElementById('last_name').focus();
		return false;
	}

	if (document.getElementById('dept_id').value == "") 
	{
		alert("Please select department.");
		document.getElementById('dept_id').focus();
		return false;
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
 
 
  <div class="main">
  
    <h3>Manage Staff</h3>
    
		<div style="width:400px;">

			<form name="form1" method="post" action="staff.php" onSubmit="return validateInput()" enctype="multipart/form-data">

        <p class='elements'>
        <label for "first_name">First Name</label>
        <input type="text" name="first_name" id="first_name" value="<?php if (isset($row_edit['first_name']) ) print $row_edit['first_name']?>" />                    
        </p>
  
        <p class='elements'>
        <label for "last_name">Last Name</label>
        <input type="text" name="last_name" id="last_name" value="<?php if (isset($row_edit['last_name'])) print $row_edit['last_name']?>" />                    
        </p>

        <p class='elements'>
        <label for "dept_id">Department</label>
			<select id="dept_id" name='dept_id'>
			<option value="">Select Department</option>
			
			<?php
			$result = $dept->all_departments($conn);

			if ($result && $result->num_rows > 0) 
			{
				while ($row = $result->fetch_assoc())
				{
					if (isset($row_edit['dept_id']) && $row_edit['dept_id'] == $row['id'])
					{?>
				  		<option value="<?php echo $row['id']?>" selected option><?php echo $row['dept_name']?></option>
					<?php } else {?>
  					<option value="<?php echo $row['id']?>"><?php echo $row['dept_name']?></option>
				<?php
					}
				} 
			}?>
			</select>
			</p>

        <p class='elements'>
        <label for "profile">Profile</label>
			 </br>
			<textarea name="profile" id="profile" rows="5" cols="40"><?php if (isset($row_edit['profile']) ) print $row_edit['profile'] //echo $row['profile'];?></textarea>
			</p>

        <p class='elements'>
         <label for "photo">Photo</label>
  			<input type="file" name="photo" id="photo" accept="image/*">
			</p>

        <p class='elements'>
        <input TYPE="hidden" name="empid" value="<?php print $empid;?>">
    		
    		<?php
    		if (isset($_GET['empid'])) 
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
        <strong>Employees:</strong>
        <table width="95%" border="0" align="" cellpadding="0" cellspacing="0">
        	<?php
        	
				$result = $emp->all_employees($conn);

				if ($result && $result->num_rows > 0) 
				{
					while ($row = $result->fetch_assoc())
					{
            	?>
             	<tr> 
               <td width=""><?php print $row['first_name'].' '.$row['last_name'];?></td>

               <td width="">&nbsp;</td>
               
               <td width=""><a href="?empid=<?php print $row['id'];?>">Edit</a> | 
               <a href="javascript: promptDelete('?delete=<?php print $row['id'];?>',
                  'Are you sure you want to delete this user?')">Delete</a>
               </td>
               
						<td>
						<!--
						<?php if ($row['photo'] != NULL) {?>
            				<img src="../upload/<?php print $row['photo']?>" width="150" height="150" alt=""  />						
						<?php }?>
						-->
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