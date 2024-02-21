<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/homepage-style.css">
    <link rel="stylesheet" href="css/headerstyle.css">
    <title>WikiCar Vintage</title>
    <link rel="icon" href="img/other-img/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="img/other-img/logo.png" type="image/x-icon">
</head>

<body>
    <?php include 'header.php'; ?>

    <video id="background-video" autoplay muted loop>
        <source src="img/video/Sfondo.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div id="home" class="hero">
        <h1>Esplora il Fascino delle Auto d'Epoca</h1>
        <p>Scopri la bellezza e l'eleganza dei modelli che hanno fatto la storia dell'automobile.</p>
        <a href="javascript:void(0);" class="btn" onclick="scrollDown()">Scopri di più</a>
        </div>

    <section id="lista-auto">
        <?php
        require "tswdb.php";
        // Connessione al database PostgreSQL
        $db = pg_connect($connection_string) or die('Impossibile connettersi al database: ' . pg_last_error());

        // Esecuzione della query
        $query = 'SELECT * FROM auto';
        $result = pg_query($db, $query) or die('Query failed: ' . pg_last_error());

        // Ciclo per ogni auto
        while ($auto = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            echo '<div class="card">';
            
            // Aggiunta dell'immagine dell'auto
            echo '<img src="img/card-img/' . htmlspecialchars($auto['img']) . '.jpg" alt="Immagine di ' . htmlspecialchars($auto['nome']) . '">';

            // Sezione delle informazioni dell'auto
            echo '<div class="card-info">';
            echo '<h3>' . htmlspecialchars($auto['nome']) . '</h3>';
            echo '<p>Anno: ' . htmlspecialchars($auto['anno']) . '</p>';
            echo '<p>Prezzo: ' . htmlspecialchars($auto['prezzo']) . ' €</p>';
            echo '</div>';
        
            // Pulsante Dettagli o Confronta
            echo '<a href="dettagli.php?id=' . htmlspecialchars($auto['id']) . '" class="btn">Dettagli</a>';
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                echo '<a href="javascript:void(0);" onclick="aggiungiAlGarage(\'' . htmlspecialchars($auto['id']). '\')" class="btn">Aggiungi al Garage</a>';
                echo '<a href="javascript:void(0);" onclick="salvaAutoConfronto(\'' . htmlspecialchars($auto['id']) . '\')" class="btn">Confronta</a>';
            } 
            echo '</div>';
        }    

        // Liberare il risultato
        pg_free_result($result);

        // Chiudere la connessione
        pg_close($db);
        ?>
    </section>

    <br><br>
    
    <div class="slider-container">
        <div class="slider-inner">
            <img class="mySlides" src="img/card-img/Alfa Romeo Giulia GTV 1965.jpg" alt="Slide 1">
            <img class="mySlides" src="img/other-img/slide1.jpg" alt="Slide 2">
            <img class="mySlides" src="img/other-img/slide2.jpg" alt="Slide 3">
            <img class="mySlides" src="img/card-img/Delta.jpg" alt="Slide 4">
            <img class="mySlides" src="img/card-img/F40.jpg" alt="Slide 5">
        </div>
    </div>

    <?php 
        include 'footer.php';
    ?>  

    <script type="text/javascript">
        window.addEventListener('scroll', function() {
            var scrollPosition = window.scrollY;
            var videoElement = document.getElementById('background-video');
            var blurSpeed = 0.01;
            var blurValue = Math.min(scrollPosition * blurSpeed, 10);

            videoElement.style.transform = 'translateY(' + (-scrollPosition / 2) + 'px)';
            videoElement.style.filter = 'blur(' + blurValue + 'px)';

            var header = document.querySelector('header');
            var scrolled = window.scrollY > 100; // Cambia il valore a seconda di quando vuoi che avvenga il cambio di colore
            if(scrolled){
                header.classList.add('scrolled');
            }else{
                header.classList.remove('scrolled');
            }
            });

        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let slides = document.getElementsByClassName("mySlides");
            let container = document.querySelector(".slider-inner");

            // Incrementa slideIndex e reimpostalo a 0 se supera il numero di diapositive
            slideIndex++;
            if (slideIndex >= slides.length) {
                slideIndex = 0;
            }

            // Calcola l'offset per spostare le immagini di una slide
            let offset = -slideIndex * 100;

            // Utilizza requestAnimationFrame per gestire l'animazione in modo più preciso
            function animate() {
                container.style.transform = `translateX(${offset}%)`;
                requestAnimationFrame(animate);
            }
            
            // Chiama la funzione animate
            animate();

            // Chiama la funzione in modo ricorsivo dopo 2 secondi
            setTimeout(showSlides, 3000); // Cambia slide ogni 3 secondi

}

    function salvaAutoConfronto(idAuto) {
        var nomeCookie = "autoConfronto_" + idAuto;
        var valoreCookie = idAuto;
        var scadenza = new Date();
        scadenza.setTime(scadenza.getTime() + (60 * 60 * 1000)); // 1 ora
        document.cookie = nomeCookie + "=" + valoreCookie + ";expires=" + scadenza.toUTCString() + ";path=/"; /*ogni cookie aggiunto verrà concatenato tramite questa riga I COOKIE CON NOMI DIVERSI NON VENGONO SOVRASCRITTI/PERSI*/
        alert('Auto aggiunta al confronto!'); // Messaggio di conferma
    }

    function scrollDown() {
    // Effettua lo scorrimento della pagina
    window.scrollBy({
        top: 1000,
    });
}

    function aggiungiAlGarage(idAuto) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "aggiungi_al_garage.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            if (xhr.responseText === "success") {
                alert("Auto aggiunta al garage con successo!");
            } else {
                alert("Errore: " + xhr.responseText);
            }
        }
    };
    xhr.send("idAuto=" + encodeURIComponent(idAuto));
}
    </script>

</body>
</html>