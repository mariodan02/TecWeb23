<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="homepage-style.css">
    <link rel="stylesheet" href="headerstyle.css">
    <title>WikiCar Vintage</title>
    <link rel="icon" href="img/other-img/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="img/other-img/logo.png" type="image/x-icon">
</head>

<body>
<?php include 'header.php'; ?>
<?php
// Controlla se l'ID è presente nella query string e se è numerico
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $autoId = $_GET['id'];

    switch ($autoId) {
        case 0:
            header('Location: https://it.wikipedia.org/wiki/Ford_Mustang');
            exit;
        case 1:
            header('Location: https://it.wikipedia.org/wiki/Volkswagen_Maggiolino');
            exit;
        case 2:
            header('Location: https://it.wikipedia.org/wiki/Chevrolet_Impala');
            exit;
        case 3:
            header('Location: https://it.wikipedia.org/wiki/Porsche_911');
            exit;
        case 4:
            header('Location: https://it.wikipedia.org/wiki/Jaguar_E-Type');
            exit;
        case 5:
            header('Location: https://it.wikipedia.org/wiki/Toyota_2000GT');
            exit;
        case 6:
            header('Location: https://it.wikipedia.org/wiki/BMW_Serie_02');
            exit;
        case 7:
            header('Location: https://it.wikipedia.org/wiki/Lamborghini_Miura');
            exit;
        case 8:
            header('Location: https://it.wikipedia.org/wiki/Alfa_Romeo_GTV');
            exit;
        case 9:
            header('Location: https://it.wikipedia.org/wiki/Mercedes-Benz_W198');
            exit;
        case 10:
            header('Location: https://it.wikipedia.org/wiki/Ferrari_F40');
            exit;
        case 11:
            header('Location: https://it.wikipedia.org/wiki/Fiat_Nuova_500');
            exit;
        case 12:
            header('Location: https://it.wikipedia.org/wiki/Pagina1');
            exit;
        case 13:
            header('Location: https://it.wikipedia.org/wiki/Citro%C3%ABn_DS');
            exit;
        case 14:
            header('Location: https://it.wikipedia.org/wiki/Aston_Martin_DB5');
            exit;
        case 15:
            header('Location: https://it.wikipedia.org/wiki/AC_Cobra');
            exit;
        default:
            echo '<p>ID non corrisponde a un auto conosciuta.</p>';
            break;
    }
} else {
    echo '<p>ID non valido.</p>';
}
// Chiudi la connessione al database, se aperta
if (isset($db)) {
    pg_close($db);
}
?>


</body>

</html>