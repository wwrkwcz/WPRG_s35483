<?php
$name = trim(fgets(STDIN));
$value = trim(fgets(STDIN));

echo "Set-Cookie: " . $name . "=" . $value . "\n";
?>