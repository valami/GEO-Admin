<div id="mod" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Felhasználó modosítása</h4>
		</div>
		<div class="modal-body">					
			<form method="post" action="#">	
				<div class="form-group">
					<label for="usr">Felhasználónév:</label>
					<input type="text" name="uname" class="form-control"  required="required"  value=<?php print $SelectedUser->uname; ?> pattern=".{5,}" title="Legalább 5 karakter szükséges!">
				</div>				
				<div class="form-group">
					<label for="passwd">Jelszó:</label>
					<input type="password" name="passwd" class="form-control">
				</div>
				<div class="form-group">
					<label for="usr">Valódi Név:</label>
					<input type="text" name="rname"  class="form-control" required="required" value=<?php print "'".$SelectedUser->rname."'"; ?> >
				</div>				
				<div class="form-group">
					<label for="usr">Email cím:</label>
					<input type="text" name="email" value=<?php print $SelectedUser->email; ?> class="form-control" >
				</div>				
				<div class="form-group">
					<label for="sel1">Jogosultság:</label>
					<select class="form-control"  name="permission" id="sel1">
						<option value="0" <?php if ($SelectedUser->permission==0){print "selected='selected'";} ?> >Zárolt</option>
						<option value="2" <?php if ($SelectedUser->permission==2){print "selected='selected'";} ?> >Felhasználó</option>						
						<option value="5" <?php if ($SelectedUser->permission==5){print "selected='selected'";} ?> >Szuper Felhasználó</option>
						<option value="9" <?php if ($SelectedUser->permission==9){print "selected='selected'";} ?> >Rendszergazda</option>
					</select>
				</div>		
				<button type="submit" name="action" value="mod" class="btn">Modosítás</button>
				<input type="hidden" name="id" value=<?php print $SelectedUser->id; ?> >
			</form>
		</div>
		<div class="modal-footer">
		<button type="button" type="submit" class="btn btn-default" data-dismiss="modal">Bezárás</button>
	  </div>
	</div>
  </div>  
</div>	
