<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Area Riservata - WikiCar Vintage</title>
<link rel="stylesheet" href="homepage-style.css">
<link rel="stylesheet" href="headerstyle.css">
</head>

<?php
    include 'header.php';
?>

<body>
<div class="container-reserved">
    <?php
    require "tswdb.php";

    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        $username = $_SESSION['username'] ?? 'user';
        echo '<span class="beige-text">Ciao,  </span>' . '<span class="beige-text">' . htmlspecialchars($username) . '</span>';
        

        // Connettiti al database
        $db = pg_connect($connection_string) or die('Impossibile connettersi al database: ' . pg_last_error());

        // Recupera l'ID del garage basato sull'username
        $garageResult = pg_query_params($db, "SELECT id FROM garage WHERE username = $1", array($username));
        if ($garageResult && pg_num_rows($garageResult) > 0) {
            $garageRow = pg_fetch_assoc($garageResult);
            $garageId = $garageRow['id'];

            // Recupera le auto associate all'utente
            $autoResult = pg_query_params($db, "SELECT a.* FROM auto a JOIN garage_auto ga ON a.id = ga.auto_id WHERE ga.garage_id = $1", array($garageId));
            if ($autoResult) {
                echo "<ul>";
                echo '<div class="container">';
                while ($auto = pg_fetch_assoc($autoResult)) {

                echo '<div class="card">';
            
                    // Aggiunta dell'immagine dell'auto
                    echo '<img src="img/card-img/' . htmlspecialchars($auto['img']) . '.jpg" alt="Immagine di ' . htmlspecialchars($auto['nome']) . '">';
        
                    // Sezione delle informazioni dell'auto
                    echo '<div class="card-info">';
                    echo '<h3>' . htmlspecialchars($auto['nome']) . '</h3>';
                    echo '<p>Anno: ' . htmlspecialchars($auto['anno']) . '</p>';
                    echo '<p>Prezzo: ' . htmlspecialchars($auto['prezzo']) . '</p>';
                    echo '</div>';
                
                    // Pulsante Dettagli
                    echo '<a href="/path/to/dettagli.php?id=' . htmlspecialchars($auto['id']) . '" class="btn">Dettagli</a>';
                    
                    // Pulsante Rimuovi
                    echo '<a href="rimuovi_auto.php?id=' . htmlspecialchars($auto['id']) . '" class="btn" style="background-color: red;">Rimuovi</a>';
                echo '</div>';

                }
                echo "</div>";
                echo "</ul>";
            } else {
                echo "<p>Non ci sono auto nel tuo garage.</p>";
            }
        } else {
            echo '<p class="beige-text" style="margin-left: 5px; margin-right: 5px;"> Garage non trovato. </p>';
        }

        pg_close($db);

    } else {
        echo "<font color=beige> Non riusciamo a riconoscerti! Effettua l'</font> <a href='login.php' style='margin-left: 5px; margin-right: 5px;'> accesso </a> <font color=beige> se sei già registrato o </font> <a href='registrazione.php' style='margin-left: 5px; margin-right: 5px;'> registrati </a> <font color=beige> se è la prima volta che vieni a trovarci! </font>";
    }
    ?>

    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
        <div class="form-container-reserved">
            <form action="upload_profile_picture.php" method="post" enctype="multipart/form-data">
                Seleziona immagine:
                <input type="file" name="profilePic" id="profilePic">
                <input type="submit" value="Carica" name="submit">
            </form>
        </div>
    <?php endif; ?>

</div>    
   
<div style="text-align: center;">
<a href="logout.php">Effettua il logout</a>
</div>

<?php
    include 'footer.php';
?>

</body>
</html>

