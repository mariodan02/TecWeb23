<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Confronta Auto</title>
    <link rel="stylesheet" href="css/homepage-style.css">
    <link rel="stylesheet" href="css/headerstyle.css">
    <script>
        function clearCookies() {
        // Dividiamo la stringa dei cookie in un array e iteriamo su ciascun cookie
            document.cookie.split(";").forEach(function(c) {
                // Dividiamo il cookie in nome e valore
                var cookie = c.trim().split("=");
                if (cookie[0].indexOf('PHPSESSID') === -1) { // Escludi i cookie di sessione
                    document.cookie = cookie[0] + '=;expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;'; // Omettiamo 'cookie[1]' (ovvero il valore del cookie) poiché stiamo cancellando il cookie  
                }
            });
            window.location.reload(); // Ricarica la pagina per aggiornare lo stato
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
    // Verifica se è stato richiesto di rimuovere un'auto vedi riga 22
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
    require "tswdb.php";
    $db = pg_connect($connection_string) or die('Impossibile connettersi al database: ' . pg_last_error());

    // Se ci sono auto selezionate, esegui una query per recuperare i loro dettagli
    if (count($auto_selezionate) > 0) {
        // Assicurati che gli ID siano numeri interi per prevenire SQL injection
        $ids = implode(',', array_map('intval', $auto_selezionate));
        
        // Esegui la query per ottenere i dettagli delle auto selezionate
        $query = "SELECT * FROM auto WHERE id IN ($ids)";
    
        $result = pg_query($db, $query) or die('Query failed: ' . pg_last_error());
        
        // Ottieni tutti i risultati della query come array associativo
        $auto_selezionate = pg_fetch_all($result);
        
        // Libera la memoria tenendo i risultati della query
        pg_free_result($result);
        
        // Definisci la funzione di confronto in base all'ordine specificato
        $ordine = isset($_GET['ordine']) && ($_GET['ordine'] == 'decrescente') ? -1 : 1;
        
        usort($auto_selezionate, function($a, $b) use ($ordine) {
            $diff = $a['prezzo'] - $b['prezzo'];
            return $diff * $ordine;
        });
    }
    
    
?>


<?php if (count($auto_selezionate) > 0): ?>
    <div class="container-confronta" style="margin-top: 220px; ">

    <!-- Form per selezionare l'ordine delle auto -->
    <form id="order-form" action="confronta.php" method="get">
        <label for="ordine" class="beige-text">Ordina per prezzo:</label>
        <select name="ordine" id="ordine" style="background-color: beige; border-radius:20px;">
            <option value="crescente">Crescente</option>
            <option value="decrescente">Decrescente</option>
        </select>
        <button type="submit" style="background-color: beige; border-radius:10px;">Ordina</button>
    </form>

    </div>
    <div class="container-confronta">
    <?php foreach ($auto_selezionate as $auto): ?>
        <div class="card">
            <!-- Aggiunta dell'immagine dell'auto -->
            <img src="img/card-img/<?php echo htmlspecialchars($auto['img']) . '.jpg'; ?>" alt="Immagine di <?php echo htmlspecialchars($auto['nome']); ?>">

            <!-- Sezione delle informazioni dell'auto -->
            <div class="card-info">
                <h3><?php echo htmlspecialchars($auto['nome']); ?></h3>
                <p>Anno: <?php echo htmlspecialchars($auto['anno']); ?></p>
                <p>Prezzo: <?php echo htmlspecialchars($auto['prezzo']); ?> €</p>
                <!-- Meglio fare <a href> oppure fare echo '<button onclick="salvaAutoConfronto(\'' . htmlspecialchars($auto['id']) . '\')" class="btn">Confronta</button>'; ? -->
                <a href="dettagli.php?id=<?php echo htmlspecialchars($auto['id']); ?>" class="btn">Dettagli</a>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
    <!-- Pulsante per azzerare i cookie -->
    <div class="container">
    <button onclick="clearCookies()" class="btn" style="text-align: center;">Rimuovi tutte le auto selezionate</button>';
    </div>
<?php else: ?>
    <!-- Mostra un messaggio se nessuna auto è stata selezionata -->
    <!-- Bisogna creare un container -->
    <div style="margin-top: 240px; margin-bottom: 40px;">
    <p class="beige-text">Nessuna auto selezionata per il confronto.</p>
    </div>
<?php endif; ?>

</body>

<?php 
    include 'footer.php';
?>  
</html>
