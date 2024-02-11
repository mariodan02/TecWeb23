<html>
	<head>
	<title>WikiCar Vintage</title>
  	<meta name="author" content="TSW23_09"/>
  	<meta name="description" content="Archivio auto d'epoca"/>
  	<meta charset = "utf-8"/>
  	<link rel="icon" href="wikicar-logo.png" >
    <link rel="stylesheet" href="homepage-style.css"> 
  	<link rel="stylesheet" href="headerstyle.css"> 
	</head>
	<header style="background-color:white;">
		<?php
				include 'header.php';
		?>
	</header>
	<body>

<?php

// Verifica se l'utente è loggato
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    die("Accesso non autorizzato.");
}

// Verifichiamo che esista un ID per l'utente
if (!isset($_SESSION['username'])) {
    die("ID utente non trovato nella sessione.");
}
$userId = $_SESSION['username'];

$targetDir = "uploads/"; // Directory dove verranno caricati i file
$targetFile = $targetDir . basename($_FILES["profilePic"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

// Verifica se il file caricato è un'immagine effettiva
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["profilePic"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "<br><br><br><br><br><br><br><br><br><br><br><br><center><p>Il file caricato non é un'immagine.</p></center>";
        $uploadOk = 0;
    }
}

// Verifica la dimensione del file
if ($_FILES["profilePic"]["size"] > 500000) { // 500KB, modifica se necessario
    echo "<br><br><br><br><br><br><br><br><br><br><br><br><center><p>Spiacente, il tuo file é troppo grande.</p></center>";
    $uploadOk = 0;
}

// Permetti solo alcuni formati di file
if($imageFileType != "png") {
    echo "<br><br><br><br><br><br><br><br><br><br><br><br><center><p>Spiacente, sono permessi solo file PNG.</p></center>";
    $uploadOk = 0;
}


// Verifica se $uploadOk è impostato su 0 da un errore
if ($uploadOk == 0) {
    echo "<center><p>Il tuo file non é stato caricato, riprova.</p></center>";
// se tutto è ok, prova a caricare il file
}
else {
    // Imposta il nuovo nome del file utilizzando l'username della sessione e l'estensione originale del file.
    $fileExtension = pathinfo($_FILES["profilePic"]["name"], PATHINFO_EXTENSION);
    $targetFile = "uploads/" . $_SESSION['username'] . "." . $fileExtension;

    // Sposta il file caricato nella cartella di destinazione con il nuovo nome.
    if (move_uploaded_file($_FILES["profilePic"]["tmp_name"], $targetFile)) {
        echo "<br><br><br><br><br><br><br><br><br><br><br><br><center><p style class='beige-text'>La tua foto profilo è stata caricata con successo.</p></center>";
        echo "<br><center><p><a href='homepage.php'>Torna alla homepage</a>" . "</p></center>";
        } else {
        echo "<Si è verificato un errore durante il caricamento del tuo file.";
        }
    }
    
?>

</body>
	<br><br><br><br>
	<footer style="background-color:white;">
		<?php
        	include 'footer.php';
    	?>
		</footer>
</html>
