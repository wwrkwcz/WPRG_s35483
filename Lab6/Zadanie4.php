<?php
$linia = fgets(STDIN);
$sekundyWejsciowe = (int)trim($linia);

$dni = floor($sekundyWejsciowe / 86400);
$resztaSekund = $sekundyWejsciowe % 86400;

$godziny = floor($resztaSekund / 3600);
$resztaSekund = $resztaSekund % 3600;

$minuty = floor($resztaSekund / 60);
$sekundy = $resztaSekund % 60;

if ($sekundyWejsciowe >= 86400) {
    echo $dni . "d " . $godziny . "h " . $minuty . "m " . $sekundy . "s";
} elseif ($sekundyWejsciowe >= 3600) {
    echo $godziny . "h " . $minuty . "m " . $sekundy . "s";
} elseif ($sekundyWejsciowe >= 60) {
    echo $minuty . "m " . $sekundy . "s";
} else {
    echo $sekundy . "s";
}