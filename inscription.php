<form action="include/inscription.php" method="post">
		  <p>
			Nom :<br /><input type="text" name="nom" maxlength="50" class="inputConn"><br /><br />
			Prenom :<br /><input type="text" name="prenom" maxlength="50" class="inputConn"><br /><br />
			Pseudo :<br /><input type="text" name="pseudo" maxlength="50" class="inputConn"><br /><br />
			email :<br /><input type="email" name="email" maxlength="50" class="inputConn"><br /><br />
			mot de passe :<br /><input type="password" name="pass1" maxlength="50" class="inputConn"><br /><br />
			Confirmation mot de passe :<br /><input type="password" name="pass2" maxlength="50" class="inputConn"><br /><br />
			Adresse :<br /><input type="text" name="adresse" maxlength="50" class="inputConn"><br /><br />
			Code Postal :<br /><input type="text" name="codePostal" maxlength="50" class="inputConn"><br /><br />
			Ville :<br /><input type="text" name="ville" maxlength="50" class="inputConn"><br /><br />
			Numéro de téléphone :<br /><input type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" name="numDetel" maxlength="50" class="inputConn"><br /><br />
			<input type="submit" value="inscription" name="inscription" class="submit">
		  </p>
		</form>	