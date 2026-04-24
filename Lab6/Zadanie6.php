<?php
function naSystem(int $liczba, int $podstawa): string {
    $cyfry = "0123456789ABCDEF";

    if ($liczba < $podstawa) {
        return $cyfry[$liczba];
    }

    $iloraz = floor($liczba / $podstawa);
    $reszta = $liczba % $podstawa;

    return naSystem((int)$iloraz, $podstawa) . $cyfry[$reszta];
}

$wejscieLiczba = (int)trim(fgets(STDIN));
$wejsciePodstawa = (int)trim(fgets(STDIN));

echo naSystem($wejscieLiczba, $wejsciePodstawa);