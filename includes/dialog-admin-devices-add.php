<?php
	//MAC lekérdezése
	$arp="arp -a ".$_SERVER['REMOTE_ADDR']." | grep -o -E '([[:xdigit:]]{1,2}:){5}[[:xdigit:]]{1,2}'";
	$mac=exec($arp);
?>

<div id="add" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Eszköz hozzáadása</h4>
		</div>
		<div class="modal-body">					
			<form method="post" action="#">				
				<div class="form-group">
					<label for="usr">Név:</label>
					<input type="text" name="name" class="form-control"  pattern=".{5,}" title="Legalább 5 karakter szükséges!">
				</div>
				<div class="form-group">
					<label for="usr">MAC Cím:</label>
					<input type="text" name="mac" class="form-control" value=<?php print $mac; ?> pattern="([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})" title="Érvénytelen MAC cím!">
				</div>
				<div class="form-group">
					<label for="usr">IP Cím:</label>
					<input type="text" name="ip" class="form-control" value=<?php print FirstIP(); ?> pattern="(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])" title="Érvénytelen IP cím!">
				</div>
				<div class="form-group">
					<label for="sel1">Felhasználó:</label>
					<select class="form-control" name="user" id="sel1">
						<?php 
							$usr[] = ListAllUser("rname asc");
							foreach ($usr[0] as $item)	{
								print 	"<option value='".$item->id."'>".$item->rname."</option>";
							}						
						?>
					</select>
				</div>		
				<button type="submit" name="action" value="add" class="btn">Hozzáadás</button>	
			</form>
		</div>
		<div class="modal-footer">
		<button type="button" type="submit" class="btn btn-default" data-dismiss="modal">Bezárás</button>
	  </div>
	</div>
  </div>  
</div>	