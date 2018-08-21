<div id="add" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Felhasználó hozzáadása</h4>
		</div>
		<div class="modal-body">					
			<form method="post" action="#">				
				<div class="form-group">
					<label for="usr">Felhasználónév:</label>
					<input type="text" name="uname" class="form-control"  required="required"  pattern=".{5,}" title="Legalább 5 karakter szükséges!">
				</div>				
				<div class="form-group">
					<label for="usr">Jelszó:</label>
					<input type="password" name="passwd" class="form-control"  required="required">
				</div>
				<div class="form-group">
					<label for="usr">Valódi Név:</label>
					<input type="text" name="rname" class="form-control"  required="required" >
				</div>				
				<div class="form-group">
					<label for="usr">Email cím:</label>
					<input type="text" name="email" class="form-control" >
				</div>				
				<div class="form-group">
					<label for="sel1">Jogosultság:</label>
					<select class="form-control" name="permission" id="sel1">
						<option value="0">Zárolt</option>
						<option value="2">Felhasználó</option>						
						<option value="5">Szuper Felhasználó</option>
						<option value="9">Rendszergazda</option>
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