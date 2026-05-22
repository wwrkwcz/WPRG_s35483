<?php
$first_line = trim(fgets(STDIN));
$parts = explode(' ', $first_line);
$method = $parts[0] ?? '';
$path = $parts[1] ?? '';

$host = "NO HOST";
$cookie_header = "NO COOKIES";
$cookie_count = 0;

while (($line = trim(fgets(STDIN))) !== '') {
    $header_parts = explode(':', $line, 2);
    if (count($header_parts) == 2) {
        $h_name = trim($header_parts[0]);
        $h_val = trim($header_parts[1]);

        if ($h_name === 'Host') {
            $host = $h_val;
        } elseif ($h_name === 'Cookie') {
            $cookie_header = $h_val;
            $cookies = explode(';', $h_val);
            $cookie_count = count(array_filter(array_map('trim', $cookies)));
        }
    }
}

echo "$method\n";
echo "$path\n";
echo "$host\n";
echo "$cookie_header\n";
echo "$cookie_count\n";
?>