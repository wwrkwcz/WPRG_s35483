<?php

trait Counter {
    private int $count = 0;

    public function inc(): void {
        $this->count++;
    }

    public function dec(): void {
        $this->count--;
    }

    public function get(): int {
        return $this->count;
    }
}

class widget {
    use Counter;
}

$n = intval(trim(fgets(STDIN)));
$widget = new widget();

for ($i = 0; $i < $n; $i++) {
    $command = trim(fgets(STDIN));
    if ($command === 'INC') {
        $widget->inc();
    } elseif ($command === 'DEC') {
        $widget->dec();
    } elseif ($command === 'GET') {
        echo $widget->get() . PHP_EOL;
    }
}