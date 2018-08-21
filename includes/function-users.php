<?php
	require('./includes/dbconfig.php');	
	
	class user{
		public $id;
		public $uname;
		public $rname;
		public $email;
		public $permission;
		
		function __construct($_id,$_uname,$_rname,$_email,$_permission)	
		{
			$this->id = $_id;			
			$this->uname = $_uname;
			$this->rname = $_rname;
			$this->email = $_email;
			$this->permission = $_permission;	
		}
		
		function SetUname($_uname)
		{
			$this->uname = $_uname;
		}		
		function SetRname($_rname)
		{
			$this->rname = $_rname;
		}		
		function SetEmail($_email)
		{
			$this->email = $_email;
		}
		function SetPermission ($_permission)
		{
			$this->permission = $_permission;
		}
		function GetPermission()
		{			
			switch ($this->permission) {
				case 0:
					return "Zárolt";
					break;				
				case 2:
					return "Felhasználó";
					break;				
				case 5:
					return "Szuper Felhasználó";
					break;
				case 9:
					return "Rendszergazda";
					break;
			}
		}
	}

	function Login($uname,$passwd)
	{
		global $conn;	
		$uname = mysqli_real_escape_string($conn, $uname);
		$passwd = mysqli_real_escape_string($conn, $passwd);
		$sql = "SELECT * FROM Felhasznalok WHERE username='".$uname."' and password='".strtoupper(hash('sha256', $passwd))."' ";
		print $sql;
		$result = $conn->query($sql);			
		$user = array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$arr[] = new user($row['id'],$row['username'],$row['realname'],$row['email'],$row['permission'] );		
			}
		return $arr[0];
		} else {
			return "NotExist";
		}		
	}
	
	function ListAllUser($order)
	{
		global $conn;		
		$sql = "SELECT * FROM `Felhasznalok` ";
		$result = $conn->query($sql);			
		$arr = array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$arr[] = new user($row['id'],$row['username'],$row['realname'],$row['email'],$row['permission'] );
			}
		} else {
			print "Hiba csúszott  a rendszerbe";
		}
		return $arr;
	}
	
	function SearchUser ($id)
	{
		global $conn;
		$sql = "SELECT * FROM `Felhasznalok` WHERE `id` = ".$id."";
		$result = $conn->query($sql);			
		$clients = array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$arr[] = new user($row['id'],$row['username'],$row['realname'],$row['email'],$row['permission'] );
				break;
			}
		} else {
			$_SESSION['error'] = "Hiba történt";
		}
		return $arr[0];
	}
	
	function AddUser($user,$passwd)
	{
		global $conn;
		$passwd = strtoupper(hash('sha256', $passwd));
		$sql = "INSERT INTO `Felhasznalok` (`username`, `password`, `realname`, `email`, `permission`) VALUES ('".$user->uname."', '".$passwd."', '".$user->rname."', '".$user->email."', '".$user->permission."')";
		if ($conn->query($sql) === TRUE) {
			$_POST = array();
			echo  "<meta http-equiv='refresh' content='0'>";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}		
	}
	
	function DelUser($id)
	{
		global $conn;
		$sql = "DELETE FROM `Felhasznalok` WHERE `id` = '".$id."'";
		$conn->query($sql);		
		if ($conn->query($sql) === TRUE) {
			$_POST = array();
			echo  "<meta http-equiv='refresh' content='0'>";
		} else {
			echo "Error deleting record: " . $conn->error;
		}
	}
	
	function ModUser ($user)
	{
		global $conn;
		$sql = "UPDATE `Felhasznalok` SET `username` = '".$user->uname."', `realname` = '".$user->rname."', `email` = '".$user->email."', `permission` = '".$user->permission."' WHERE `id` = ".$user->id."";
		if ($conn->query($sql) === TRUE) {
			$_POST = array();
			echo  "<meta http-equiv='refresh' content='0'>";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}		
	}	
	
	function ModUserPasswd ($id,$passwd)
	{
		global $conn;
		$passwd = strtoupper(hash('sha256', $passwd));
		$sql = "UPDATE `Felhasznalok` SET `password` = '".$passwd."' WHERE `id` = ".$id."";
		if ($conn->query($sql) === TRUE) {
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}		
	}
?>