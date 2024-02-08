<?php
// Carica il contenuto del file JSON
$json = file_get_contents("links.json");

// Decodifica il JSON in un array PHP
$data = json_decode($json, true);

// Ottieni il parametro "q" dalla query string nell'URL
$q = $_GET["q"];

// Inizializza la variabile per memorizzare i suggerimenti
$hint = "";

// Cerca tra i link nel JSON se la lunghezza di "q" è maggiore di 0
if (strlen($q) > 0) {
    foreach ($data as $link) {
        // Trova i link che corrispondono al testo di ricerca
        if (stristr($link['title'], $q)) {
            // Aggiungi il link ai suggerimenti
            if ($hint === "") {
                $hint = "<a href='" . $link['url'] . "' target='_blank'>" . $link['title'] . "</a>";
            } else {
                $hint .= "<br /><a href='" . $link['url'] . "' target='_blank'>" . $link['title'] . "</a>";
            }
        }
    }
}

// Se non ci sono suggerimenti, imposta la risposta a "no suggestion"
$response = ($hint === "") ? "no suggestion" : $hint;

// Output della risposta
echo $response;
?>
