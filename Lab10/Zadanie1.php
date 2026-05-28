<?php
class Person {
    public $name;
}

$name = trim(fgets(STDIN));
$p = new Person();
$p->name = $name;

echo "Hello, " . $p->name . "!\n";
?>