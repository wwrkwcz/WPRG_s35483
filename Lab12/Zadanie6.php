<?php

trait HasName {
    abstract public function getName(): string;
}

trait HasPrice {
    abstract public function getPrice(): float;
}

trait Describable {
    use HasName, HasPrice;

    public function describe(): string {
        $formattedPrice = number_format($this->getPrice(), 2, '.', '');
        return $this->getName() . " @ " . $formattedPrice . " zl";
    }
}

class Product {
    use Describable;

    private string $name;
    private float $price;

    public function __construct(string $name, float $price) {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getPrice(): float {
        return $this->price;
    }
}

$n = intval(trim(fgets(STDIN)));

for ($i = 0; $i < $n; $i++) {
    $line = trim(fgets(STDIN));
    if (empty($line)) continue;

    $parts = explode(' ', $line, 2);
    $name = $parts[0];
    $price = floatval($parts[1]);

    $product = new Product($name, $price);
    echo $product->describe() . PHP_EOL;
}