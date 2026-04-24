<?php
function zamienParami(&$tablicaLiczb) {
    $dlugosc = count($tablicaLiczb);
    for ($i = 0; $i < $dlugosc - 1; $i += 2) {
        $zmiennaPomocnicza = $tablicaLiczb[$i];
        $tablicaLiczb[$i] = $tablicaLiczb[$i + 1];
        $tablicaLiczb[$i + 1] = $zmiennaPomocnicza;
    }
}

$liniaWejsciowa = trim(fgets(STDIN));
if ($liniaWejsciowa !== "") {
    $liczby = explode(" ", $liniaWejsciowa);
    zamienParami($liczby);
    echo implode(" ", $liczby);
}