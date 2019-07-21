<?php
//--- Data manipulation, table: department ---

class Department
{
	private $result;

	public function check_dept($conn, $name=FALSE)
	{
		if (isset($name) && $name != "")
		{
			// Retrieve a particular dept with given dept name.
			
			$sql = "SELECT dept_name FROM department WHERE dept_name = '$name'";

			$this->result = $conn->query($sql);

			if ($this->result && $this->result->num_rows > 0)
			{
				return $this->result;
			}
		}
	}
	//---end function check_login
	

	public function get_department($conn, $id=FALSE)
	{
		if (isset($id) && $id != 0)
		{
			// Retrieve a department with given id.
			
			$sql = "SELECT * FROM department WHERE id = '$id'";

			$this->result = $conn->query($sql);

			if ($this->result && $this->result->num_rows > 0)
			{
				return $this->result;
			}
		}
	}
	//---end function get_department


	public function all_departments($conn, $id=FALSE)
	{
		// Retrieve all departments.
			
		$sql = "SELECT * FROM department WHERE dept_name != '' ORDER BY dept_name";

		$this->result = $conn->query($sql);

		if ($this->result && $this->result->num_rows > 0)
		{
				return $this->result;
		}
	}
	//---end function all_departments


	public function delete_department($conn, $id)
	{
		$id = htmlspecialchars($id);
		
		$sql = 	"DELETE FROM department WHERE id = '$id'";
		
		$this->result = $conn->query($sql);
		
		if ($this->result === TRUE && $conn->affected_rows > 0)
		{
			return $id;
		}
	}
	//---end function delete_department


	public function update_department($conn, $id, $dept)
	{
		$deptid = htmlspecialchars($id);
		$dept = htmlspecialchars($dept);

		$sql = "UPDATE department SET dept_name = '$dept' WHERE id = $deptid ";			
				
		$this->result = $conn->query($sql);
		
		if ($this->result === TRUE)
		{
			return htmlspecialchars($id);
		}
	}
	//---end function update_department


	public function add_department($conn, $dept)
	{
		$deptname = htmlspecialchars($dept);
		
		$sql = 	"INSERT INTO department(dept_name) values('$deptname')";
		$this->result = $conn->query($sql);
		
		if ($this->result === TRUE)
		{
			return $conn->insert_id;
		}
	}
	//---end function add_department

}
// ---end class Department
?>