<?php
$linia1 = trim(fgets(STDIN));
$linia2 = trim(fgets(STDIN));
$dane = [];

$pary1 = explode('&', $linia1);
foreach ($pary1 as $para) {
    if (empty($para)) continue;
    $elementy = explode('=', $para);
    $dane[$elementy[0]] = isset($elementy[1]) ? $elementy[1] : '';
}

$pary2 = explode('&', $linia2);
foreach ($pary2 as $para) {
    if (empty($para)) continue;
    $elementy = explode('=', $para);
    $dane[$elementy[0]] = isset($elementy[1]) ? $elementy[1] : '';
}

ksort($dane);
$wynik = [];

foreach ($dane as $klucz => $wartosc) {
    $wynik[] = $klucz . '=' . $wartosc;
}

echo implode('&', $wynik) . "\n";
?>