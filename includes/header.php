<nav class="navbar navbar-inverse" id = "menu">
	<div class="container-fluid">
	<div class="navbar-header">
		<div class="navbar-brand">GEO K.A.P.</div>		
  	</div>
	<ul class="nav navbar-nav">
		<li <?php if ($active=="Eszkozok") {print "class='active'";}	?> ><a href="./devices.php">Eszközök</a></li>	
		
		<?php
			if ( (int)$_SESSION['permission'] > 7){
			print "
				<li class='dropdown'>
					<a class='dropdown-toggle' data-toggle='dropdown' href='#'>Admin<span class='caret'></span></a>
					<ul class='dropdown-menu'>
						<li><a href='./admin-users.php'>Felhasználók</a></li>
						<li><a href='./admin-devices.php'>Regisztrált eszközök</a></li>
					</ul>
				</li>";	}
		?>
	</ul>
	    <ul class="nav navbar-nav navbar-right">
      <li><a href="./logout.php"><span class="glyphicon glyphicon-log-out"></span>Kijelentkezés</a></li>
    </ul>
	</div>
</nav>
