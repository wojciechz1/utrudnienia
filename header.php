<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Utrudnienia w ruchu pociągów</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/custom.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<?php
session_start();
$aktualna=$_SERVER['SCRIPT_NAME']; 
?>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				<a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-home"></span> Komunikaty</a>
            </div>
            <!-- uzytkownik zalogowany -->
			<?php
			if (isset($_SESSION['uzytkownik'])) { ?>
			<div id="navbar" class="collapse navbar-collapse">				
                <ul class="nav navbar-nav">														
					<li <?php if ($aktualna=="/utrudnienia/comments.php" OR $aktualna=="/utrudnienia/add_comment.php") echo 'class="active"'?>><a href="comments.php">Komentarze</a></li>					
					<li <?php if ($aktualna=="/utrudnienia/my_account.php") echo 'class="active"'?>><a href="my_account.php">Moje konto</a></li>
					<li <?php if ($aktualna=="/utrudnienia/favorites.php") echo 'class="active"'?>><a href="favorites.php">Ulubione linie</a></li>
					<?php if (isset($_SESSION['administrator']) AND $_SESSION['administrator']==1) {
								if ($aktualna=="/utrudnienia/add_information.php") 
									echo '<li class="active"><a href="add_information.php">Dodaj komunikat</a></li>';
								else
									echo '<li><a href="add_information.php">Dodaj komunikat</a></li>';
									} ?>
					<li <?php if ($aktualna=="/utrudnienia/contact.php") echo 'class="active"'?>><a href="contact.php">Kontakt</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right" >
					<li><a href="my_account.php"><b><?php echo $_SESSION['uzytkownik']; ?></b></a></li>
					<li><a href="logout.php">Wyloguj</a></li>
				</ul>
            </div>					
            <!-- /.navbar-collapse -->	
			<!-- /uzytkownik zalogowany -->
			
			<?php }
			else { ?>
			<!-- uzytkownik niezalogowany -->
            <div id="navbar" class="collapse navbar-collapse">				
                <ul class="nav navbar-nav">					
					<li <?php if ($aktualna=="/utrudnienia/comments.php" OR $aktualna=="/utrudnienia/add_comment.php") echo 'class="active"'?>><a href="comments.php">Komentarze</a></li>						
					<li <?php if ($aktualna=="/utrudnienia/register.php") echo 'class="active"'?>><a href="register.php">Zarejestruj</a></li>
					<li <?php if ($aktualna=="/utrudnienia/contact.php") echo 'class="active"'?>><a href="contact.php">Kontakt</a></li>
				</ul>
				<form class="navbar-form navbar-right" action="login.php" method="post">
					<div class="form-group">
						<input type="text" class="form-control" name="login" placeholder="Login">
						<input type="password" class="form-control" name="haslo" placeholder="Hasło">
					</div>
					<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-log-in"></span></button>
				</form>
            </div>				
            <!-- /.navbar-collapse -->
			<?php } ?>
			<!-- /uzytkownik niezalogowany -->					
        </div>
        <!-- /.container -->
    </nav>