<?php

abstract class Shape {
    abstract public function area(): float;

    public function describe(): string {
        $className = get_class($this);
        $formattedArea = number_format($this->area(), 2, '.', '');
        return $className . ": " . $formattedArea;
    }
}

class Square extends Shape {
    private float $side;

    public function __construct(float $side) {
        $this->side = $side;
    }

    public function area(): float {
        return pow($this->side, 2);
    }
}

class Circle extends Shape {
    private float $r;

    public function __construct(float $r) {
        $this->r = $r;
    }

    public function area(): float {
        return M_PI * pow($this->r, 2);
    }
}

$n = intval(trim(fgets(STDIN)));

for ($i = 0; $i < $n; $i++) {
    $line = trim(fgets(STDIN));
    if (empty($line)) continue;
    
    $parts = explode(' ', $line);
    $type = $parts[0];
    $value = floatval($parts[1]);

    if ($type === 'square') {
        $shape = new Square($value);
        echo $shape->describe() . PHP_EOL;
    } elseif ($type === 'circle') {
        $shape = new Circle($value);
        echo $shape->describe() . PHP_EOL;
    }
}