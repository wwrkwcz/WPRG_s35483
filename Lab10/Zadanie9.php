<?php
class Bag {
    private $data = [];

    public function __set($name, $value) {
        $this->data[$name] = $value;
    }

    public function __get($name) {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
        return "undefined";
    }
}

$n = intval(trim(fgets(STDIN)));
$bag = new Bag();

for ($i = 0; $i < $n; $i++) {
    $parts = explode(" ", trim(fgets(STDIN)));
    $cmd = $parts[0];

    if ($cmd === 'SET') {
        $key = $parts[1];
        $value = $parts[2];
        $bag->$key = $value;
    } elseif ($cmd === 'GET') {
        $key = $parts[1];
        echo $bag->$key . "\n";
    }
}
?>