<html>
	<head>
	<title>GEO - K.A.P.</title>
		<meta charset="utf-8"> 
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>		
	</head>
	<body>
		<?php
			session_start();
			$active = "Eszkozok";
			include('./includes/header.php');	
			include('./includes/function-devices.php');	
			if (!isset($_SESSION['uname']) ){
					header("Location: index.php");
			}

			include('./includes/devices.php');		

			//Rendezés
			if (isset($_POST['order']))
			{
				$_SESSION['order'] = $_POST['order']; //Ez ide lehet nem kell
				$order = $_SESSION['order'];
			} else {
				$order = "name asc"; //Alapértelmezett
			}
			
			$devices[] = ListUserDevices($order);
			
			if (isset($_POST['btn']))
			{
				switch (explode("_",$_POST['btn'])[0]) {
					case "add":
						require('./includes/dialog-devices-add.php');	
						print "<script> $('#add').modal({show: true}) </script>";
						break;
					case "mod":
						$SelectedDevice = SearchDevice (explode("_",$_POST['btn'])[1]);								
						require('./includes/dialog-devices-mod.php');	
						print "<script> $('#mod').modal({show: true}) </script>";
						break;				
					case "del":
						$SelectedDevice = SearchDevice (explode("_",$_POST['btn'])[1]);								
						require('./includes/dialog-devices-del.php');	
						print "<script> $('#del').modal({show: true}) </script>";
						break;
				}
			}
			
			if (isset($_POST['action']))
			{
				switch ($_POST['action']) {
					case "add":						
						AddDevice(new device(0,$_SESSION['uid'],$_POST["name"],FirstIP(),$_POST["mac"],1));
						break;					
					case "mod":
						$SelectedDevice =SearchDevice ( $_POST['id']);
						$SelectedDevice->SetName($_POST['name']);
						ModDevice($SelectedDevice);
						break;					
					case "del":
						DelDevice($_POST['id']);
						break;
				}
			}
			
		?>
		
		<div class="container static">
				<ol class="breadcrumb" >
                <div class="row">
                    <div class="col-sm-8">
					<form action="#" method="post" class='form-horizontal' style="margin-bottom: 0px">
						<button type='submit' value='add' class='glyphicon glyphicon-plus btn btn-success' name='btn'>Hozzáadás</button>					
					</form>
					</div>
                    <div class="col-sm-4">
						<input class="form-control" id="keres" type="text" placeholder="Keresés..">
                    </div>    
            </div>
			</ol>
		
				
			<table  class="table table-bordered" >
			<thead>
				<tr>
					<form action="#" method="post">
					<th>Név
						<button type='submit' value='name asc' class='glyphicon glyphicon-menu-down' name='order' style='background:transparent; border:none; '></button>
						<button type='submit' value='name desc' class='glyphicon glyphicon-menu-up' name='order' style='background:transparent; border:none; '></button>
					</th>
					<th>IP Cím
						<button type='submit' value='ip asc' class='glyphicon glyphicon-menu-down' name='order' style='background:transparent; border:none; '></button>
						<button type='submit' value='ip desc' class='glyphicon glyphicon-menu-up' name='order' style='background:transparent; border:none; '></button>
					</th>					
					<th>MAC Cím
						<button type='submit' value='mac asc' class='glyphicon glyphicon-menu-down' name='order' style='background:transparent; border:none; '></button>
						<button type='submit' value='mac desc' class='glyphicon glyphicon-menu-up' name='order' style='background:transparent; border:none; '></button>
					</th>		
					<th>Napi letöltés
						<button type='submit' value='up asc' class='glyphicon glyphicon-menu-down' name='order' style='background:transparent; border:none; '></button>
						<button type='submit' value='up desc' class='glyphicon glyphicon-menu-up' name='order' style='background:transparent; border:none; '></button>
					</th>								
					<th>Napi feltöltés
						<button type='submit' value='down asc' class='glyphicon glyphicon-menu-down' name='order' style='background:transparent; border:none; '></button>
						<button type='submit' value='down desc' class='glyphicon glyphicon-menu-up' name='order' style='background:transparent; border:none; '></button>
					</th>
					</form>
					<th></th>
				</tr>
			</thead>
			<tbody id="table">
					<form action="#" method="post">
					<?php
						foreach ($devices[0] as $item)
						{						
							print "<tr>";
									print "<td>".$item->name."</td>";									
									print "<td>".$item->ip."</td>";									
									print "<td>".strtoupper($item->mac)."</td>";									
									print "<td>".$item->downwrite."</td>";
									print "<td>".$item->upwrite."</td>";
									
									print "<td>
										<button type='submit' value='mod_".$item->id."' class='glyphicon glyphicon-pencil' name='btn' style='background:transparent; border:none; '></button>
										<button type='submit' value='del_".$item->id."' class='glyphicon glyphicon-remove' name='btn' style='background:transparent; border:none; '></button>
										<button type='submit' value='".$item->ip."' class='glyphicon glyphicon-list-alt' name='btn' style='background:transparent; border:none; '></button>
									</td>";								
							print "</tr>";
						}		
					?>
					</form>
				</tbody>			
		</table>
		</div>
		<script>
		$(document).ready(function(){
			$("#keres").on("keyup", function() {
			var value = $(this).val().toLowerCase();
				$("#table tr").filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});
			});
		});
		</script>
	</body>
</html>