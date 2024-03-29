<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registrazione - WikiCar Vintage</title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/headerstyle.css">
<script src="inputValidation.js"></script>
<script>
function togglePasswordVisibility() {
  var passwordField = document.getElementById("password");
  var visibilityToggle = document.getElementById("toggle-password");

  if (passwordField.type === "password") {
    passwordField.type = "text";
    visibilityToggle.textContent = "Nascondi";
  } else {
    passwordField.type = "password";
    visibilityToggle.textContent = "Mostra";
  }
}
</script>
</head>
<?php
        include 'header.php';
    ?>
<?php
		if(isset($_POST['username']))
			$username = $_POST['username'];
		else
			$username = "";

  		if(isset($_POST['email']))
    	$email = $_POST['email'];
  		else
    	$email = "";
	
		if(isset($_POST['password']))
			$password = $_POST['password'];
		else
			$password = "";
		//Si controlla la presenza di username duplicati
		if (!empty($password)){
			if(username_exist($username)){ // Richiama la funzione username_exist($username)
				echo "<script type=\"text/javascript\"> alert(\"Username $username già esistente. Riprova\");</script>";
			}
			else{
				//Se l'utente non risulta precedentemente registrato, si procede all'inserimento del nuovo utente
				if(insert_utente($username, $email, $password)){
					echo "<script type=\"text/javascript\"> alert(\"Utente registrato con successo. Effettua il login\");</script>";
					$garageId = creaGaragePerUtente($username);
					$_SESSION['username'] = $username;
					$_SESSION['email'] = $email;
					$_SESSION['password'] = $password;
					$_SESSION['logged_in'] = true;
					header('Location: homepage.php'); 
					exit();
					if ($garageId === false) {
    				echo "error: Impossibile creare un garage per l'utente.";
					}
				}
				else{
					echo "<script type=\"text/javascript\"> alert(\"Errore durante la registrazione. Riprova\");</script>";
				}
			}
		}
		?>

<body>
  	<div class="container">
      <div class="form-container">
      <h2>Registrati adesso</h2>
      <br>
        <form id="signup-form" method="post" action="registrazione.php" onsubmit="return validateFormSignUp()">

            <label for="username">Nome utente</label>
            <input type="text" id="username" name="username" placeholder="Inserisci il tuo nome utente" value="<?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : ''; ?>" required><br>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Inserisci il tuo indirizzo email" value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Inserisci la tua password" value="<?php echo isset($_SESSION['password']) ? htmlspecialchars($_SESSION['password']) : ''; ?>" required>
			<button type="button" id="toggle-password" onclick="togglePasswordVisibility()" style="background-color:beige; border-radius:4px; border-color:gray">Mostra</button>

              <div class="checkbox">
                <input type="checkbox" id="agree" name="agree">
                <label for="agree">Acconsento al trattamento dei dati personali</label>
              </div>

			<input style = "width: 100%; padding: 10px; margin: 10px 0; border: none; border-radius: 4px; background-color: #221711; color: #FDF6DC;" 
        	type="submit" name="registrazione" value="Registrati"/>

        	<div class="login-link">
          	Hai già un account? <a href="login.php">Accedi</a>
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

<?php
function username_exist($username){
	require "tswdb.php";
	// Connessione al database
	$db = pg_connect($connection_string) or die('Impossibile connetersi al database: ' . pg_last_error());
	$sql = "SELECT username FROM utenti WHERE username=$1";
	$prep = pg_prepare($db, "sqlUsername", $sql);
	$ret = pg_execute($db, "sqlUsername", array($username));
	if(!$ret) {
		echo "ERRORE QUERY: " . pg_last_error($db);
		return false;
	}
	else{
		if ($row = pg_fetch_assoc($ret)){
			return true;
		}
		else{
			return false;
		}
	}
}


function insert_utente($username, $email, $password){
    require "tswdb.php";
    
    // Validazione dei dati in entrata
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Gestisci l'errore di email non valida
        echo "Formato email non valido.";
        return false;
    }

    if (strlen($password) < 8) {
        // Gestisci l'errore di password troppo corta
        echo "La password deve essere di almeno 8 caratteri.";
        return false;
    }

    // Connessione al database
	$db = pg_connect($connection_string) or die('Impossibile connetersi al database: ' . pg_last_error());
	
    // Sanitizzazione dell'input
    $username = pg_escape_string($db, $username);
    $email = pg_escape_string($db, $email);

    // Hashing della password
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // Preparazione e esecuzione della query
    $sql = "INSERT INTO utenti(username, email, password) VALUES($1, $2, $3)";
    $prep = pg_prepare($db, "insertUser", $sql);
    $ret = pg_execute($db, "insertUser", array($username, $email, $hash));

    if (!$ret) {
        // Gestisci l'errore della query senza esporre dettagli sensibili
        error_log("Errore nell'inserimento utente: " . pg_last_error($db)); // Log dell'errore
        echo "Errore durante la registrazione.";
        return false;
    } else {
        return true;
    }
}

function creaGaragePerUtente($username) {
	require "tswdb.php";
	// Connessione al database
	$db = pg_connect($connection_string) or die('Impossibile connetersi al database: ' . pg_last_error());
    $result = pg_query_params($db, "INSERT INTO garage (username) VALUES ($1) RETURNING id", array($username));
    if ($result) {
        $row = pg_fetch_assoc($result);
        return $row['id']; // Restituisce l'ID del nuovo garage creato
    } else {
        return false; // La creazione del garage è fallita
    }
}
?>

