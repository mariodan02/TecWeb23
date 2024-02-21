<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Accedi - WikiCar Vintage</title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/headerstyle.css">
</head>

  <?php
    include 'header.php';
  ?>

<body>
  <div class="container">
      <div class="form-container">
      <h2>Effettua l'accesso</h2>
      <br>
          <form id="signin-form" method="post" action="login-manager.php">
            <label for="username">Nome utente</label><br>
            <input type="text" id="username" name="username" placeholder="Inserisci il tuo nome utente" value="<?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : ''; ?>"><br><br>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Inserisci la tua password">

        <input style = "width: 100%; padding: 10px; margin: 10px 0; border: none; border-radius: 4px; background-color: #221711; color: #FDF6DC; margin-top: 50px;"
         type="submit" name="invia" value="Accedi" />
         <div class="login-link">
          Non hai ancora un account? <a href="registrazione.php">Registrati</a>
        </div>
      </form>
    </div>
    <div class="branding">
      <img src="img/other-img/wikicar-logo.png" alt="WikiCar Vintage" width="600px" height="600px">
    </div>
  </div>
</div>
</body>
  <?php
        include 'footer.php';
    ?>
</html>
