<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registrazione - WikiCar Vintage</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="headerstyle.css">
<script src="inputValidation.js"></script>
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
			if(username_exist($username) || $username==="user" ){ // Richiama la funzione username_exist($username)
				echo "<script type=\"text/javascript\"> alert(\"Username $username già esistente oppure non valido. Riprova\");</script>";
			}
			else{
				//Se l'utente non risulta precedentemente registrato, si procede all'inserimento del nuovo utente
				if(insert_utente($username, $email, $password)){
					echo "<script type=\"text/javascript\"> alert(\"Utente registrato con successo. Effettua il login\");</script>";
					$garageId = creaGaragePerUtente($username);
					$_SESSION['username'] = $username;
					$_SESSION['logged_in'] = true;
					header('Location: homepage.php'); 
					exit();
					if ($garageId === false) {
    				echo "error: Impossibile creare un garage per l'utente.";
    				// Gestire l'errore 
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
            <input type="text" id="username" name="username" placeholder="Inserisci il tuo nome utente"><br>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Inserisci il tuo indirizzo email">

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Inserisci la tua password">

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
	// Connessione al database
	$db = pg_connect($connection_string) or die('Impossibile connetersi al database: ' . pg_last_error());
	$hash = password_hash($password, PASSWORD_DEFAULT);
	$sql = "INSERT INTO utenti(username, email, password) VALUES($1, $2, $3)";
	$prep = pg_prepare($db, "insertUser", $sql);
	$ret = pg_execute($db, "insertUser", array($username,$email,$hash));
	if(!$ret) {
		echo "$hash ERRORE QUERY: " . pg_last_error($db);
		return false;
	}
	else{
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

