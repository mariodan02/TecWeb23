<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Area Riservata - WikiCar Vintage</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="headerstyle.css">
</head>

<?php
    include 'header.php';
?>

<body>
<div class="container">
    <div class="form-container">
        <?php
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            // Assicurati che il cookie 'username' sia impostato al momento del login
            $username = $_SESSION['username'] ?? 'user';
            echo "Ciao, " . htmlspecialchars($username) . "! <a href='logout.php'>Effettua il logout</a>";
        } else {
            echo "Non riusciamo a riconoscerti! Effettua l'<a href='login.php'>accesso</a> se sei già registrato o <a href='registrazione.php'>registrati</a> se è la prima volta che vieni a trovarci!";
        }
        ?>
    </div>
    
    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
        <div class="container">
            <form action="upload_profile_picture.php" method="post" enctype="multipart/form-data">
                Seleziona immagine:
                <input type="file" name="profilePic" id="profilePic">
                <input type="submit" value="Carica" name="submit">
            </form>
        </div>
    <?php endif; ?>
      
</div>

<?php
    include 'footer.php';
?>

</body>
</html>
