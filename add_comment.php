<?php
include "header.php";
include "connect.php"; 
$wykonano="";
$nr_pociagu_komunikat="";
$tresc_komentarza_komunikat="";
if(isset($_SESSION['uzytkownik']))
{
	if(isset($_POST['submit']) AND $_POST['submit']=="dodaj")
	{
		$id_linii=$_POST['id_linii'];
		$tresc_komentarza=$_POST['tresc_komentarza'];
		
		if(strlen($tresc_komentarza)<1 OR strlen($tresc_komentarza)>1000)
			$tresc_komentarza_komunikat="Komentarz nie może być pusty ani dłuższy niż 1000 znaków";
		else
			$tresc_komentarza=mysql_escape_string($tresc_komentarza);
		
		if ($tresc_komentarza_komunikat=="")
		{			
			$login=$_SESSION['uzytkownik'];
			$zapytanie_uzytkownik="SELECT * FROM uzytkownicy WHERE login='$login'";
			$wynik_uzytkownik=$conn->query($zapytanie_uzytkownik);
			$rekord_uzytkownik=$wynik_uzytkownik->fetch_assoc();
			$id_uzytkownika=$rekord_uzytkownik['id_uzytkownika'];
			$data=date("Y-m-d, H:i:s");
			
			$zapytanie_dodaj="INSERT INTO komentarze (id_uzytkownika,id_linii,tresc_komentarza,data) VALUES ('$id_uzytkownika', '$id_linii', '$tresc_komentarza', '$data')";
			if ($conn->query($zapytanie_dodaj) === TRUE)
				$wykonano="Komentarz został dodany pomyślnie";
			else 
				echo "Wystąpił błąd".$conn->error;			
		}
	}
?>
		<div class="container">	
			<div class="col-lg-4 col-lg-offset-4 ">
				<font color="green"><?php echo $wykonano; ?></font>
				<form role="form" action="add_comment.php" method="post">			
					<div class="form-group">
						<label for="id_linii">Nr linii:</label>
						<select class="form-control" name="id_linii">
							<?php
								$zapytanie_linie="SELECT * FROM linie";
								$wynik_linie=$conn->query($zapytanie_linie);
								while ($rekord_linie=$wynik_linie->fetch_assoc())
									echo '<option value="'.$rekord_linie['id_linii'].'">'.$rekord_linie['nr_linii'].' '.$rekord_linie['relacja'].'</option>';									
								$wynik_linie->close();
							?>
						</select>
					</div>	
					<div class="form-group">
						<label for="tresc_komentarza">Treść komentarza:</label>
						<textarea class="form-control" rows="5" name="tresc_komentarza"></textarea> <font color="red"><?php echo $tresc_komentarza_komunikat; ?></font>
					</div>
					<button type="submit" name="submit" class="btn btn-default" value="dodaj">Dodaj</button> &nbsp;
					<button type="reset" class="btn btn-default">Wyczyść</button>
				</form>			
			</div>
		</div>
<?php
}
else
	header("Location: comments.php");
include "footer.php";
?>