<?php

session_start();
// Verifica se è stata inviata una richiesta GET con l'ID dell'auto
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $auto_id = $_GET['id'];
    $username = $_SESSION['username'] ?? ''; // Recupera l'username dell'utente corrente

    // Connessione al database
    require "tswdb.php";
    $db = pg_connect($connection_string);
    if (!$db) {
        error_log("Errore di connessione al database: " . pg_last_error()); // Registra l'errore in un log
        echo "Errore di connessione al database."; // Mostra un messaggio generico all'utente
        exit;
    }
    
    // Query per eliminare l'auto dal garage dell'utente corrente
    $query = "DELETE FROM garage_auto WHERE auto_id = $1 AND garage_id IN (SELECT id FROM garage WHERE username = $2)";
    $result = pg_query_params($db, $query, array($auto_id, $username));

    // Verifica se l'eliminazione è avvenuta con successo
    if ($result) {
        // Redirect alla pagina del garage o alla pagina principale
        header("Location: reserved.php"); // Modifica "garage.php" con l'URL della tua pagina del garage
        exit();
    } else {
        // Gestisci eventuali errori durante l'eliminazione dell'auto
        echo "Si è verificato un errore durante l'eliminazione dell'auto.";
    }

    // Chiudi la connessione al database
    pg_close($db);
} else {
    // Gestisci il caso in cui l'ID dell'auto non sia stato fornito o non sia valido
    echo "ID auto non valido.";
}
?>
