<div id="mod" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Eszköz modosítása</h4>
		</div>
		<div class="modal-body">					
			<form method="post" action="#">				
				<div class="form-group">
					<label for="usr">Név:</label>
					<input type="text" name="name" class="form-control" value=<?php print $SelectedDevice->name; ?> >
				</div>
				<div class="form-group">
					<label for="usr">MAC Cím:</label>
					<input type="text" class="form-control" value=<?php print $SelectedDevice->mac; ?> readonly>
				</div>
				<div class="form-group">
					<label for="usr">IP Cím:</label>
					<input type="text" class="form-control" value=<?php print $SelectedDevice->ip; ?> readonly>
				</div>
				<input type="hidden" name="id" value=<?php print $SelectedDevice->id; ?> >
				<button type="submit" name="action" value="mod" class="btn">Modosítás</button>					
			</form>
		</div>
		<div class="modal-footer">
		<button type="button" type="submit" class="btn btn-default" data-dismiss="modal">Bezárás</button>
	  </div>
	</div>
  </div>  
</div>	