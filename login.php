<?php
include "header.php";
include "connect.php";
if(isset($_POST['login']) AND isset($_POST['haslo']))
{
	$login=$_POST['login'];
	$haslo=$_POST['haslo'];
	$login=mysql_escape_string($login);
	$haslo=mysql_escape_string($haslo);
	$zapytanie="SELECT login,haslo,administrator FROM uzytkownicy WHERE login='$login' AND haslo='$haslo'";
	$wynik=$conn->query($zapytanie);
	if ($wynik->num_rows==1)
	{
		$_SESSION['uzytkownik']="$login";
		$rekord=$wynik->fetch_assoc();
		if ($rekord['administrator']==1)
			$_SESSION['administrator']=1;
		$wynik->close();
		$conn->close();	
		$poprzednia = $_SERVER['HTTP_REFERER'];
		$aktualna="http://".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];
		if ($aktualna==$poprzednia)
			header("Location: index.php");
		else
			header("Location: $poprzednia");
	}
	else
	{
		$wynik->close();
		$conn->close();	
		?>
		<div class="container">			
			<div class="col-lg-4 col-lg-offset-4 " style="text-align:center">
				<p class="large-title"><font color="red">Wprowadzona nazwa użytkownika i/lub hasło są niepoprawne</font></p>
				<form action="login.php" method="post">
					<div class="form-group">
						<input type="text" class="form-control" name="login" placeholder="Login"><br/>
						<input type="password" class="form-control" name="haslo" placeholder="Hasło">
					</div>
					<button type="submit" class="btn btn-default">Zaloguj</button>
				</form>
			</div>
		</div>
<?php 
	}
}
else
{ ?>
		<div class="container">
			<div class="col-lg-4 col-lg-offset-4 " style="text-align:center">			
				<form action="login.php" method="post">
					<div class="form-group">
						<input type="text" class="form-control" name="login" placeholder="Login"><br/>
						<input type="password" class="form-control" name="haslo" placeholder="Hasło">
					</div>
					<button type="submit" class="btn btn-default">Zaloguj</button>
				</form>
			</div>
		</div>	
<?php
}
include "footer.php";
?>