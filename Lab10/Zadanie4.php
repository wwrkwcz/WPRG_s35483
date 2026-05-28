<?php
class Animal {
    public $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function sound() {
        return "some sound";
    }
}

class Dog extends Animal {
    public function sound() {
        return "woof";
    }
}

class Cat extends Animal {
    public function sound() {
        return "meow";
    }
}

class Cow extends Animal {
    public function sound() {
        return "moo";
    }
}

$n = intval(trim(fgets(STDIN)));

for ($i = 0; $i < $n; $i++) {
    $line = explode(" ", trim(fgets(STDIN)));
    $type = $line[0];
    $name = $line[1];

    if ($type === 'dog') {
        $animal = new Dog($name);
    } elseif ($type === 'cat') {
        $animal = new Cat($name);
    } elseif ($type === 'cow') {
        $animal = new Cow($name);
    } else {
        $animal = new Animal($name);
    }

    echo $animal->name . " says " . $animal->sound() . "\n";
}
?>