<?php
function obliczVAT(float $nettoCena, int $stawkaVAT = 23): array {
    $vat = $nettoCena * $stawkaVAT / 100;
    $brutto = $nettoCena + $vat;

    $tablica = [];
    $tablica['netto'] = $nettoCena;
    $tablica['vat'] = $vat;
    $tablica['brutto'] = $brutto;

    return $tablica;
}

$linia1 = trim(fgets(STDIN));
$linia2 = trim(fgets(STDIN));

$netto = (float)$linia1;

if ($linia2 == "") {
    $stawka = 23;
} else {
    $stawka = (int)$linia2;
}

$wynik = obliczVAT($netto, $stawka);

echo "Netto: " . number_format($wynik['netto'], 2, '.', '') . " zl\n";
echo "VAT ($stawka%): " . number_format($wynik['vat'], 2, '.', '') . " zl\n";
echo "Brutto: " . number_format($wynik['brutto'], 2, '.', '') . " zl\n";