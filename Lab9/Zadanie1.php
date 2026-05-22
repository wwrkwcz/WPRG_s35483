<?php
$header = trim(fgets(STDIN));
$search = trim(fgets(STDIN));
$found = false;

if (!empty($header)) {
    $cookies = explode(';', $header);
    foreach ($cookies as $cookie) {
        $parts = explode('=', trim($cookie), 2);
        if (count($parts) == 2 && $parts[0] === $search) {
            echo $parts[1] . "\n";
            $found = true;
            break;
        }
    }
}

if (!$found) {
    echo "Cookie not found\n";
}
?>