<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="homepage-style.css">
    <link rel="stylesheet" href="headerstyle.css">
    <title>WikiCar Vintage</title>
    <link rel="icon" href="img/other-img/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="img/other-img/logo.png" type="image/x-icon">
</head>

<body>
<?php include 'header.php'; ?>
<?php
require "tswdb.php"; // Assicurati che questo percorso sia corretto

// Controlla se l'ID è presente nella query string
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $autoId = $_GET['id'];

    // Connettiti al database
    $db = pg_connect($connection_string); // Aggiungi gestione degli errori se necessario
    $query = "SELECT * FROM auto WHERE id = $1";
    $result = pg_query_params($db, $query, array($autoId));

    if ($result && pg_num_rows($result) > 0) {
        $auto = pg_fetch_assoc($result);

        // Mostra i dettagli dell'auto
        echo '<div class="card">';
            
        // Aggiunta dell'immagine dell'auto
        echo '<img src="img/card-img/' . htmlspecialchars($auto['img']) . '.jpg" alt="Immagine di ' . htmlspecialchars($auto['nome']) . '">';

        // Sezione delle informazioni dell'auto
        echo '<div class="card-info">';
        echo '<h3>' . htmlspecialchars($auto['nome']) . '</h3>';
        echo '<p>Anno: ' . htmlspecialchars($auto['anno']) . '</p>';
        echo '<p>Prezzo: ' . htmlspecialchars($auto['prezzo']) . '</p>';
        echo '</div>';
    
        // Pulsante Dettagli o Confronta
        echo '<a href="homepage.php" class="btn">Torna alla homepage</a>';
        echo '</div>';
} else {
        echo '<p>Auto non trovata.</p>';
    }

    pg_close($db);
} else {
    echo '<p>ID non valido.</p>';
}
?>

</body>

</html>