<?php
$n = (int)trim(fgets(STDIN));
$cart = [];

for ($i = 0; $i < $n; $i++) {
    $line = trim(fgets(STDIN));
    $parts = explode(' ', $line);
    $cmd = $parts[0];

    if ($cmd === 'ADD') {
        $name = $parts[1];
        $price = (int)$parts[2];
        if (!isset($cart[$name])) {
            $cart[$name] = ['price' => $price, 'qty' => 0];
        }
        $cart[$name]['qty']++;
    } elseif ($cmd === 'REMOVE') {
        $name = $parts[1];
        if (isset($cart[$name])) {
            $cart[$name]['qty']--;
            if ($cart[$name]['qty'] <= 0) {
                unset($cart[$name]);
            }
        }
    } elseif ($cmd === 'SHOW') {
        if (empty($cart)) {
            echo "EMPTY\n";
        } else {
            ksort($cart);
            $total = 0;
            foreach ($cart as $name => $item) {
                $sum = $item['qty'] * $item['price'];
                $total += $sum;
                echo "$name x {$item['qty']} = $sum\n";
            }
            echo "TOTAL: $total\n";
        }
    }
}
?>