<?php
$handle = fopen("php://stdin", "r");

if ($handle) {
    $n = (int)trim(fgets($handle));

    for ($i = 0; $i < $n; $i++) {
        $line = fgets($handle);
        if ($line !== false) {
            $id = rtrim($line, "\r\n");

            if (preg_match('/^[a-z0-9]{26}$/', $id)) {
                echo "VALID\n";
            } else {
                echo "INVALID\n";
            }
        }
    }
    fclose($handle);
}
?>