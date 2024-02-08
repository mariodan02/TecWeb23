<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Confronta Auto</title>
    <link rel="stylesheet" href="homepage-style.css">
    <link rel="stylesheet" href="headerstyle.css">
    <script>
        function clearCookies() {
            document.cookie.split(";").forEach(function(c) {
                var cookie = c.trim().split("=");
                if (cookie[0].indexOf('PHPSESSID') === -1) { // Escludi i cookie di sessione
                    document.cookie = cookie[0] + '=;expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
                }
            });
            window.location.reload(); // Ricarica la pagina per aggiornare lo stato
        }

        function rimuoviAuto(idAuto) {
            var confirmed = confirm("Sei sicuro di voler rimuovere questa auto?");
            if (confirmed) {
                // Invia una richiesta GET alla pagina corrente con un parametro speciale
                window.location.href = "?rimuovi=" + idAuto;
            }
        }

    </script>
</head>
<body>

<?php
    // Includi l'header del sito web
    include 'header.php';

    // Controlla se l'utente è loggato, se non è loggato reindirizza alla pagina di login
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] === false) {
        header('Location: login.php');
        exit;
    }

    
    // Verifica se è stato richiesto di rimuovere un'auto
    if (isset($_GET['rimuovi'])) {
        $idAutoDaRimuovere = intval($_GET['rimuovi']);
        $cookieName = "autoConfronto_" . $idAutoDaRimuovere;

        // Rimuovi il cookie dell'auto selezionata
        setcookie($cookieName, '', time() - 3600, '/');
        
        // Reindirizza l'utente per evitare azioni duplicate in caso di refresh della pagina
        header('Location: confronta.php');
        exit;
    }

    // Inizializza un array vuoto per raccogliere le auto selezionate
    $auto_selezionate = [];

    // Scorri tutti i cookie per trovare quelli che iniziano con 'autoConfronto_' e aggiungili all'array
    foreach ($_COOKIE as $key => $value) {
        if (strpos($key, 'autoConfronto_') === 0) {
            $auto_selezionate[] = $value;
        }
    }

    // Stabilisci una connessione al database PostgreSQL
    $dbconn = pg_connect("host=localhost dbname=gruppo09 user=www password=tw2024") 
    or die('Could not connect: ' . pg_last_error());

    // Se ci sono auto selezionate, esegui una query per recuperare i loro dettagli
    if (count($auto_selezionate) > 0) {
        // Assicurati che gli ID siano numeri interi per prevenire SQL injection
        $ids = implode(',', array_map('intval', $auto_selezionate));
        
        // Esegui la query per ottenere i dettagli delle auto selezionate
        $query = "SELECT * FROM auto WHERE id IN ($ids)";
        $result = pg_query($query) or die('Query failed: ' . pg_last_error());
        
        // Ottieni tutti i risultati della query come array associativo
        $auto_selezionate = pg_fetch_all($result);
        
        // Libera la memoria tenendo i risultati della query
        pg_free_result($result);
    }
?>

<?php if (count($auto_selezionate) > 0): ?>
    <?php foreach ($auto_selezionate as $auto): ?>
        <div class="card">
            <!-- Aggiunta dell'immagine dell'auto -->
            <img src="img/card-img/<?php echo htmlspecialchars($auto['img']) . '.jpg'; ?>" alt="Immagine di <?php echo htmlspecialchars($auto['nome']); ?>">

            <!-- Sezione delle informazioni dell'auto -->
            <div class="card-info">
                <h3><?php echo htmlspecialchars($auto['nome']); ?></h3>
                <p>Anno: <?php echo htmlspecialchars($auto['anno']); ?></p>
                <p>Prezzo: <?php echo htmlspecialchars($auto['prezzo']); ?></p>
                <!-- Meglio fare <a href> oppure fare echo '<button onclick="salvaAutoConfronto(\'' . htmlspecialchars($auto['id']) . '\')" class="btn">Confronta</button>'; ? -->
                <a href="/path/to/dettagli.php?id=<?php echo htmlspecialchars($auto['id']); ?>" class="btn">Dettagli</a>
                </div>
            </div>
    <?php endforeach; ?>
    <!-- Pulsante per azzerare i cookie -->
    <button onclick="clearCookies()" class="btn">Rimuovi tutte le auto selezionate</button>';
<?php else: ?>
    <!-- Mostra un messaggio se nessuna auto è stata selezionata -->
    <!-- Bisogna creare un container -->
    <p><br><br><br><br><br><br><br><br><br><br><br>Nessuna auto selezionata per il confronto.</p>
<?php endif; ?>


</body>
<?php 
    include 'footer.php';
?>  
</html>