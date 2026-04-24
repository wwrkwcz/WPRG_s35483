<?php
$linia = fgets(STDIN);
$n = (int)trim($linia);

$liniaLiczb = fgets(STDIN);
$tablicaLiczb = explode(" ", trim($liniaLiczb));

$minWartosc = (int)$tablicaLiczb[0];
$maxWartosc = (int)$tablicaLiczb[0];
$sumaLiczb = 0;

foreach ($tablicaLiczb as $tekstLiczba) {
    $liczba = (int)$tekstLiczba;

    if ($liczba < $minWartosc) {
        $minWartosc = $liczba;
    }

    if ($liczba > $maxWartosc) {
        $maxWartosc = $liczba;
    }

    $sumaLiczb = $sumaLiczb + $liczba;
}

$sredniaWartosc = $sumaLiczb / $n;

echo "Min: " . $minWartosc . "\n";
echo "Max: " . $maxWartosc . "\n";
echo "Srednia: " . number_format($sredniaWartosc, 2, '.', '') . "\n";