<?php
class InsufficientFundsException extends RuntimeException {
    private float $balance;
    private float $requested;

    public function __construct(float $balance, float $requested) {
        $x = number_format($requested, 2, '.', '');
        $y = number_format($balance, 2, '.', '');
        parent::__construct("need $x, have $y");
        $this->balance = $balance;
        $this->requested = $requested;
    }

    public function shortfall(): float {
        return $this->requested - $this->balance;
    }
}

$n = (int)trim(fgets(STDIN));

for ($i = 0; $i < $n; $i++) {
    $line = trim(fgets(STDIN));
    if ($line === '') continue;
    list($balance, $requested) = explode(' ', $line);
    $balance = (float)$balance;
    $requested = (float)$requested;

    try {
        if ($balance >= $requested) {
            $newBalance = $balance - $requested;
            echo "OK: $balance-=$requested = $newBalance\n";
        } else {
            throw new InsufficientFundsException($balance, $requested);
        }
    } catch (InsufficientFundsException $e) {
        $z = number_format($e->shortfall(), 2, '.', '');
        echo "FAIL: " . $e->getMessage() . " (short $z)\n";
    }
}