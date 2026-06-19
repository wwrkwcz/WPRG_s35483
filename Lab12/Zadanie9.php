<?php

class Cart {
    private array $items = [];

    public function add(string $name): void {
        $this->items[] = $name;
    }

    public function count(): int {
        return count($this->items);
    }

    public function list(): string {
        return implode(',', $this->items);
    }

    public function __serialize(): array {
        return $this->items;
    }

    public function __unserialize(array $data): void {
        $this->items = $data;
    }
}

$n = intval(trim(fgets(STDIN)));
$cart = new Cart();
$blob = null;

for ($i = 0; $i < $n; $i++) {
    $line = trim(fgets(STDIN));
    if (empty($line)) continue;

    $parts = explode(' ', $line, 2);
    $command = $parts[0];

    if ($command === 'ADD') {
        $cart->add($parts[1]);
    } elseif ($command === 'SAVE') {
        $blob = serialize($cart);
    } elseif ($command === 'CLEAR') {
        $cart = new Cart();
    } elseif ($command === 'LOAD') {
        if ($blob !== null) {
            $cart = unserialize($blob);
        }
    } elseif ($command === 'LIST') {
        echo $cart->list() . PHP_EOL;
    } elseif ($command === 'COUNT') {
        echo $cart->count() . PHP_EOL;
    }
}