<?php

class Person {
    public string $name = '';
    private int $age = 0;
    protected string $email = '';
    public function getName(): string { return $this->name; }
    public function setAge(int $a): void { $this->age = $a; }
    private function secret(): void {}
}

$n = intval(trim(fgets(STDIN)));
$reflect = new ReflectionClass('Person');

for ($i = 0; $i < $n; $i++) {
    $command = trim(fgets(STDIN));
    
    if ($command === 'METHODS') {
        echo count($reflect->getMethods()) . PHP_EOL;
    } elseif ($command === 'PUBLIC_METHODS') {
        echo count($reflect->getMethods(ReflectionMethod::IS_PUBLIC)) . PHP_EOL;
    } elseif ($command === 'PROPS') {
        echo count($reflect->getProperties()) . PHP_EOL;
    } elseif ($command === 'PUBLIC_PROPS') {
        echo count($reflect->getProperties(ReflectionProperty::IS_PUBLIC)) . PHP_EOL;
    }
}