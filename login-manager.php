<html>
	<head>
		<title>WikiCar Vintage Login</title>
  	<meta name="author" content="TSW23_09"/>
  	<meta name="description" content="Archivio auto d'epoca"/>
  	<meta charset = "utf-8"/>
  	<link rel="icon" href="wikicar-logo.png" >
	<link rel="stylesheet" href="css/homepage-style.css">
    <link rel="stylesheet" href="css/headerstyle.css">
	</head>
	<header>
		<?php
				include 'header.php';
		?>
	</header>
	<body>
		<?php
			if (isset($_POST['username']) && isset($_POST['password'])) {
				$username =  $_POST['username'];
				$password =  $_POST['password'];
				$hash = get_pwd($username);
				if(!$hash){
					echo "<div class='container-login'><p style class=beige-text> L'utente $username non esiste. <a href=\"login.php\">Riprova</a> oppure <a href=\"registrazione.php\">registrati adesso!</a></p></div>";
				} else {
					if (password_verify($password, $hash)) {
						echo "<script type=\"text/javascript\"> alert(\"Login Eseguito con successo\");</script>";
						//Se il login è corretto, inizializziamo la sessione
						$_SESSION['logged_in'] = true;
						$_SESSION['username']=$username;
						header('Location: homepage.php'); 
					} else {
						echo '<br><br><center>Username o password errati. <a href="login.php">Riprova</a>';
					}
				}
			} else{
				echo "<br><br><center><p>ERRORE: username o password non inseriti <a href=\"login.php\">Riprova</a></p>";
				exit();
			}
		?>
	</body>
	<br><br>
	<footer style="background-color:white;">
		<?php
        	include 'footer.php';
    	?>
		</footer>
</html>

<?php
   function get_pwd($username){
   		require "tswdb.php";
   		//CONNESSIONE AL DB
		$db = pg_connect($connection_string) or die('Impossibile connetersi al database: ' . pg_last_error());
		$sql = "SELECT password FROM utenti WHERE username=$1;";
		$prep = pg_prepare($db, "sqlPassword", $sql);
		$ret = pg_execute($db, "sqlPassword", array($username));
		if(!$ret) {
			echo "ERRORE QUERY: " . pg_last_error($db);
			return false;
		}
		else{
			if ($row = pg_fetch_assoc($ret)){
				$password = $row['password'];
				return $password;
			}
			else{
				return false;
			}
   		}
   	}
?>
