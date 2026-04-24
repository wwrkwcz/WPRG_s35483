<?php
$n = (int)trim(fgets(STDIN));
$liczbaKrokow = 0;
$elementyCiagu = [];

$obecna = $n;
while (true) {
    $elementyCiagu[] = $obecna;
    if ($obecna == 1) break;

    if ($obecna % 2 == 0) {
        $obecna = $obecna / 2;
    } else {
        $obecna = 3 * $obecna + 1;
    }
    $liczbaKrokow++;
}

echo implode(" → ", $elementyCiagu) . "\n";
echo "Kroki: " . $liczbaKrokow;