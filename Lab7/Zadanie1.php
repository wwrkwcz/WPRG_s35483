<?php
$wejscie = trim(fgets(STDIN));
$pary = explode('&', $wejscie);
$dane = [];

foreach ($pary as $para) {
    if (empty($para)) continue;
    $elementy = explode('=', $para);
    $klucz = $elementy[0];
    $wartosc = isset($elementy[1]) ? $elementy[1] : '';
    $dane[$klucz] = $wartosc;
}

$latarnia = isset($dane['latarnia']) ? $dane['latarnia'] : 'brak';
$sektor = isset($dane['sektor']) ? $dane['sektor'] : 'brak';
$stan = isset($dane['stan']) ? $dane['stan'] : 'brak';

echo "Latarnia: " . $latarnia . "\n";
echo "Sektor: " . $sektor . "\n";
echo "Stan: " . $stan . "\n";
?>