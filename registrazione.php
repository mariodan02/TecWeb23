<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registrazione - WikiCar Vintage</title>
<link rel="stylesheet" href="style.css">
<script src="database.js" defer></script>
</head>
<header>
<?php
        include 'header.php';
    ?>
</header>
<body>
  <div class="container">
      <div class="form-container">
      <h2>Registrati adesso</h2>
      <br>
          <form id="signup-form">
            <label for="username">Nome utente</label>
            <input type="text" id="username" name="username" placeholder="Inserisci il tuo nome utente">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Inserisci il tuo indirizzo email">

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Inserisci la tua password">

              <div class="checkbox">
                <input type="checkbox" id="agree" name="agree">
                <label for="agree">Acconsento al trattamento dei dati personali</label>
              </div>

        <button type="submit">Registrati</button>

        <div class="social-login">
          <button type="button" id="google-login">Registrati con Google</button>
          <button type="button" id="apple-login">Registrati con Apple</button>
        </div>

        <div class="login-link">
          Hai già un account? <a href="login.php">Accedi</a>
        </div>
      </form>
    </div>
    <div class="branding">
      <img src="wikicar-logo.png" alt="WikiCar Vintage">
    </div>
  </div>
</div>
</body>
<footer>
  <?php
        include 'footer.php';
    ?>
</footer>
</html>
