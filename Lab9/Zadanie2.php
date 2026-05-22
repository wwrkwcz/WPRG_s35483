<?php
$auth_header = trim(fgets(STDIN));
$base64 = str_replace('Basic ', '', $auth_header);
$decoded = base64_decode($base64);
$parts = explode(':', $decoded, 2);

echo $parts[0] . "\n";
echo $parts[1] . "\n";
?>