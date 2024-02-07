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

<div class="container">
      <div class="form-container">
      <?php
     
      if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        echo "Ciao, ";
        echo "<a href='logout.php'>Effettua il logout</a>";
      } else {
        echo " Non riusciamo a riconoscerti! Effettua l'<a href='login.php'>accesso</a> se sei giá registrato o <a href='registrazione.php'>registrati</a> se é la prima volta che vieni a trovarci!";
      }
    
      ?>
      </div>
</div>

</body>

  <?php
    include 'footer.php';
    ?>

</html>
