<?php
// Carichiamo il contenuto del file JSON
$json = file_get_contents("links.json");

// Decodifichiamo il JSON in un array PHP
$data = json_decode($json, true);

// Ottieniamo il parametro "q" dalla query string nell'URL
$q = $_GET["q"];

// Inizializziamo la variabile per memorizzare i suggerimenti
$hint = "";

// Cerchiamo tra i link nel JSON se la lunghezza di "q" è maggiore di 0
if (strlen($q) > 0) {
    foreach ($data as $link) {
        // Verifica se il titolo del link inizia con la query fornita
        if (stripos($link['title'], $q) === 0) {
            // Aggiungiamo il link ai suggerimenti
            if ($hint === "") {
                $hint = "<a href='" . $link['url'] . "' target='_blank'>" . $link['title'] . "</a>";
            } else {
                $hint .= "<a href='" . $link['url'] . "' target='_blank'>" . $link['title'] . "</a>";
            }
        }
    }
}

// Se non ci sono suggerimenti, impostiamo la risposta a "no suggestion"
$response = ($hint === "") ? "no suggestion" : $hint;

// Output della risposta
echo $response;  //output può essere inviato tramite echo dato che non è una risposta complessa (L'utilizzo di una richiesta GET consente questa scelta)
?>
