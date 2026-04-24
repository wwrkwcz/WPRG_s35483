<?php
$linia1 = trim(fgets(STDIN));
if ($linia1 === '-') {
    $lista = [];
} else {
    $lista = explode(',', $linia1);
}

$linia2 = trim(fgets(STDIN));
$parametry = explode(' ', $linia2);
$start = (int)$parametry[0];
$dlugosc = (int)$parametry[1];

if ($start >= count($lista) || $start < 0 || $dlugosc == 0) {
    $okno = [];
} else {
    $okno = array_slice($lista, $start, $dlugosc);
}

if (count($okno) > 0) {
    echo "Window: " . implode(',', $okno) . "\n";
} else {
    echo "Window: brak\n";
}

if (count($lista) > 0) {
    echo "Source: " . implode(',', $lista) . "\n";
} else {
    echo "Source: pusto\n";
}
?>