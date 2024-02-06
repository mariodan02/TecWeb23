<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Area Riservata - WikiCar Vintage</title>
<link rel="stylesheet" href="homepage-style.css">
</head>

  <?php
    include 'header.php';
  ?>

<body>
<?php
    // Verifica se l'utente è loggato
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // L'utente è loggato, rimani nella pagina corrente
    } else {
    // L'utente non è loggato, reindirizza a login.php
    header('Location: login.php');
    exit();
    }
?>
</body>
  <?php
        include 'footer.php';
    ?>
</html>
