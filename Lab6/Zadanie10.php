<?php
$hasloUzytkownika = trim(fgets(STDIN));
$dlugosc = strlen($hasloUzytkownika);

if ($dlugosc < 8) {
    echo "Za krotkie";
    exit;
}

$maWielka = false; $maCyfre = false; $maSpacje = false;

for ($i = 0; $i < $dlugosc; $i++) {
    $z = $hasloUzytkownika[$i];
    if ($z >= 'A' && $z <= 'Z') $maWielka = true;
    if ($z >= '0' && $z <= '9') $maCyfre = true;
    if ($z == ' ') $maSpacje = true;
}

if (!$maWielka) echo "Brak wielkiej litery";
elseif (!$maCyfre) echo "Brak cyfry";
elseif ($maSpacje) echo "Zawiera spacje";
else echo "Haslo spelnia wymagania";