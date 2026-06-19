<?php
$n = (int)trim(fgets(STDIN));

try {
    if ($n < 0) {
        throw new InvalidArgumentException("negative");
    }
    echo "ok: $n\n";
} catch (InvalidArgumentException $e) {
    echo "caught: " . $e->getMessage() . "\n";
}