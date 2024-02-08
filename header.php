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
                <!-- Se l'utente è loggato, mostra il link all'area personale e il menu a tendina -->
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn">Area personale</a>
                    <div class="dropdown-content">
                        <a href="reserved.php">Profilo</a>
                        <a href="logout.php">Logout</a>
                    </div>
                </li>
            <?php else: ?>
                <!-- Se l'utente non è loggato, mostra il link per creare un account -->
                <li><a href="registrazione.php">Registrati</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
