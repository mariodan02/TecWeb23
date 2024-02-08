<?php
session_start();

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
        echo "Il file caricato non é un'immagine.";
        echo "<br>";
        $uploadOk = 0;
    }
}

// Verifica la dimensione del file
if ($_FILES["profilePic"]["size"] > 500000) { // 500KB, modifica se necessario
    echo "Spiacente, il tuo file è troppo grande.";
    $uploadOk = 0;
}

// Permetti solo alcuni formati di file
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif" ) {
    echo "Spiacente, sono permessi solo file JPG, PNG e GIF.";
    echo "<br>";
    $uploadOk = 0;
}


// Verifica se $uploadOk è impostato su 0 da un errore
if ($uploadOk == 0) {
    echo "Spiacente, il tuo file non è stato caricato.";
// se tutto è ok, prova a caricare il file
}
else {
    // Imposta il nuovo nome del file utilizzando l'username della sessione e l'estensione originale del file.
    $fileExtension = pathinfo($_FILES["profilePic"]["name"], PATHINFO_EXTENSION);
    $targetFile = "uploads/" . $_SESSION['username'] . "." . $fileExtension;

    // Sposta il file caricato nella cartella di destinazione con il nuovo nome.
    if (move_uploaded_file($_FILES["profilePic"]["tmp_name"], $targetFile)) {
        echo "Il file è stato caricato e rinominato in: " . htmlspecialchars($_SESSION['username'] . "." . $fileExtension);
        echo "<br><a href='homepage.php'>Torna alla homepage</a>";
        } else {
        echo "Si è verificato un errore durante il caricamento del tuo file.";
        }
    }
    
?>
