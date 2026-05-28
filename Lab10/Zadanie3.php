<?php
class Counter {
    private $value = 0;

    public function increment() {
        $this->value++;
    }

    public function decrement() {
        $this->value--;
    }

    public function get() {
        return $this->value;
    }
}

$n = intval(trim(fgets(STDIN)));
$c = new Counter();

for ($i = 0; $i < $n; $i++) {
    $cmd = trim(fgets(STDIN));
    if ($cmd === 'INC') {
        $c->increment();
    } elseif ($cmd === 'DEC') {
        $c->decrement();
    } elseif ($cmd === 'GET') {
        echo $c->get() . "\n";
    }
}
?>