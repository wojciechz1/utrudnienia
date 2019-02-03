<?php
include "header.php";
include "connect.php";
$aktualne_haslo_komunikat="";
$nowe_haslo_komunikat="";
$email_komunikat="";
$haslo_bez_zmian="";
$wykonano="";

if (isset($_SESSION['uzytkownik']))
{
	$login=$_SESSION['uzytkownik'];
	$zapytanie="SELECT * FROM uzytkownicy WHERE login='$login'";
	$wynik=$conn->query($zapytanie);
	$wiersz=$wynik->fetch_assoc();
	$haslo=$wiersz['haslo'];
	$email=$wiersz['email'];
	if(isset($_POST['submit']) AND $_POST['submit']=="zaktualizuj")
	{
		$nowe_haslo=$_POST['nowe_haslo'];
		$nowe_haslo=mysql_escape_string($nowe_haslo);
		$powtorz_haslo=$_POST['powtorz_haslo'];
		$nowy_email=$_POST['nowy_email'];
		$aktualne_haslo=$_POST['aktualne_haslo'];
		$aktualne_haslo=mysql_escape_string($aktualne_haslo);
		if ($nowe_haslo=="")
			$haslo_bez_zmian=true;
		else if (strlen($nowe_haslo)<5 OR strlen($nowe_haslo)>30)
			$nowe_haslo_komunikat="Hasło powinno mieć od 5 do 30 znaków";
		if ($nowe_haslo!=$powtorz_haslo)
			$nowe_haslo_komunikat="Wprowadzone hasła nie są identyczne";
		if ($nowy_email=="")
			$email_komunikat="Błędny email";
		else
			$email=$nowy_email;
		if ($aktualne_haslo!=$haslo)
			$aktualne_haslo_komunikat="Wprowadzono błędne hasło!";
		
		if ($aktualne_haslo_komunikat=="" AND $nowe_haslo_komunikat=="" AND $email_komunikat=="")
		{
			if ($haslo_bez_zmian==true)
				$nowe_haslo=$aktualne_haslo;
			$zapytanie="UPDATE uzytkownicy SET haslo='$nowe_haslo',email='$nowy_email' WHERE login='$login'";
			if ($conn->query($zapytanie) === TRUE)
				$wykonano="Dane zaktualizowane pomyślnie";
			else 
				echo "Wystąpił błąd";
			
		}
	}	?>
	<div class="container">	
		<div class="col-lg-4 col-lg-offset-4">
			<font color="green"><?php echo $wykonano; ?></font>
			<form role="form" action="my_account.php" method="post">
				<div class="form-group">
					<label for="login">Login:</label>
					<input type="text" class="form-control" name="login" disabled="disabled" value="<?php echo $login; ?>">
				</div>
				<div class="form-group">
					<label for="nowy_email">Adres e-mail:</label>
					<input type="email" class="form-control" name="nowy_email" value="<?php echo $email; ?>"> <font color="red"><?php echo $email_komunikat; ?></font>
				</div>				
				<div class="form-group">
					<label for="nowe_haslo">Nowe hasło:</label>
					<input type="password" class="form-control" name="nowe_haslo"> <font color="red"><?php echo $nowe_haslo_komunikat; ?></font>
				</div>	
				<div class="form-group">
					<label for="powtorz_haslo">Powtórz hasło:</label>
					<input type="password" class="form-control" name="powtorz_haslo">
				</div>
				<div class="form-group">
					<label for="aktualne_haslo">W celu potwierdzenia zmian podaj aktualne hasło:</label>
					<input type="password" class="form-control" name="aktualne_haslo"> <font color="red"><?php echo $aktualne_haslo_komunikat; ?></font>
				</div>					
				<button type="submit" name="submit" class="btn btn-default" value="zaktualizuj">Zaktualizuj</button> &nbsp;
				<button type="reset" class="btn btn-default">Wyczyść</button>
			</form>	
		</div>
	</div>
	
<?php }
else
{
	header("Location: index.php");
}

include "footer.php";
?>