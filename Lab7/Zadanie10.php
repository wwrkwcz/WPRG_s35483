<?php
$linia1 = trim(fgets(STDIN));
if ($linia1 === '-') {
    $lista = [];
} else {
    $lista = explode(',', $linia1);
}

$m = (int)trim(fgets(STDIN));
$historia_usuniec = [];

for ($i = 0; $i < $m; $i++) {
    $linia_op = trim(fgets(STDIN));
    $czesci_op = explode(' ', $linia_op);
    $komenda = $czesci_op[0];
    $indeks = (int)$czesci_op[1];

    if ($komenda === 'USUN') {
        $dlugosc = (int)$czesci_op[2];
        $usuniete = array_splice($lista, $indeks, $dlugosc);
        if (count($usuniete) > 0) {
            $historia_usuniec[] = implode(',', $usuniete);
        } else {
            $historia_usuniec[] = '-';
        }
    } elseif ($komenda === 'WSTAW') {
        $elementy = explode(',', $czesci_op[2]);
        array_splice($lista, $indeks, 0, $elementy);
    }
}

if (count($lista) > 0) {
    echo "Final: " . implode(',', $lista) . "\n";
} else {
    echo "Final: pusto\n";
}

if (count($historia_usuniec) > 0) {
    echo "Usuniete: " . implode(';', $historia_usuniec) . "\n";
}
?>