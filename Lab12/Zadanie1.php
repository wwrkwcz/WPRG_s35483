<?php

interface Greetable {
    public function greet(): string;
}

class Person implements Greetable {
    private string $name;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function greet(): string {
        return "Hello, " . $this->name . "!";
    }
}

$line = trim(fgets(STDIN));
if ($line !== '') {
    $person = new Person($line);
    echo $person->greet() . PHP_EOL;
}