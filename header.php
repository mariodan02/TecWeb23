<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Header Esempio</title>
<style>
  .header-container {
    background-color: #333; /* Sostituisci con il colore esatto del tuo background */
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
  }

  .logo {
    display: flex;
    align-items: center;
  }

  .logo img {
    max-width: 100px;
  }

  .navigation {
    display: flex;
    list-style-type: none;
  }

  .navigation li {
    padding: 0 20px; /* Regola lo spazio tra le voci di navigazione */
  }

  .navigation li a {
    text-decoration: none;
    color: white; /* Sostituisci con il colore esatto del testo */
    font-weight: bold;
  }

  .login-button {
    background-color: #f0ad4e; /* Sostituisci con il colore esatto del bottone */
    border: none;
    border-radius: 20px;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    color: white; /* Sostituisci con il colore esatto del testo nel bottone */
    cursor: pointer;
  }
</style>
</head>
<body>

<div class="header-container">
  <div class="logo">
    <img src="wikicar-logo.png" alt="Wikicar Logo">
  </div>
  <ul class="navigation">
    <li><a href="#">Homepage</a></li>  /* Sistemare con giusto collegamento */
    <li><a href="#">Catalogo</a></li>
    <!-- Altre voci di navigazione se necessario -->
  </ul>
  <a href="registrazione.php" class="login-button">Login/Registrati</a>
</div>

</body>
</html>
