<?php
// Luetaan objektit.json-tiedosto
$tiedosto = fopen('objektit.json', 'r');

if (!$tiedosto) {
    http_response_code(500);
    echo json_encode(array('virhe' => 'Tiedoston lukeminen epäonnistui'));
    exit;
}

// Luetaan tiedoston sisältö
$sisalto = fread($tiedosto, filesize('objektit.json'));

// Suljetaan tiedosto
fclose($tiedosto);

// Palautetaan objektit JSON-muodossa
http_response_code(200);
echo json_encode($sisalto);

?>