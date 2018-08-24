<?php
	require('./includes/dbconfig.php');	
	require('./includes/function-users.php');
	class device{
		public $id;
		public $uid;
		public $name;
		public $ip;
		public $mac;
		public $uplimit;
		public $up="0";
		public $upwrite;
		public $downwrite;
		public $down="0";
		
		function __construct($_id,$_uid,$_name,$_ip,$_mac,$_uplimit)	
		{
			$this->id = $_id;			
			$this->uid = $_uid;
			$this->name = $_name;
			$this->ip = $_ip;
			$this->mac = $_mac;
			$this->uplimit = $_uplimit;	
			$this->up = $this->GetUp($_ip);
			$this->down = $this->GetDown($_ip);
			$this->upwrite =$this->GetWrite($this->up);			
			$this->downwrite =$this->GetWrite($this->down);
		}	
		
		function SetName($_name)
		{
			$this->name = $_name;
		}
		function SetMAC($_mac)
		{
			$this->mac = $_mac;
		}
		function SetIP($_ip)
		{
			$this->ip = $_ip;
		}

		function GetUser ()
		{
			return SearchUser($this->uid)->rname;
		}
		function GetUp ($_ip)
		{
			$dbconn = pg_connect("host=193.225.227.1 dbname=bandwidthd user=postgres password=titok") or die('Could not connect: ' . pg_last_error());
			$result = pg_query($dbconn, "			
			select sum (total)
			from bd_tx_log 
			where timestamp  > now()::date and ip ='".$_ip ."'
			group by ip
			having sum(total) > 1
			");			
			while ($line = pg_fetch_row($result)) {
				return $line[0];
			}			
			// Free resultset
			pg_free_result($result);			
			// Closing connection
			pg_close($dbconn);		
		}
		function GetDown ($_ip)
		{
			$dbconn = pg_connect("host=193.225.227.1 dbname=bandwidthd user=postgres password=titok") or die('Could not connect: ' . pg_last_error());
			$result = pg_query($dbconn, "			
			select sum (total)
			from bd_rx_log 
			where timestamp  > now()::date and ip ='".$_ip ."'
			group by ip
			having sum(total) > 1
			");			
			while ($line = pg_fetch_row($result)) {
				return $line[0];
			}			
			// Free resultset
			pg_free_result($result);			
			// Closing connection
			pg_close($dbconn);		
		}
		function GetWrite($in)
		{
			$Max = 1024;
			$Output = $in;
			$Suffix = 'KB';
		
			if ($Output > $Max)
			{
				$Output /= 1024;
				$Suffix = 'MB';
			}
		
			if ($Output > $Max)
			{
				$Output /= 1024;
				$Suffix = 'GB';
			}
		
			if ($Output > $Max)
			{
				$Output /= 1024;
				$Suffix = 'TB';
			}					
			return( round( $Output , 2 )." ".$Suffix);			
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
		
	function ListAllDevices ($order)
	{		
		global $conn;		
		$sql = "SELECT * FROM `Eszkozok`    ORDER BY ".$order."  ";
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

	function FirstIP()
	{
		global $conn;
		$sql = "select INET_NTOA(min(id)) as min_ip from ( select 2887647489 id from Eszkozok where 2887647489 not in ( select inet_aton(ip) from Eszkozok) UNION select inet_aton(ip) + 1 id from Eszkozok where inet_aton(ip) + 1 not in ( select inet_aton(ip) from Eszkozok) and inet_aton(ip) > 2887647489 ) as min_ip" ;
		//Láttál már valaha ennél csúnyábbat? mert én nem... Amúgy az első szabad IP-t keresi
		$result = $conn->query($sql);			
		$clients = array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				return $row["min_ip"];
				break;
			}
		} else {
			$_SESSION['error'] = "Hiba történt";
		}
	}

	
?>