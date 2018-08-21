<?php
	require('./includes/dbconfig.php');	
	
	class device{
		public $id;
		public $uid;
		public $name;
		public $ip;
		public $mac;
		public $uplimit;
		public $up="0";
		public $down="0";
		
		function __construct($_id,$_uid,$_name,$_ip,$_mac,$_uplimit)	
		{
			$this->id = $_id;			
			$this->uid = $_uid;
			$this->name = $_name;
			$this->ip = $_ip;
			$this->mac = $_mac;
			$this->uplimit = $_uplimit;		
		}
		
		function SetName($_name)
		{
			$this->name = $_name;
		}
	}	
	
	function ListUserDevices ($order)
	{		
		global $conn;		
		$sql = "SELECT * FROM `Eszkozok`  WHERE `user_id` = ".$_SESSION['uid']."  ORDER BY ".$order."  ";
		$result = $conn->query($sql);			
		$arr = array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$arr[] = new device($row["id"],$row["user_id"],$row["name"],$row["ip"],$row["mac"],$row["uplimit"]);
			}
		} else {
			$_SESSION['error'] = "Hiba csúszott  a rendszerbe";
		}
		return $arr;
	}
	
	function SearchDevice ($id)
	{
		global $conn;
		$sql = "SELECT * FROM `Eszkozok` WHERE `id` = ".$id."";
		$result = $conn->query($sql);			
		$clients = array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$arr[] = new device($row["id"],$row["user_id"],$row["name"],$row["ip"],$row["mac"],$row["uplimit"]);
				break;
			}
		} else {
			$_SESSION['error'] = "Hiba történt";
		}
		return $arr[0];
	}
	
	function AddDevice($device)
	{
		global $conn;
		$sql = "INSERT INTO `Eszkozok` (`user_id`, `name`, `ip`, `mac`, `uplimit`) VALUES ('".$device->uid."', '".$device->name."', '".$device->ip."', '".$device->mac."', '".$device->uplimit."')";
		if ($conn->query($sql) === TRUE) {
			$_POST = array();
			echo  "<meta http-equiv='refresh' content='0'>";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}		
	}
	
	function ModDevice ($device)
	{
		global $conn;
		$sql = "UPDATE `Eszkozok` SET `user_id` = '".$device->uid."', `name` = '".$device->name."', `ip` = '".$device->ip."', `mac` = '".$device->mac."', `uplimit` = '".$device->uplimit."'  WHERE `id` = ".$device->id."";
		if ($conn->query($sql) === TRUE) {
			$_POST = array();
			echo  "<meta http-equiv='refresh' content='0'>";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}		
	}
	
	function DelDevice($id)
	{
		global $conn;
		$sql = "DELETE FROM `Eszkozok` WHERE `id` = '".$id."'";
		$conn->query($sql);		
		if ($conn->query($sql) === TRUE) {
			$_POST = array();
			echo  "<meta http-equiv='refresh' content='0'>";
		} else {
			echo "Error deleting record: " . $conn->error;
		}
	}
?>