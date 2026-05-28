<?php
class PaymentMethod {
    const TYPE_CREDITCARD = 1;
    const TYPE_CASH = 2;
    const TYPE_TRANSFER = 3;
    const TYPE_BLIK = 4;

    public static function nameOf($code) {
        if ($code == self::TYPE_CREDITCARD) return "CREDITCARD";
        if ($code == self::TYPE_CASH) return "CASH";
        if ($code == self::TYPE_TRANSFER) return "TRANSFER";
        if ($code == self::TYPE_BLIK) return "BLIK";
        return "UNKNOWN";
    }
}

$n = intval(trim(fgets(STDIN)));

for ($i = 0; $i < $n; $i++) {
    $code = intval(trim(fgets(STDIN)));
    echo PaymentMethod::nameOf($code) . "\n";
}
?>