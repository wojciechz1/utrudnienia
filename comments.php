<?php
include "header.php";
include "connect.php";
?>
<div class="container">

<?php 
if(isset($_SESSION['uzytkownik'])) //użytkownik zalogowany
{
	echo '<div class="col-lg-12"><a class="btn btn-default" href="add_comment.php">Dodaj komentarz</a><br/><br/></div>';
	$login=$_SESSION['uzytkownik'];
	$zapytanie_zalogowany="SELECT nr_linii, relacja, tresc_komentarza, data, u.login FROM komentarze k 
						   JOIN linie l ON k.id_linii=l.id_linii 						   
						   JOIN ulubione ul ON ul.id_linii=l.id_linii 
						   JOIN uzytkownicy u ON u.id_uzytkownika=k.id_uzytkownika 
						   WHERE ul.id_uzytkownika=(SELECT id_uzytkownika FROM uzytkownicy WHERE login='$login') 
						   ORDER BY data desc";
	$wynik_zalogowany=$conn->query($zapytanie_zalogowany);
	if ($wynik_zalogowany->num_rows<1)
		echo '<div class="col-lg-12"><p class="naglowek">Brak komentarzy</p></div>';	
	while ($rekord_zalogowany=$wynik_zalogowany->fetch_assoc())
		echo '<div class="col-lg-12">
				<p class="naglowek">Linia: '.$rekord_zalogowany['nr_linii'].' '.$rekord_zalogowany['relacja'].'</p>
				<p>'.$rekord_zalogowany['tresc_komentarza'].'</p>
				<p class="data">'.$rekord_zalogowany['data'].' - '.$rekord_zalogowany['login'].'</p>
			 </div>';								
	$wynik_zalogowany->close();	
}

else //użytkownik niezalogowany
{
	$zapytanie_niezalogowany="SELECT * FROM komentarze k 
							  JOIN linie l ON k.id_linii=l.id_linii 
							  JOIN uzytkownicy u ON u.id_uzytkownika=k.id_uzytkownika
							  ORDER BY data desc";
	$wynik_niezalogowany=$conn->query($zapytanie_niezalogowany);
	if ($wynik_niezalogowany->num_rows<1)
		echo '<div class="col-lg-12"><p class="naglowek">Brak komentarzy</p></div>';
	while ($rekord_niezalogowany=$wynik_niezalogowany->fetch_assoc())
		echo '<div class="col-lg-12">
				<p class="naglowek">Linia: '.$rekord_niezalogowany['nr_linii'].' '.$rekord_niezalogowany['relacja'].'</p>
				<p>'.$rekord_niezalogowany['tresc_komentarza'].'</p>
				<p class="data">'.$rekord_niezalogowany['data'].' - '.$rekord_niezalogowany['login'].'</p>
			 </div>';								
	$wynik_niezalogowany->close();	
} 
?>

</div>
<?php
include "footer.php";
echo 'test';
?>