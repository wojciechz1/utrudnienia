<?php
include "header.php";
include "connect.php"; 
$wykonano="";

if(isset($_SESSION['uzytkownik']))
{
	$login=$_SESSION['uzytkownik'];
	//pobranie wszystkich linii
	$zapytanie_linie="SELECT * FROM linie";
	$wynik_linie=$conn->query($zapytanie_linie);
	//jeśli formularz został przesłany dokonaj aktualizacji
	if(isset($_POST['submit']) AND $_POST['submit']=="zaktualizuj")
	{
		$zapytanie_uzytkownik="SELECT * FROM uzytkownicy WHERE login='$login'";
		$wynik_uzytkownik=$conn->query($zapytanie_uzytkownik);
		$rekord_uzytkownik=$wynik_uzytkownik->fetch_assoc();
		$id_uzytkownika=$rekord_uzytkownik['id_uzytkownika'];
		//usuń stare linie
		$zapytanie_usun="DELETE FROM ulubione WHERE id_uzytkownika='$id_uzytkownika'";
		if(!$conn->query($zapytanie_usun))
			echo "Błąd bazy danych";
		//dodaj nowe linie	
		while ($rekord_linie=$wynik_linie->fetch_assoc())
		{
			$id_linii=$rekord_linie['id_linii'];
			if (isset($_POST[$id_linii]))
			{
				$zapytanie_dodaj="INSERT INTO ulubione (id_uzytkownika,id_linii) VALUES ('$id_uzytkownika','$id_linii')";
				if(!$conn->query($zapytanie_dodaj))
					echo "Błąd bazy danych";
			}
		}
		$wynik_linie->close();
		$wykonano="Lista ulubionych została zaktualizowana";
	}
	$ulubione=array();
	//pobranie ulubionych użytkownika
	$zapytanie_ulubione="SELECT u.login,ul.id_linii FROM uzytkownicy u JOIN ulubione ul ON u.id_uzytkownika=ul.id_uzytkownika WHERE u.login='$login'";
	$wynik_ulubione=$conn->query($zapytanie_ulubione);
	while ($rekord=$wynik_ulubione->fetch_assoc())
	{
		array_push($ulubione, $rekord['id_linii']);
	}
	$wynik_ulubione->close();
?>
	<div class="container">	
		<div class="col-lg-4 col-lg-offset-4">
			<font color="green"><?php echo $wykonano; ?></font>
			<form role="form" action="favorites.php" method="post">
<?php
	$wynik_linie=$conn->query($zapytanie_linie);
	while ($rekord_linie=$wynik_linie->fetch_assoc())
	{
		if(in_array($rekord_linie['id_linii'],$ulubione))
			echo '<div class="checkbox"><label><input type="checkbox" checked="checked" name="'.$rekord_linie['id_linii'].'" value="">'.$rekord_linie['nr_linii'].' '.$rekord_linie['relacja'].'</label></div>';
		else
			echo '<div class="checkbox"><label><input type="checkbox" name="'.$rekord_linie['id_linii'].'" value="">'.$rekord_linie['nr_linii'].' '.$rekord_linie['relacja'].'</label></div>';
	}
	$wynik_linie->close();	
	$conn->close();
?>
				<button type="submit" name="submit" class="btn btn-default" value="zaktualizuj">Zapisz</button> &nbsp;
			</form>	
		</div>
	</div>


<?php
}
else
	header("Location: index.php");
include "footer.php";
?>