<?php
$sekwencja = trim(fgets(STDIN));
$dlugosc = strlen($sekwencja);

$statystyki = [
    "A" => 0,
    "T" => 0,
    "G" => 0,
    "C" => 0
];

for ($i = 0; $i < $dlugosc; $i++) {
    $znak = $sekwencja[$i];

    if ($znak == "A") {
        $statystyki["A"] = $statystyki["A"] + 1;
    }
    if ($znak == "T") {
        $statystyki["T"] = $statystyki["T"] + 1;
    }
    if ($znak == "G") {
        $statystyki["G"] = $statystyki["G"] + 1;
    }
    if ($znak == "C") {
        $statystyki["C"] = $statystyki["C"] + 1;
    }
}

echo "A: " . $statystyki["A"] . "\n";
echo "T: " . $statystyki["T"] . "\n";
echo "G: " . $statystyki["G"] . "\n";
echo "C: " . $statystyki["C"] . "\n";

if ($dlugosc > 0) {
    $suma_gc = $statystyki["G"] + $statystyki["C"];
    $wynik_gc = ($suma_gc / $dlugosc) * 100;
    echo "GC: " . number_format($wynik_gc, 2, '.', '') . "%";
} else {
    echo "GC: 0.00%";
}