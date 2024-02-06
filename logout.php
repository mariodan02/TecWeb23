<html>
	<head>
		<title>WikiCar Vintage Logout</title>
  	<meta name="author" content="TSW23_09"/>
  	<meta name="description" content="Archivio di auto d'epoca"/>
  	<meta charset = "utf-8"/>
  	<link rel="icon" href="wikicar-logo.png" >
	  <link rel="stylesheet" href="homepage-style.css">
	</head>
	<header style="background-color:white;">
		<?php
				include 'header.php';
		?>
	</header>
	<body>
		<?php
			/* distrugge la sessione attiva */
			$sname=session_name();
			session_destroy();
			/* ed elimina il cookie corrispondente */
			if (isset($_COOKIE[session_name()])) {
				setcookie($sname,'', time()-3600,'/');
			}
			echo "<br><br><center><p>Logout effettuato. Ciao ".$_SESSION["username"]." </p>";
			echo "<br><center><p>Torna alla <a href=\"hometab.php\">Home</a></p>";
			?>
	</body>
	<br><br><br><br>
	<footer style="background-color:white;">
		<?php
      include 'footer.php';
    ?>
	</footer>
</html>