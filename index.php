<html>
	<head>	
		<title>GEO - K.A.P.</title>
		<meta charset="utf-8"> 
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="./css/login.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>			
	</head>
	<body>		
	
	<?php
		session_start();
		include('./includes/function-users.php');

		
		if (isset($_POST['username']))	{
			$user= Login($_POST['username'],$_POST['password']);
			if (! is_null($user))
			{				
				$_POST = array();
				$_SESSION['uname'] = $user->uname;
				$_SESSION['permission'] =  $user->permission;		
				header("Location: ./devices.php"); 
				exit();
			} 
		}
	?>
	
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
				<div class="account-wall">
					<h1 class="logo">
						GEO - Kollégiumi Adminisztrációs Portál
					</h1>
					<form class="form-signin" action="" method="post">
						<?php
						if ($user == "NotExist")
						{
							print "<span class='alert alert-danger help-block' role='alert'>Nem megfelelő felhasználónév vagy jelszó!</span>";
						}
						?>
						<input placeholder="Felhasználónév" name="username" type="text" required="required"  autofocus="" class="form-control" />						
						<input placeholder="Jelszó" name="password" type="password" required="required" class="form-control"/>	
						<div class="checkbox">
							<label>
								<input usecontainer="1"  value="1" type="checkbox"> Emlékezz rám
							</label>
						</div>			
						<div class="form-actions">
							<button class="btn btn-primary btn-default btn-block" type="submit" >Bejelentkezés</button>
						</div>
						<div class="actions">
							<a href="" class="pull-left"><span class="glyphicon glyphicon-user"></span> Regisztráció</a>
							<a href="" class="pull-right"><span class="glyphicon glyphicon-lock"></span> Elfelejtett jelszó</a>
						</div>						
					</form>
				</div>
			</div>
		</div>
	</div>

	
   
	</body>
</html>