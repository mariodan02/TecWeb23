<?php
    session_start();
?>

<header>   
    <nav>
        <img src="img/other-img/logo_bianco.png" alt="logo">
        <ul>
            <li><a href="homepage.php">Homepage</a></li>
            <li><a href="confronta.php">Confronta</a></li>
            <!-- Verifica se l'utente è loggato -->
            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                <!-- Se l'utente è loggato, mostra il link all'area personale e l'icona -->
                <li>
                    <a href="reserved.php">
                        <?php
                        if (isset($_SESSION['user_id'])) {
                            $username = $_COOKIE['username'] ?? 'user'; // Usa un nome predefinito se il cookie non esiste
                            $profilePicPath = "uploads/" . $username . ".png";
                            // Aggiungi un controllo per vedere se il file esiste e può essere letto
                            if (file_exists($profilePicPath) && is_readable($profilePicPath)) {
                                echo "<img src='$profilePicPath' alt='Profilo' style='height: 20px; width: 20px;'>";
                            } else {
                                // Se non c'è un'immagine del profilo, mostra un'icona predefinita
                                echo "<i class='fa fa-user' aria-hidden='true'></i>"; // Assicurati di avere Font Awesome se usi questo
                            }
                        }
                        ?>
                        Area personale
                    </a>
                </li>
            <?php else: ?>
                <!-- Se l'utente non è loggato, mostra il link per accedere -->
                <li><a href="login.php">Accedi</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
