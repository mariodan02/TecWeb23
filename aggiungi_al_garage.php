<?php
session_start();
require "tswdb.php";

$username = $_SESSION['username']; // L'username è impostato durante il login
$autoId = $_POST['idAuto'];

try {
    // Connessione al database
    $db = pg_connect($connection_string) or die('Impossibile connettersi al database: ' . pg_last_error());

    // Recuperiamo l'ID del garage basato sull'username
    $garageResult = pg_query_params($db, "SELECT id FROM garage WHERE username = $1", array($username));
    if (!$garageResult || pg_num_rows($garageResult) == 0) {
        echo "error: Garage non trovato per l'utente.";
        pg_close($db);
        exit;
    }
    $garageRow = pg_fetch_assoc($garageResult);
    $garageId = $garageRow['id'];  /*colonna di garage contenente id*/

    // Verifichiamo che l'auto non sia già nel garage
    $result = pg_query_params($db, "SELECT * FROM garage_auto WHERE auto_id = $1 AND garage_id = $2", array($autoId, $garageId));
    if (!$result) {
        // Gestiamo correttamente l'errore della query.
        echo "error: Errore nell'esecuzione della query: " . pg_last_error($db);
        pg_close($db);
        exit;
    }
    
    if (pg_num_rows($result) > 0) {
        echo "error: l'auto è già presente nel garage";
    } else {
        // Inseriamo l'auto nel garage
        $insertResult = pg_query_params($db, "INSERT INTO garage_auto (auto_id, garage_id) VALUES ($1, $2)", array($autoId, $garageId));
        if ($insertResult) {
            echo "success";
        } else {
            echo "error: problema nell'inserimento nel database: " . pg_last_error($db);
        }
    }
} finally {
    // Chiudiamo la connessione al database alla fine del blocco try
    if (isset($db) && $db) {
        pg_close($db);
    }
}
?>
