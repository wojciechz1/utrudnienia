<?php
include "header.php";
include "connect.php"; 
$wykonano="";
$nr_pociagu_komunikat="";
$tresc_komunikatu_komunikat="";
if(isset($_SESSION['administrator']) AND $_SESSION['administrator']==1)
{
	if(isset($_POST['submit']) AND $_POST['submit']=="dodaj")
	{
		$nr_pociagu=$_POST['nr_pociagu'];
		$id_linii=$_POST['id_linii'];
		$rodzaj_utrudnien=$_POST['rodzaj_utrudnien'];
		$tresc_komunikatu=$_POST['tresc_komunikatu'];
		
		if(strlen($nr_pociagu)>50)
			$nr_pociagu_komunikat="Pole nr pociągu może zawierać maksymalnie 50 znaków";
		else	
			$nr_pociagu=mysql_escape_string($nr_pociagu);
			
		if(strlen($tresc_komunikatu)<1 OR strlen($tresc_komunikatu)>2000)
			$tresc_komunikatu_komunikat="Komunikat nie może być pusty ani dłuższy niż 2000 znaków";
		else
			$tresc_komunikatu=mysql_escape_string($tresc_komunikatu);
		
		if ($nr_pociagu_komunikat=="" AND $tresc_komunikatu_komunikat=="")
		{
			$data=date("Y-m-d, H:i:s");
			$zapytanie="INSERT INTO komunikaty (id_linii,nr_pociagu,rodzaj_utrudnienia,tresc_komunikatu,data) VALUES ('$id_linii', '$nr_pociagu', '$rodzaj_utrudnien', '$tresc_komunikatu', '$data')";
			if ($conn->query($zapytanie) === TRUE)
				$wykonano="Komunikat został dodany pomyślnie";
			else 
				echo "Wystąpił błąd";			
		}
	}
?>
		<div class="container">	
			<div class="col-lg-4 col-lg-offset-4 ">
				<font color="green"><?php echo $wykonano; ?></font>
				<form role="form" action="add_information.php" method="post">
					<div class="form-group">
						<label for="nr_pociagu">Nr pociągu:</label>
						<input type="text" class="form-control" name="nr_pociagu"> <font color="red"><?php echo $nr_pociagu_komunikat; ?></font>
					</div>				
					<div class="form-group">
						<label for="id_linii">Nr linii:</label>
						<select class="form-control" name="id_linii">
							<option>Wszystkie</option>
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
						<label for="rodzaj_utrudnien">Rodzaj utrudnień:</label>
						<select class="form-control" name="rodzaj_utrudnien">
							<?php
								$zapytanie_rodzaje_utrudnien="SELECT * FROM rodzaje_utrudnien";
								$wynik_rodzaje_utrudnien=$conn->query($zapytanie_rodzaje_utrudnien);
								while ($rekord_rodzaje_utrudnien=$wynik_rodzaje_utrudnien->fetch_assoc())
									echo '<option value="'.$rekord_rodzaje_utrudnien['rodzaj_utrudnienia'].'">'.$rekord_rodzaje_utrudnien['nazwa'].'</option>';									
								$wynik_rodzaje_utrudnien->close();
							?>
						</select>
					</div>	
					<div class="form-group">
						<label for="tresc_komunikatu">Treść komunikatu:</label>
						<textarea class="form-control" rows="5" name="tresc_komunikatu"></textarea> <font color="red"><?php echo $tresc_komunikatu_komunikat; ?></font>
					</div>
					<button type="submit" name="submit" class="btn btn-default" value="dodaj">Dodaj</button> &nbsp;
					<button type="reset" class="btn btn-default">Wyczyść</button>
				</form>			
			</div>
		</div>
<?php
}
else
	header("Location: index.php");
include "footer.php";
?>