<?php
$wejscie = fgets(STDIN);
$procent = (int)trim($wejscie);

$ileHashy = floor($procent / 10);

echo "[";

for ($i = 0; $i < $ileHashy; $i = $i + 1) {
    echo "#";
}

if ($procent < 100) {
    echo ">";

    $aktualnaLiczbaZnakow = $ileHashy + 1;
    for ($j = $aktualnaLiczbaZnakow; $j < 10; $j = $j + 1) {
        echo " ";
    }
}

echo "] " . $procent . "%";