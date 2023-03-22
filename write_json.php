<?php
/* php://input: This is a read-only stream that allows us to read 
    raw data from the request body. It returns all the raw data after 
the HTTP headers of the request, regardless of the content type.
    file_get_contents() function: This function in PHP is used to read 
    a file into a string.
json_decode() function: This function takes a JSON string and 
    converts it into a PHP variable that may be an array or an object.
 */
// input on json-merkkijono
$input=(file_get_contents("php://input"));
// Avataan tiedosto kirjoitustilaan
$tiedosto = fopen("objektit.json", "w");
if ($tiedosto === false) {
    // Jos tiedoston avaaminen epäonnistuu, palautetaan HTTP 500 -koodi
    http_response_code(500);
    echo json_encode(array('virhe' => 'Tiedoston avaaminen epäonnistui'));
    exit;
}

// Kirjoitetaan JSON-merkkijono tiedostoon, loppuun rivinvaihto
$kirjoitettu = fwrite($tiedosto, $input.PHP_EOL);

// Suljetaan tiedosto
fclose($tiedosto);

if ($kirjoitettu === false) {
    // Jos kirjoittaminen epäonnistuu, palautetaan HTTP 500 -koodi
    http_response_code(500);
    echo json_encode(array('virhe' => 'Tallennus epäonnistui'));
    exit;
}

// Palautetaan objekti, jos tallennus onnistuu
http_response_code(200);
echo json_encode(array('onnistuminen' => true));
?>