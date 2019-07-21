<?php
//--- Data manipulation, table: employee ---

class Employee
{
	private $result;

	public function get_employee($conn, $id=FALSE)
	{
		if (isset($id) && $id != 0)
		{
			// Retrieve an employee with given id.
			
			$sql = "SELECT * FROM employee WHERE id = '$id'";

			$this->result = $conn->query($sql);

			if ($this->result && $this->result->num_rows > 0)
			{
				return $this->result;
			}
		}
	}
	//---end function get_employee


	public function all_employees($conn, $id=FALSE)
	{
		// Retrieve all employees.
			
		$sql = "SELECT * FROM employee ORDER BY first_name";

		$this->result = $conn->query($sql);

		if ($this->result && $this->result->num_rows > 0)
		{
				return $this->result;
		}
	}
	//---end function all_employees


	public function delete_employee($conn, $id)
	{
		$id = htmlspecialchars($id);
		
		$sql = 	"DELETE FROM employee WHERE id = '$id'";
		
		$this->result = $conn->query($sql);
		
		if ($this->result === TRUE && $conn->affected_rows > 0)
		{
			return $id;
		}
	}
	//---end function delete_employee


	public function update_employee($conn, $id, $data)
	{
		$id = htmlspecialchars($id);
		$first_name = htmlspecialchars($data->first_name);
		$last_name = htmlspecialchars($data->last_name);
		$profile = htmlspecialchars($data->profile);
		$dept_id  = htmlspecialchars($data->dept_id );			

		$sql = "UPDATE employee SET 
					first_name = '$first_name',
					last_name = '$last_name',
					profile = '$profile',
					dept_id = '$dept_id'
		WHERE id = '$id'";
				
		$this->result = $conn->query($sql);
		
		if ($this->result === TRUE)
		{
			return htmlspecialchars($id);
		}
	}
	//---end function update_employee


	public function add_employee($conn, $data, $photo)
	{
//print_r($data);
//die();
		$first_name = htmlspecialchars($data['first_name']);
		$last_name = htmlspecialchars($data['last_name']);
		$profile = htmlspecialchars($data['profile']);
		$dept_id  = htmlspecialchars($data['dept_id']);			
		
		$sql = 	"INSERT INTO employee(first_name, last_name, profile, dept_id, photo)
				  	VALUES (
					'$first_name',
					'$last_name',	
					'$profile',									  								  
					'$dept_id',
					'$photo'							  
					)";

		$this->result = $conn->query($sql);
		
		if ($this->result === TRUE)
		{
			return $conn->insert_id;
		}
	}
	//---end function add_employee


	public function search_all_staff($conn)
	{
		// Retrieve all matching employees.
			
		$sql = "SELECT employee.*,  department.dept_name FROM employee
		LEFT JOIN department ON employee.dept_id = department.id
		ORDER BY department.dept_name, first_name";

		$this->result = $conn->query($sql);

		if ($this->result && $this->result->num_rows > 0)
		{
			return $this->result;
		}
	}
	//---end function search_all_staff


	public function search_match_emp($conn, $keyword=FALSE)
	{
		// Retrieve all matching employees.
			
		$sql = "SELECT employee.*,  department.dept_name FROM employee
		LEFT JOIN department ON employee.dept_id = department.id
		WHERE first_name='$keyword' OR last_name='$keyword' 
		ORDER BY first_name, last_name";

		$this->result = $conn->query($sql);

		if ($this->result && $this->result->num_rows > 0)
		{
			return $this->result;
		}

		$sql = "SELECT employee.*,  department.dept_name FROM employee
		LEFT JOIN department ON employee.dept_id = department.id
		WHERE first_name='$keyword' OR last_name='$keyword' OR dept_name='$keyword' 
		ORDER BY first_name, last_name, dept_name";

		$this->result = $conn->query($sql);

		if ($this->result && $this->result->num_rows > 0)
		{
			return $this->result;
		}

		$sql = "SELECT employee.*,  department.dept_name FROM employee
		LEFT JOIN department ON employee.dept_id = department.id
		WHERE first_name='$keyword' OR last_name='$keyword' OR dept_name='$keyword'
		OR profile='$keyword'
		ORDER BY first_name, last_name, dept_name";

		$this->result = $conn->query($sql);

		if ($this->result && $this->result->num_rows > 0)
		{
			return $this->result;
		}

		$sql = "SELECT employee.*,  department.dept_name FROM employee
		LEFT JOIN department ON employee.dept_id = department.id
		WHERE first_name LIKE '%$keyword%' OR last_name LIKE '%$keyword%' OR dept_name LIKE '%$keyword%'
		OR profile LIKE '%$keyword%'
		ORDER BY first_name, last_name, dept_name";

		$this->result = $conn->query($sql);

		if ($this->result && $this->result->num_rows > 0)
		{
			return $this->result;
		}
	}
	//---end function search_match_emp


	public function search_match_dept($conn, $keyword=FALSE, $dept=FALSE)
	{
		// Retrieve all matching employees.

		$sql = "SELECT employee.*,  department.dept_name FROM employee
		LEFT JOIN department ON employee.dept_id = department.id
		WHERE (first_name='$keyword' OR last_name='$keyword')
		AND employee.dept_id = '$dept'
		ORDER BY first_name, last_name, dept_name";

		$this->result = $conn->query($sql);

		if ($this->result && $this->result->num_rows > 0)
		{
			return $this->result;
		}

		$sql = "SELECT employee.*,  department.dept_name FROM employee
		LEFT JOIN department ON employee.dept_id = department.id
		WHERE (first_name='$keyword' OR last_name='$keyword' OR profile='$keyword')
		AND employee.dept_id = '$dept'
		ORDER BY first_name, last_name, dept_name";

		$this->result = $conn->query($sql);

		if ($this->result && $this->result->num_rows > 0)
		{
			return $this->result;
		}
		
		$sql = "SELECT employee.*,  department.dept_name FROM employee
		LEFT JOIN department ON employee.dept_id = department.id
		WHERE (first_name LIKE '%$keyword%' OR last_name LIKE '%$keyword%' OR profile LIKE '%$keyword%')
		AND employee.dept_id = '$dept'
		ORDER BY first_name, last_name, dept_name";

		$this->result = $conn->query($sql);

		if ($this->result && $this->result->num_rows > 0)
		{
			return $this->result;
		}

	}
	//---end function search_match_dept


	public function search_match_dept_only($conn, $dept=FALSE)
	{
		// Retrieve all matching employees.
			
		$sql = "SELECT employee.*,  department.dept_name FROM employee
		LEFT JOIN department ON employee.dept_id = department.id
		WHERE employee.dept_id = '$dept'
		ORDER BY first_name, last_name, dept_name";

		$this->result = $conn->query($sql);

		if ($this->result && $this->result->num_rows > 0)
		{
			return $this->result;
		}
	}
	//---end function search_match_dept

}
// ---end class search_match_dept_only
?>