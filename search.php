<?php

include_once 'admin/config/db_conn.php';
include_once 'admin/data/employee.php';
include_once 'admin/data/department.php';

$db_conn = new DBconn();
$conn = $db_conn->db_connection();
  
$staff = new Employee();
$dept = new Department();

if (isset($_POST['submit']))
{
	$keyword = "";
	$dept_id = "";

	if (isset($_POST["keyword"])) $keyword = $_POST["keyword"];
	if (isset($_POST["dept_id"])) $dept_id = $_POST["dept_id"];
	
	if ($keyword != "" && $dept_id == "")
	{
//die("keyword: $keyword");
		// All Employees matching keyword regarless of dept
		$search_res = search_all_matching($staff, $conn, $keyword);
	}
	else if ($keyword != "" && $dept_id != "")
	{
		// Employees matching keyword in a given dept
		$search_res = search_dept_staff($staff, $conn, $keyword, $dept_id);
	}
	else if ($keyword == "" && $dept_id != "")
	{
		// All employees in a given dept
		$search_res = search_dept_only($staff, $conn, $dept_id);
	}
	else if ($keyword == "" && $dept_id == "")
	{
		// All employees
		$search_res = search_all_staff($staff, $conn);
	}

	if ($search_res && $search_res->num_rows == 0)
		$error = 'No matches found.';
}

function search_all_staff($staff, $conn)
{
	$result = $staff->search_all_staff($conn);
	
	if ($result && $result->num_rows > 0)
	{
		return $result;
	}
}

function search_all_matching($staff, $conn, $keyword)
{
	$result = $staff->search_match_emp($conn, $keyword);
	
	if ($result && $result->num_rows > 0)
	{
		return $result;
	}
}

function search_dept_staff($staff, $conn, $keyword, $dept_id)
{
	$result = $staff->search_match_dept($conn, $keyword, $dept_id);
	
	if ($result && $result->num_rows > 0)
	{
		return $result;
	}
}

function search_dept_only($staff, $conn, $dept_id)
{
	$result = $staff->search_match_dept_only($conn, $dept_id);
	
	if ($result && $result->num_rows > 0)
	{
		return $result;
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Staff Directory - Login</title>

<?php include_once 'header.html';?>

</head>

<script>

function validateInput()
{
	/*	
	if (document.getElementById("keyword").value=="" && document.getElementById("dept_id").value=="") 
	{
		alert("Please enter a keyword or select a department for search");
		document.getElementById("keyword").focus();
		return false;
	}
	/*
}

$(document).ready(function () 
{
  $('#search_form').submit(function (e) {

    e.preventDefault();

    var keyword = $("#keyword").val();

    $.post("process.php", {
      keyword: keyword

    }).complete(function() {
        console.log("Success");
      });
  });
});

</script>

<body>

<?php include_once'body_top.html';?>

<div class="row">

  <div class="main">
  
    <!--<h2>Staff Directory</h2>-->
    
     <p></p>

		<form action="search.php" id="search_form" method="post" onSubmit="return validateInput()">
        	<p class='elements'>
  			<input type="text" placeholder="keyword" name="keyword" id="keyword" value="<?php if (isset($keyword)) print $keyword;?>">
  			<!--<input type="search" id="keyword" name="keyword" aria-label="Search">-->

        	<!--<input name="Submit" id="Submit" type="submit" class="" value="Search" onClick="js_submit()">-->
        	<input name="submit" id="submit" type="submit" style="" value="Search">
        	
			<select name='dept_id' id='dept_id'>
			<option value="">Department</option>
			
			<?php
			$result = $dept->all_departments($conn);

			if ($result && $result->num_rows > 0) 
			{
				while ($row = $result->fetch_assoc())
				{
					if ($dept_id == $row['id']){?>
	  					<option value="<?php echo $row['id']?>" selected><?php echo $row['dept_name']?></option>
  					<?php } else {?>				
  						<option value="<?php echo $row['id']?>"><?php echo $row['dept_name']?></option>
  				<?php
  					}
				} 
			}?>
			</select>
       </p>
		</form>

    	<br/><br/>
    	
    	<div>
    	<?php
    	if (isset($search_res))
    	{
    		while ($row = $search_res->fetch_assoc())
			{?>
				<!--<div>-->
				<div style="float:left">
				<?php if ($row['photo'] != NULL) {?>
          		<img src="upload/<?php print $row['photo']?>" width="150" height="150" alt=""  />
				<?php }?>
				</div>
				<?php if ($row['photo'] != NULL) {?>
				<div style="display: block; padding-left: 160px; border: 1px solid #4CAF50;">
				<?php } else {?>
				<div style="display: block; border: 1px solid #4CAF50;">
				<?php }?>
					<h3>
					<?php 
					//print $row['first_name']." ".$row['last_name'];
					$first_name = str_ireplace($keyword, '<span style="color: #FF6347;">'.$keyword.'</span>', $row['first_name']);
					$last_name = str_ireplace($keyword, '<span style="color: #FF6347;">'.$keyword.'</span>', $row['last_name']);
					print $first_name." ".$last_name;					
					?>
					</h3>
					<h4><?php 
					//print $row['dept_name'];
					print str_ireplace($keyword, '<span style="color: #FF6347;">'.$keyword.'</span>', $row['dept_name']);
					?></h4>
					<h5><p style="margin: 25px 25px 25px 0px;">
					<?php
					 //print $row['profile'];
					 print str_ireplace($keyword, '<span style="color: #FF6347;">'.$keyword.'</span>', $row['profile']);
					 ?>
					</p></h5>
				</div>
				<!--</div>-->
			<?php			
			}
		}
		if (isset($error) && $error != "")
			echo "<p class='elements'><h4>.$error.</h4></p>";
    	?>

		</div>
		
  </div>
 
</div>

<?php include_once 'footer.html'; ?>

</body>
</html>