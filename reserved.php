<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Area Riservata - WikiCar Vintage</title>
<link rel="stylesheet" href="css/homepage-style.css">
<link rel="stylesheet" href="css/headerstyle.css">

<style>
#drop_zone {
    border: 2px dashed #ccc;
    border-radius: 5px;
    padding: 20px;
    text-align: center;
    color: #ccc;
    margin: 10px 0;
    background-color: #f8f8f8;
    cursor: pointer;
}

#drop_zone:hover {
    background-color: #e8e8e8;
}

#drop_zone.dragover {
    background-color: #e0e0e0;
    border-color: #333;
}


</style>


</head>

<?php
    include 'header.php';
?>

<body>

<div class="container">
    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
        <div class="form-container-reserved">
            <form action="upload_profile_picture.php" method="post" enctype="multipart/form-data">
                Seleziona immagine di profilo:
                <div id="drop_zone" ondrop="dropHandler(event);" ondragover="dragOverHandler(event);" ondragleave="dragLeaveHandler(event);">
                    Trascina qui un'immagine
                </div>
                <input type="file" name="profilePic" id="profilePic" hidden>
                <input type="submit" value="Carica" name="submit">
            </form>
        </div>
    <?php endif; ?>
</div>

<div class="container-reserved-auto">
    <?php
    require "tswdb.php";

    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        $username = $_SESSION['username'] ?? 'user';
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

                if (pg_num_rows($autoResult) > 0){

                echo '<div class="container">';

                echo '<span class="beige-text" style="margin-left: 30px;">Ciao,  </span>' . '<span class="beige-text">' . htmlspecialchars($username) . '</span>' . '<span class="beige-text" style="margin-right: 15px;"> ' . '&nbsp;ecco le tue auto: </span>';

                while ($auto = pg_fetch_assoc($autoResult)) {

                echo '<div class="card">';
            
                    // Aggiunta dell'immagine dell'auto
                    echo '<img src="img/card-img/' . htmlspecialchars($auto['img']) . '.jpg" alt="Immagine di ' . htmlspecialchars($auto['nome']) . '">';
        
                    // Sezione delle informazioni dell'auto
                    echo '<div class="card-info">';
                    echo '<h3>' . htmlspecialchars($auto['nome']) . '</h3>';
                    echo '<p>Anno: ' . htmlspecialchars($auto['anno']) . '</p>';
                    echo '<p>Prezzo: ' . htmlspecialchars($auto['prezzo']) . ' €</p>';
                    echo '</div>';
                
                    // Pulsante Dettagli
                    echo '<a href="dettagli.php?id=' . htmlspecialchars($auto['id']) . '" class="btn">Dettagli</a>';
                    
                    // Pulsante Rimuovi
                    echo '<a href="rimuovi_auto.php?id=' . htmlspecialchars($auto['id']) . '" class="btn" style="background-color: rgb(118, 0, 0)">Rimuovi</a>';
                echo '</div>';

                }

                echo "</div>";
                echo "</ul>";

                }else{

                    echo "<p class='beige-text' style='margin-left: 650px;'>Non ci sono auto nel tuo garage.</p>";
               
                }

            } else {
                echo "<p class='beige-text'>Non ci sono auto nel tuo garage.</p>";
            }
        } else {
            echo '<p class="beige-text" style="margin-left: 5px; margin-right: 5px;"> Garage non trovato. </p>';
        }

        pg_close($db);

    } else {
        echo '<p class="beige-text" style="margin-top: 150px; margin-left: 25px;">';
        echo "<font color=beige> Non riusciamo a riconoscerti! Effettua l'</font>";
        echo "<a href='login.php' style='margin-left: 5px; margin-right: 5px;'> accesso </a>";
        echo "<font color=beige> se sei già registrato o </font>";
        echo "<a href='registrazione.php' style='margin-left: 5px; margin-right: 5px;'> registrati </a>";
        echo "<font color=beige> se è la prima volta che vieni a trovarci! </font>";
        echo "</p>";   
    }
    ?>

</div>    
   
<div style="text-align: center;"><br><br>
<a href="logout.php">Effettua il logout</a>
</div>

<?php
    include 'footer.php';
?>

<script>
function dragOverHandler(ev) {
    ev.preventDefault();
    ev.currentTarget.classList.add('dragover');
}

function dragLeaveHandler(ev) {
    ev.currentTarget.classList.remove('dragover');
}

function dropHandler(ev) {
    ev.preventDefault();
    ev.currentTarget.classList.remove('dragover');
    processFile(ev.dataTransfer.files[0]);
}

function processFile(file) {
    var reader = new FileReader();
    reader.onload = function(e) {
        var img = document.createElement("img");
        img.src = e.target.result;
        img.style.maxWidth = "200px";
        img.style.maxHeight = "200px";
        document.getElementById('drop_zone').innerHTML = '';
        document.getElementById('drop_zone').appendChild(img);
    };
    reader.readAsDataURL(file);
}

document.getElementById('drop_zone').addEventListener('click', function() {   //usato per simulare il click sull'elemento di tipo file profilePic che risulta hidden (quindi non cliccabile)
    document.getElementById('profilePic').click();
});

document.getElementById('profilePic').addEventListener('change', function(event) {  //usato quando si seleziona il file dalla finestra di dialogo*/
    processFile(event.target.files[0]);
});
</script>

</body>
</html>

