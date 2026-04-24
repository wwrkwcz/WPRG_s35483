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

$do_sprawdzenia = ['sygnal', 'kanal', 'znacznik'];

foreach ($do_sprawdzenia as $k) {
    $present = 0;
    $set = 0;

    if (isset($dane[$k])) {
        $present = 1;
        if ($dane[$k] !== 'NULL') {
            $set = 1;
        }
    }
    echo $k . ": present=" . $present . " set=" . $set . "\n";
}
?>