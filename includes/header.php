<nav class="navbar navbar-inverse" id = "menu">
	<div class="container-fluid">
	<div class="navbar-header">
		<div class="navbar-brand">GEO K.A.P.</div>		
  	</div>
	<ul class="nav navbar-nav">
		<li <?php if ($active=="Eszkozok") {print "class='active'";}	?> ><a href="./devices.php">Eszközök</a></li>	
		<li	<?php if ($active=="ips") {print "class='active'";}	?>	><a href="./ips.php">IP Igénylés</a></li>
		<li	<?php if ($active=="users") {print "class='active'";}	?>	><a href="./users.php">Felhasználók</a></li>	
	</ul>
	    <ul class="nav navbar-nav navbar-right">
      <li><a href="./logout.php"><span class="glyphicon glyphicon-log-out"></span>Kijelentkezés</a></li>
    </ul>
	</div>
</nav>
