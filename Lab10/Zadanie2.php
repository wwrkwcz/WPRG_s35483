<?php
class Person {
    public $name;
    public $age;

    public function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }

    public function describe() {
        return $this->name . " (" . $this->age . ")";
    }
}

$name = trim(fgets(STDIN));
$age = trim(fgets(STDIN));

$p = new Person($name, $age);
echo $p->describe() . "\n";
?>