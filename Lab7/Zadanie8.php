<?php
$wejscie = trim(fgets(STDIN));
$pary = explode('&', $wejscie);
$dane = [];

foreach ($pary as $para) {
    if (empty($para)) continue;
    $elementy = explode('=', $para);
    $dane[$elementy[0]] = (int)$elementy[1];
}

uksort($dane, function($k1, $k2) use ($dane) {
    if ($dane[$k1] == $dane[$k2]) {
        return strcmp($k1, $k2);
    }
    return $dane[$k2] <=> $dane[$k1];
});

foreach ($dane as $k => $v) {
    echo $k . ": " . $v . "\n";
}
?>