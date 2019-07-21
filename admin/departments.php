<?php

session_start();

if (!isset($_SESSION['user']))
{
	header("Location: ../login.php");
	exit;
}

include_once 'config/db_conn.php';
include_once 'data/department.php';

$db_conn = new DBconn();
$conn = $db_conn->db_connection();
  
$dept = new Department();

$error_msg =" ";
$deptid  = "";

if (isset($_GET['deptid']))  $deptid = $_GET['deptid'];
if (isset($_POST['deptid'])) $deptid = $_POST['deptid'];

$rs_edit = $dept->get_department($conn, $deptid);

if (!empty($rs_edit))
  $row_edit = $rs_edit->fetch_assoc();

if (isset($_GET['delete']))
{
	$rs_delete = $dept->delete_department($conn, $_GET['delete']);	
	
	if ($rs_delete)
		header("location : departments.php");
	else
		$error_msg = "Error deleting department ".$_GET['delete'];
}

if (isset($_POST['cmdupdate']))
{
		$rs_update = $dept->update_department($conn, $deptid, $_POST[deptname]);	

		if( isset($_GET['deptid']) ) unset($_GET['deptid']);
			header("location : departments.php");
}

if (isset($_POST['Submit']))
{ 
	$error_msg = "";
	$deptname = $_POST["deptname"];
	
	$result = $dept->check_dept($conn, $deptname);

	$dept_name = "";

	if ($result)
	{
		$row = $result->fetch_assoc();
		$dept_name = $row['dept_name']; 
	}

	if ($dept_name != $deptname)
	{
		$result = $dept->add_department($conn, $deptname);	
	}
	elseif ($dept_name != "")
	{
  		$error_msg = "<b><i> Department already exists. </b></i>";
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
	if (document.form1.deptname.value == "") 
	{
		alert("Please enter a value for department name");
		document.form1.deptname.focus();
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
 
 
  <div class="main" style="">
  
    <h3>Manage Departments</h3>
    
		<div style="width:400px;">

			<form name="form1" method="post" action="departments.php" onSubmit="return validateInput()">

        <p class='elements'>
        <label for "deptname">Department Name</label>
        <input type="text" name="deptname" value="<?php if (isset($row_edit['dept_name']) ) print $row_edit['dept_name']?>" />                    
        </p>
        
         <p class='elements'>
        
			<input TYPE="hidden" name="deptid" value="<?php print $deptid;?>">
    		
    		<?php
    		if (isset($_GET['deptid'])) 
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
        <strong>Departments:</strong>
        <table width="95%" border="0" align="" cellpadding="0" cellspacing="0">
        	<?php
        	
				$result = $dept->all_departments($conn);

				if ($result && $result->num_rows > 0) 
				{
					while ($row = $result->fetch_assoc())
					{
            	?>
             	<tr> 
               <td width=""><?php print $row['dept_name'];?></td>
               <td width="">&nbsp;</td>
               <td width=""><a href="?deptid=<?php print $row['id'];?>">Edit</a> | 
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