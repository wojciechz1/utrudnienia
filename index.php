<?php 
include "header.php";
include "connect.php"
?>
<div class="container">
	
<?php 
//komunikaty nie dotyczą konkretnej linii
$zapytanie_komunikaty="SELECT * FROM komunikaty k 
					   JOIN rodzaje_utrudnien r ON k.rodzaj_utrudnienia=r.rodzaj_utrudnienia 
					   WHERE id_linii=0 ORDER BY data desc ";
$wynik_komunikaty=$conn->query($zapytanie_komunikaty);
while ($rekord_komunikaty=$wynik_komunikaty->fetch_assoc())
	echo '<div class="col-lg-12">
			<p class="naglowek">'.$rekord_komunikaty['nr_pociagu'].' '.$rekord_komunikaty['nazwa'].'</p>
			<p>'.$rekord_komunikaty['tresc_komunikatu'].'</p>
			<p class="data">'.$rekord_komunikaty['data'].'</p>
		 </div>';								
$wynik_komunikaty->close();	

if(isset($_SESSION['uzytkownik'])) //użytkownik zalogowany
{
	$login=$_SESSION['uzytkownik'];
	$zapytanie_zalogowany="SELECT * FROM komunikaty k 
						   JOIN linie l ON k.id_linii=l.id_linii 
						   JOIN rodzaje_utrudnien r ON k.rodzaj_utrudnienia=r.rodzaj_utrudnienia 
						   JOIN ulubione ul ON ul.id_linii=l.id_linii 
						   JOIN uzytkownicy u ON u.id_uzytkownika=ul.id_uzytkownika 
						   WHERE login='$login' 
						   ORDER BY data desc
						   LIMIT 20";
	$wynik_zalogowany=$conn->query($zapytanie_zalogowany);
	if ($wynik_zalogowany->num_rows<1)
		echo '<div class="col-lg-12"><p class="naglowek">Brak wpisów</p></div>';
	while ($rekord_zalogowany=$wynik_zalogowany->fetch_assoc())
		echo '<div class="col-lg-12">
				<p class="naglowek">'.$rekord_zalogowany['nr_pociagu'].' '.$rekord_zalogowany['nazwa'].' (Linia: '.$rekord_zalogowany['nr_linii'].')</p>
				<p>'.$rekord_zalogowany['tresc_komunikatu'].'</p>
				<p class="data">'.$rekord_zalogowany['data'].'</p>
			 </div>';								
	$wynik_zalogowany->close();	
}

else //użytkownik niezalogowany
{
	$zapytanie_niezalogowany="SELECT * FROM komunikaty k 
							  JOIN linie l ON k.id_linii=l.id_linii 
							  JOIN rodzaje_utrudnien r ON k.rodzaj_utrudnienia=r.rodzaj_utrudnienia 
							  ORDER BY data desc
							  LIMIT 20";
	$wynik_niezalogowany=$conn->query($zapytanie_niezalogowany);
	if ($wynik_niezalogowany->num_rows<1)
		echo '<div class="col-lg-12"><p class="naglowek">Brak wpisów</p></div>';
	while ($rekord_niezalogowany=$wynik_niezalogowany->fetch_assoc())
		echo '<div class="col-lg-12">
				<p class="naglowek">'.$rekord_niezalogowany['nr_pociagu'].' '.$rekord_niezalogowany['nazwa'].' (Linia: '.$rekord_niezalogowany['nr_linii'].')</p>
				<p>'.$rekord_niezalogowany['tresc_komunikatu'].'</p>
				<p class="data">'.$rekord_niezalogowany['data'].'</p>
			 </div>';								
	$wynik_niezalogowany->close();	
} ?>
</div>
	
<?php 
include "footer.php";
?>	
