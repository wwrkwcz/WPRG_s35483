<?php
$wejscie = trim(fgets(STDIN));
$pary = explode('&', $wejscie);
$sectors = [];
$loads = [];

foreach ($pary as $para) {
    if (empty($para)) continue;
    $elementy = explode('=', $para);
    if ($elementy[0] === 'sector[]') {
        $sectors[] = isset($elementy[1]) ? $elementy[1] : '';
    } elseif ($elementy[0] === 'load[]') {
        $loads[] = isset($elementy[1]) ? (int)$elementy[1] : 0;
    }
}

$sums = [];
for ($i = 0; $i < count($sectors); $i++) {
    $s = $sectors[$i];
    $l = $loads[$i];
    if (!isset($sums[$s])) {
        $sums[$s] = 0;
    }
    $sums[$s] += $l;
}

foreach ($sums as $s => $sum) {
    echo $s . ": " . $sum . "\n";
}
?>