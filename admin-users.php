<html>
	<head>
	<title>GEO Koli - K.A.P.</title>
		<meta charset="utf-8"> 
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>		
	</head>
	<body>
		<?php
			session_start();
			$active = "Felhasznalok";
			include('./includes/header.php');	
			include('./includes/function-users.php');			
			$_SESSION['permission']=9 ;		
			
			//Rendezés
			if (isset($_POST['order']))
			{
				$_SESSION['order'] = $_POST['order']; //Ez ide lehet nem kell
				$order = $_SESSION['order'];
			} else {
				$order = "rname asc"; //Alapértelmezett
			}
			
			$users[] = ListAllUser($order);
			
			if (isset($_POST['btn']))
			{
				switch (explode("_",$_POST['btn'])[0]) {
					case "add":
						require('./includes/dialog-user-add.php');	
						print "<script> $('#add').modal({show: true}) </script>";
						break;
					case "mod":
						$SelectedUser = SearchUser (explode("_",$_POST['btn'])[1]);								
						require('./includes/dialog-user-mod.php');	
						print "<script> $('#mod').modal({show: true}) </script>";
						break;				
					case "del":
						$SelectedUser = SearchUser (explode("_",$_POST['btn'])[1]);								
						require('./includes/dialog-user-del.php');	
						print "<script> $('#del').modal({show: true}) </script>";
						break;
				}
			}
			
			if (isset($_POST['action']))
			{
				switch ($_POST['action']) {
					case "add":						
						AddUser(new user(0,$_POST["uname"],$_POST["rname"],$_POST["email"],$_POST["permission"]),$_POST['passwd']);
						break;					
					case "mod":
						$SelectedUser = SearchUser ( $_POST['id']);
						if (isset($_POST['passwd'] ))
						{
							ModUserPasswd($SelectedUser->id,$_POST['passwd']);
						}	

						$SelectedUser->SetUname($_POST['uname']);
						$SelectedUser->SetRname($_POST['rname']);
						$SelectedUser->SetEmail($_POST['email']);
						$SelectedUser->SetPermission($_POST['permission']);						
						ModUser($SelectedUser);					
						break;					
					case "del":
						DelUser($_POST['id']);
						break;
				}
			}
			
		?>
		
		<div class="container static">		
			<?php 
				if (isset($_POST['error']))
				{
					print "<div class='alert alert-danger input-errors'><p>".$_POST['error']."</p></div>";
				}
			?>
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
					<th>Felhasználónév
						<button type='submit' value='ip asc' class='glyphicon glyphicon-menu-down' name='order' style='background:transparent; border:none; '></button>
						<button type='submit' value='ip desc' class='glyphicon glyphicon-menu-up' name='order' style='background:transparent; border:none; '></button>
					</th>					
					<th>Email cím
						<button type='submit' value='mac asc' class='glyphicon glyphicon-menu-down' name='order' style='background:transparent; border:none; '></button>
						<button type='submit' value='mac desc' class='glyphicon glyphicon-menu-up' name='order' style='background:transparent; border:none; '></button>
					</th>		
					<th>Jogosultság
						<button type='submit' value='up asc' class='glyphicon glyphicon-menu-down' name='order' style='background:transparent; border:none; '></button>
						<button type='submit' value='up desc' class='glyphicon glyphicon-menu-up' name='order' style='background:transparent; border:none; '></button>
					</th>
					</form>
					<th></th>
				</tr>
			</thead>
			<tbody id="table">
					<form action="#" method="post">
					<?php
						foreach ($users[0] as $item)
						{						
							print "<tr>";
									print "<td>".$item->rname."</td>";									
									print "<td>".$item->uname."</td>";									
									print "<td>".$item->email."</td>";									
									print "<td>".$item->GetPermission()."</td>";									
									print "<td>
										<button type='submit' value='mod_".$item->id."' class='glyphicon glyphicon-pencil' name='btn' style='background:transparent; border:none; '></button>
										<button type='submit' value='del_".$item->id."' class='glyphicon glyphicon-remove' name='btn' style='background:transparent; border:none; '></button>
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