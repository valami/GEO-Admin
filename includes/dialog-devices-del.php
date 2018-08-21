<div id="del" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Eszköz törlése</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="#">				
					<div class="form-group">
						<label>Biztosan törölni szeretnld az alábbi eszközt?</br></label>
					</div>				
					<div class="form-group">
						<label><?php print $SelectedDevice->name; ?></label>					
					</div>				
					<div class="form-group">
						<button type="submit" name="action" value="del" class="btn btn-danger" >Törlés</button>
					</div>
					<input type="hidden" name="id" value=<?php print $SelectedDevice->id; ?> >
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" type="submit" class="btn btn-default" data-dismiss="modal">Bezárás</button>
			</div>
		</div>
	</div>  
</div>	