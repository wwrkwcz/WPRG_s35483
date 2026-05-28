<?php
class Shape {
    public function area() {
        return 0.0;
    }
}

class Circle extends Shape {
    public $r;

    public function __construct($r) {
        $this->r = $r;
    }

    public function area() {
        return M_PI * $this->r * $this->r;
    }
}

class Rectangle extends Shape {
    public $w;
    public $h;

    public function __construct($w, $h) {
        $this->w = $w;
        $this->h = $h;
    }

    public function area() {
        return $this->w * $this->h;
    }
}

class Triangle extends Shape {
    public $b;
    public $h;

    public function __construct($b, $h) {
        $this->b = $b;
        $this->h = $h;
    }

    public function area() {
        return 0.5 * $this->b * $this->h;
    }
}

$n = intval(trim(fgets(STDIN)));
$sum = 0.0;

for ($i = 0; $i < $n; $i++) {
    $parts = explode(" ", trim(fgets(STDIN)));
    $type = $parts[0];

    if ($type === 'circle') {
        $shape = new Circle((float)$parts[1]);
    } elseif ($type === 'rectangle') {
        $shape = new Rectangle((float)$parts[1], (float)$parts[2]);
    } elseif ($type === 'triangle') {
        $shape = new Triangle((float)$parts[1], (float)$parts[2]);
    }

    $sum += $shape->area();
}

echo number_format($sum, 2, '.', '') . "\n";
?>