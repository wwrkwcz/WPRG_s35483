<?php
$wejscie = trim(fgets(STDIN));
$pary = explode('&', $wejscie);
$trace = [];
$allow = [];

foreach ($pary as $para) {
    if (empty($para)) continue;
    $elementy = explode('=', $para);
    if ($elementy[0] === 'trace[]') {
        $trace[] = isset($elementy[1]) ? $elementy[1] : '';
    } elseif ($elementy[0] === 'allow[]') {
        $allow[] = isset($elementy[1]) ? $elementy[1] : '';
    }
}

$keep = [];
foreach ($trace as $t) {
    if (in_array($t, $allow)) {
        $keep[] = $t;
    }
}

if (count($keep) > 0) {
    echo "Keep: " . implode(',', $keep) . "\n";
} else {
    echo "Keep: brak\n";
}
?>