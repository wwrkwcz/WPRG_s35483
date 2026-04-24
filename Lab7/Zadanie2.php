<?php
$wejscie = trim(fgets(STDIN));
$pary = explode('&', $wejscie);
$echa = [];

foreach ($pary as $para) {
    if (empty($para)) continue;
    $elementy = explode('=', $para);
    if ($elementy[0] === 'echo[]') {
        $wartosc = isset($elementy[1]) ? $elementy[1] : '';
        $echa[] = $wartosc;
    }
}

$liczba = count($echa);
echo "Liczba: " . $liczba . "\n";

if ($liczba > 0) {
    echo "Echa: " . implode(',', $echa) . "\n";
} else {
    echo "Echa: brak\n";
}
?>