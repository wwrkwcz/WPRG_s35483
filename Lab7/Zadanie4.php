<?php
$n = (int)trim(fgets(STDIN));
$dane = [];

for ($i = 0; $i < $n; $i++) {
    $linia = trim(fgets(STDIN));
    if (empty($linia)) continue;

    $elementy = explode('=', $linia);
    $klucz = $elementy[0];
    $wartosc = isset($elementy[1]) ? $elementy[1] : '';
    $dane[$klucz] = $wartosc;
}

if (count($dane) > 0) {
    $klucze = array_keys($dane);
    $wartosci = array_values($dane);
    echo "Klucze: " . implode(',', $klucze) . "\n";
    echo "Wartosci: " . implode(',', $wartosci) . "\n";
} else {
    echo "Klucze: brak\n";
    echo "Wartosci: brak\n";
}
?>