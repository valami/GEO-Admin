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
				<button type="submit" name="action" value="add" class="btn">Hozzáadás</button>	
			</form>
		</div>
		<div class="modal-footer">
		<button type="button" type="submit" class="btn btn-default" data-dismiss="modal">Bezárás</button>
	  </div>
	</div>
  </div>  
</div>	