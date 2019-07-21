<?php
//--- Data manipulation, table: user ---

class User
{
	private $result;

	public function check_login($conn, $name=FALSE)
	{
		if (isset($name) && $name != "")
		{
			// Retrieve a particular user with given user name.
			
			$sql = "SELECT user_name, password FROM user WHERE user_name = '$name'";

			$this->result = $conn->query($sql);

			if ($this->result && $this->result->num_rows > 0)
			{
				return $this->result;
			}
		}
	}
	//---end function check_login
	

	public function get_user($conn, $id=FALSE)
	{
		if (isset($id) && $id != 0)
		{
			// Retrieve a user with user id.
			
			$sql = "SELECT * FROM user WHERE id = '$id'";

			$this->result = $conn->query($sql);

			if ($this->result && $this->result->num_rows > 0)
			{
				return $this->result;
			}
		}
	}
	//---end function get_user

	public function all_users($conn, $id=FALSE)
	{
		// Retrieve all users.
			
		$sql = "SELECT * FROM user ORDER BY user_name";

		$this->result = $conn->query($sql);

		if ($this->result && $this->result->num_rows > 0)
		{
				return $this->result;
		}
	}
	//---end function all_users

	public function check_password($conn, $id=FALSE, $password=FALSE)
	{
		if (isset($name) && $name != "")
		{
			$sql = "SELECT * FROM user WHERE id = '$id' AND password = '$password'";

			$this->result = $conn->query($sql);

			if ($this->result && $this->result->num_rows > 0)
			{
				return $this->result;
			}
		}
	}
	//---end function check_password
	

	public function delete_user($conn, $id)
	{
		$id = htmlspecialchars($id);
		
		$sql = 	"DELETE FROM user WHERE id = '$id'";
		
		$this->result = $conn->query($sql);
		
		if ($this->result === TRUE && $conn->affected_rows > 0)
		{
			return $id;
		}
	}
	//---end function delete_user


	public function update_user($conn, $id, $password)
	{
		$userid = htmlspecialchars($id);
		$newpword = htmlspecialchars($password);

		$sql = "UPDATE user SET password = '$newpword' WHERE id = $userid ";			
				
		$this->result = $conn->query($sql);
		
		if ($this->result === TRUE)
		{
			return htmlspecialchars($id);
		}
	}
	//---end function update_user

	public function add_user($conn, $user, $password)
	{
		$username = htmlspecialchars($user);
		$pword = htmlspecialchars($password);
		
		$sql = 	"INSERT INTO user(user_name, password) values('$username', '$pword')";
		$this->result = $conn->query($sql);
		
		if ($this->result === TRUE)
		{
			return $conn->insert_id;
		}
	}
	//---end function add_user

}
// ---end class User
?>