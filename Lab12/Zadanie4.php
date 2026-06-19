<?php

interface Resizable {
    public function resize(float $factor): void;
}

interface Drawable {
    public function draw(): string;
}

class Box implements Resizable, Drawable {
    private float $size = 1.0;

    public function resize(float $factor): void {
        $this->size *= $factor;
    }

    public function draw(): string {
        return "[BOX size=" . number_format($this->size, 2, '.', '') . "]";
    }

    public function getSize(): string {
        return number_format($this->size, 2, '.', '');
    }
}

$n = intval(trim(fgets(STDIN)));
$box = new Box();

for ($i = 0; $i < $n; $i++) {
    $line = trim(fgets(STDIN));
    if (empty($line)) continue;

    $parts = explode(' ', $line);
    $command = $parts[0];

    if ($command === 'DRAW') {
        echo $box->draw() . PHP_EOL;
    } elseif ($command === 'RESIZE') {
        $factor = floatval($parts[1]);
        $box->resize($factor);
    } elseif ($command === 'SIZE') {
        echo $box->getSize() . PHP_EOL;
    }
}