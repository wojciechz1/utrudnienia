<?php
include "header.php";
include "connect.php";
$login_komunikat="";
$haslo_komunikat="";
$email_komunikat="";
if (isset($_POST['submit']) AND $_POST['submit']=="zarejestruj")
{
	$login=$_POST['login'];
	$haslo=$_POST['haslo'];
	$powtorz_haslo=$_POST['powtorz_haslo'];
	$email=$_POST['email'];
	if (!preg_match('@^[a-zA-z0-9_]{3,50}$@',$login))
		$login_komunikat="Login powinien składać się z 3-50 znaków. Dozwolone są małe i duże litery, cyfry oraz znak podkreślenia";
	else
	{		
		$zapytanie="SELECT * FROM uzytkownicy WHERE login='$login'";
		$wynik=$conn->query($zapytanie);
		if ($wynik->num_rows!=0)
			$login_komunikat="Wybrany login jest już zajęty";
	}
	if (strlen($haslo)<5 OR strlen($haslo)>30)
		$haslo_komunikat="Hasło powinno mieć od 5 do 30 znaków";
	if ($haslo!=$powtorz_haslo)
		$haslo_komunikat="Wprowadzone hasła nie są identyczne";
	if ($email=="")
		$email_komunikat="Wprowadź adres email";
		
	if ($login_komunikat=="" AND $haslo_komunikat=="" AND $email_komunikat=="")
	{
		$haslo=mysql_escape_string($haslo);
		$zapytanie="INSERT INTO uzytkownicy (login,haslo,email) VALUES ('$login', '$haslo', '$email')";
		if ($conn->query($zapytanie) === TRUE)
			echo '<div class="container"> <div class="col-lg-12"><h2>Twoje konto zostało utworzone. Możesz się zalogować!</h2></div></div>';
		else 
			echo "Wystąpił błąd";
	}
	else 
	{ ?>		
		<div class="container">	
			<div class="col-lg-4 col-lg-offset-4 ">
				<form role="form" action="register.php" method="post">
					<div class="form-group">
						<label for="login">Login:</label>
						<input type="text" class="form-control" name="login"> <font color="red"><?php echo $login_komunikat; ?></font>
					</div>				
					<div class="form-group">
						<label for="haslo">Hasło:</label>
						<input type="password" class="form-control" name="haslo"> <font color="red"><?php echo $haslo_komunikat; ?></font>
					</div>	
					<div class="form-group">
						<label for="powtorz_haslo">Powtórz hasło:</label>
						<input type="password" class="form-control" name="powtorz_haslo">
					</div>
					<div class="form-group">
						<label for="email">Adres e-mail:</label>
						<input type="email" class="form-control" name="email"> <font color="red"><?php echo $email_komunikat; ?></font>
					</div>
					<button type="submit" name="submit" class="btn btn-default" value="zarejestruj">Zarejestruj</button> &nbsp;
					<button type="reset" class="btn btn-default">Wyczyść</button>
				</form>			
			</div>
		</div>
	
<?php
	}
}
else
{ ?>
	<div class="container">	
		<div class="col-lg-4 col-lg-offset-4 ">
			<form role="form" action="register.php" method="post">
				<div class="form-group">
					<label for="login">Login:</label>
					<input type="text" class="form-control" name="login">
				</div>				
				<div class="form-group">
					<label for="haslo">Hasło:</label>
					<input type="password" class="form-control" name="haslo">
				</div>	
				<div class="form-group">
					<label for="powtorz_haslo">Powtórz hasło:</label>
					<input type="password" class="form-control" name="powtorz_haslo">
				</div>
				<div class="form-group">
					<label for="email">Adres e-mail:</label>
					<input type="email" class="form-control" name="email">
				</div>
				<button type="submit" name="submit" class="btn btn-default" value="zarejestruj">Zarejestruj</button> &nbsp;
				<button type="reset" class="btn btn-default">Wyczyść</button>
			</form>			
		</div>
	</div>
<?php
}
include "footer.php";
?>