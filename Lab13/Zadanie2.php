<?php
function divide(int $a, int $b): int {
    if ($b === 0) {
        throw new DivisionByZeroError("div by zero");
    }
    return intdiv($a, $b);
}

$n = (int)trim(fgets(STDIN));

for ($i = 0; $i < $n; $i++) {
    $line = trim(fgets(STDIN));
    if ($line === '') continue;
    list($a, $b) = explode(' ', $line);
    
    try {
        $res = divide((int)$a, (int)$b);
        echo "RESULT: $res\n";
    } catch (Throwable $e) {
        echo "ERROR: " . $e->getMessage() . "\n";
    } finally {
        echo "END\n";
    }
}