<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="homepage-style.css">
    <title>WikiCar Vintage</title>
    <link rel="icon" href="img/other-img/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="img/other-img/logo.png" type="image/x-icon">
    <style>
        /*#background-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            z-index: -1;
            background-image: url('img/other-img/sfondo.jpg');
            background-size: cover;
            transition: transform 0.3s ease-out, filter 0.3s ease-out; /* Aggiunto filtro alla transizione 
            filter: blur(0px); /* Aggiungi il filtro di sfocatura con un valore iniziale di 0px 
        }*/
        #background-video {
            position: fixed;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100vh;
            object-fit: cover;
            z-index: -1;
            transition: transform 0.3s ease-out, filter 0.3s ease-out;
            filter: blur(0px);
        }

        .slider-container {
            max-width: 100%;
            overflow: hidden;
            position: relative;
        }

        .slider-inner {
            display: flex;
            transition: transform 2s ease-in-out; /* Tempo di transizione di 1 secondo */
        }

        .mySlides {
            flex: 0 0 100%;
            width: 100%;
            height: auto;
        }
    </style>

</head>
<body>
    <video id="background-video" autoplay muted loop>
        <source src="Sfondo 1.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <header>
        <?php
        include 'header.php';
        ?>
    </header>

    <div id="home" class="hero">
        <h1>Esplora il Fascino delle Auto d'Epoca</h1>
        <p>Scopri la bellezza e l'eleganza dei modelli che hanno fatto la storia dell'automobile.</p>
        <a href="#auto" class="btn">Scopri di più</a>
    </div>

    <section id="lista-auto">
        
        <!-- Modifica la struttura delle card delle auto -->
        <div class="car-card">
            <img src="img/card-img/Mustang.jpeg" alt="immagine Mustang">
            <div class="car-info">
                <h3>Ford Mustang</h3>
                <p><strong>Anno: </strong> 1967</p>
                <p><strong>Prezzo: </strong> $40,000-$100,000</p>
                <!-- Controllare se l'utente è registrato -->
                <a href="Dettagli" class="btn">Dettagli</a>  
            </div>
        </div>

        <div class="car-card">
            <img src="img/card-img/Volkswagen.jpg" alt="immagine maggiolino">
            <div class="car-info">
                <h3>Volkswagen Beetle</h3>
                <p><strong>Anno: </strong> 1938</p>
                <p><strong>Prezzo: </strong> $15,000-$20,000</p>
                <a href="#" class="btn">Dettagli</a>
            </div>
        </div>

        <div class="car-card">
            <img src="img/card-img/Chevrolet.jpg" alt="immagine impala">
            <div class="car-info">
                <h3>Chevrolet Impala</h3>
                <p><strong>Anno: </strong> 1958</p>
                <p><strong>Prezzo: </strong> $50,000-$60,000</p>
                <a href="#" class="btn">Dettagli</a>
            </div>
        </div>

        <div class="car-card">
            <img src="img/card-img/Porsche.jpeg" alt="immagine 911">
            <div class="car-info">
                <h3>Porsche 911</h3>
                <p><strong>Anno: </strong>1963</p>
                <p><strong>Prezzo: </strong>$150,000-$200,000</p>
                <a href="#" class="btn">Dettagli</a>
            </div>
        </div>

        <div class="car-card">
            <img src="img/card-img/Jaguar.jpeg" alt="immagine E-TYPE">
            <div class="car-info">
                <h3>Jaguar E-TYPE</h3>
                <p><strong>Anno: </strong>  1961</p>
                <p><strong>Prezzo: </strong> $170,000-$280,000</p>
                <a href="#" class="btn">Dettagli</a>
            </div>
        </div>

        <div class="car-card">
            <img src="img/card-img/Toyota.jpg" alt="immagine 2000GT">
            <div class="car-info">
                <h3>Toyota 2000GT</h3>
                <p><strong>Anno: </strong>  1967</p>
                <p><strong>Prezzo: </strong> $500,000-$1,000,000</p>
                <a href="#" class="btn">Dettagli</a>
            </div>
        </div>

        <div class="car-card">
            <img src="img/card-img/Benz.jpg" alt="immagine Mercedes 300SL">
            <div class="car-info">
                <h3>Mercedes Benz 300SL</h3>
                <p><strong>Anno: </strong>  1954</p>
                <p><strong>Prezzo: </strong> $1,100,000-$1,900,000</p>
                <a href="#" class="btn">Dettagli</a>
            </div>
        </div>

        <div class="car-card">
            <img src="img/card-img/F40.jpg" alt="immagine F40">
            <div class="car-info">
                <h3>Ferrari F40</h3>
                <p><strong>Anno: </strong>  1987</p>
                <p><strong>Prezzo: </strong> $1,300,000-$2,300,000</p>
                <a href="#" class="btn">Dettagli</a>
            </div>
        </div>

        <div class="car-card">
            <img src="img/card-img/BMW.jpg" alt="immagine BMW">
            <div class="car-info">
                <h3>BMW 2002</h3>
                <p><strong>Anno: </strong>  1968</p>
                <p><strong>Prezzo: </strong> $40,000-$50,000</p>
                <a href="#" class="btn">Dettagli</a>
            </div>
        </div>

        <div class="car-card">
            <img src="img/card-img/Lamborghini.jpeg" alt="immagine lamborghini">
            <div class="car-info">
                <h3>Lamborghini Miura</h3>
                <p><strong>Anno: </strong>  1966</p>
                <p><strong>Prezzo: </strong> $1,600,000-$3,500,000</p>
                <a href="#" class="btn">Dettagli</a>
            </div>
        </div>

        <div class="car-card">
            <img src="img/card-img/Alfa Romeo Giulia GTV 1965.jpg" alt="immagine AlfaRomeo">
            <div class="car-info">
                <h3>Alfa Romeo Giulia GTV</h3>
                <p><strong>Anno: </strong>  1965</p>
                <p><strong>Prezzo: </strong> $50,000-$70,000</p>
                <a href="#" class="btn">Dettagli</a>
            </div>
        </div>

        <div class="car-card">
            <img src="img/card-img/Fiat 500 1957.jpg" alt="immagine Fiat500">
            <div class="car-info">
                <h3>Fiat 500</h3>
                <p><strong>Anno: </strong>  1957</p>
                <p><strong>Prezzo: </strong> $15,000-$20,000</p>
                <a href="#" class="btn">Dettagli</a>
            </div>
        </div>

        <div class="car-card">
            <img src="img/card-img/Delta.jpg" alt="immagine Delta">
            <div class="car-info">
                <h3>Lancia Delta Integrale</h3>
                <p><strong>Anno: </strong> 1967</p>
                <p><strong>Prezzo: </strong> $180,000-$250,000</p>
                <a href="#" class="btn">Dettagli</a>
            </div>
        </div>

        <div class="car-card">
            <img src="img/card-img/Citroen.jpg" alt="immagine DS">
            <div class="car-info">
                <h3>Citroen DS</h3>
                <p><strong>Anno: </strong> 1955</p>
                <p><strong>Prezzo: </strong> $35,000-$100,000</p>
                <a href="#" class="btn">Dettagli</a>
            </div>
        </div>

        <div class="car-card">
            <img src="img/card-img/Aston Martin.jpg" alt="immagine DB5">
            <div class="car-info">
                <h3>Aston Martin DB5</h3>
                <p><strong>Anno: </strong> 1963</p>
                <p><strong>Prezzo: </strong> $500,000-$800,000</p>
                <a href="#" class="btn">Dettagli</a>
            </div>
        </div>

        <div class="car-card">
            <img src="img/card-img/Shelby.jpeg" alt="immagine Shelby" >
            <div class="car-info">
                <h3>Shelby Cobra</h3>
                <p><strong>Anno: </strong> 1962</p>
                <p><strong>Prezzo: </strong> $500,000-$2,000,000</p>
                <a href="#" class="btn">Dettagli</a>
            </div>
        </div>
    </section>

    <br><br>
    
    <div class="slider-container">
        <div class="slider-inner">
            <img class="mySlides" src="img/card-img/Alfa Romeo Giulia GTV 1965.jpg" alt="Slide 1">
            <img class="mySlides" src="img/other-img/sfondo.jpg" alt="Slide 2">
            <img class="mySlides" src="img/other-img/sfondo 2.jpg" alt="Slide 3">
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
        });

    </script>

    <script type="text/javascript">
        window.addEventListener('scroll', function(){
            var header = document.querySelector('header');
            var scrolled = window.scrollY > 100; // Cambia il valore a seconda di quando vuoi che avvenga il cambio di colore
            
            if(scrolled){
                header.classList.add('scrolled');
            }else{
                header.classList.remove('scrolled');
            }
        });
    </script>

    <script type="text/javascript">
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let i;
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

    </script>


</body>
</html>

