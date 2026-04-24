<?php
$mapaMorse = [
    'a' => '.-',    'b' => '-...',  'c' => '-.-.',
    'd' => '-..',   'e' => '.',      'f' => '..-.',
    'g' => '--.',   'h' => '....',  'i' => '..',
    'j' => '.---',  'k' => '-.-',    'l' => '.-..',
    'm' => '--',    'n' => '-.',     'o' => '---',
    'p' => '.--.',  'q' => '--.-',  'r' => '.-.',
    's' => '...',   't' => '-',      'u' => '..-',
    'v' => '...-',  'w' => '.--',    'x' => '-..-',
    'y' => '-.--',  'z' => '--..'
];

$wejscie = trim(fgets(STDIN));
$dlugosc = strlen($wejscie);
$wynik = "";

for ($i = 0; $i < $dlugosc; $i = $i + 1) {
    $znak = $wejscie[$i];

    if ($znak == " ") {
        $wynik = $wynik . " / ";
    } elseif (isset($mapaMorse[$znak])) {
        $wynik = $wynik . $mapaMorse[$znak];

        if ($i + 1 < $dlugosc && $wejscie[$i + 1] != " ") {
            $wynik = $wynik . " ";
        }
    }
}

echo $wynik;