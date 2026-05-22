<?php
$url = trim(fgets(STDIN));
$parsed = parse_url($url);

if (isset($parsed['query'])) {
    parse_str($parsed['query'], $query_params);
    if (isset($query_params['PHPSESSID'])) {
        echo $query_params['PHPSESSID'] . "\n";
    } else {
        echo "NO SESSION\n";
    }
} else {
    echo "NO SESSION\n";
}
?>