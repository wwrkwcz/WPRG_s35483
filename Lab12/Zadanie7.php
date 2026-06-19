<?php

class Animal {
    protected string $name;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function sound(): string {
        return "some sound";
    }
}

function describe(Animal $a): string {
    $ref = new ReflectionClass($a);
    $prop = $ref->getProperty('name');
    $prop->setAccessible(true);
    $name = $prop->getValue($a);

    return $name . " says " . $a->sound();
}

$n = intval(trim(fgets(STDIN)));

for ($i = 0; $i < $n; $i++) {
    $line = trim(fgets(STDIN));
    if (empty($line)) continue;

    $parts = explode(' ', $line, 2);
    $name = $parts[0];
    $sound = $parts[1];

    $animal = new class($name, $sound) extends Animal {
        private string $customSound;

        public function __construct(string $name, string $sound) {
            parent::__construct($name);
            $this->customSound = $sound;
        }

        public function sound(): string {
            return $this->customSound;
        }
    };

    echo describe($animal) . PHP_EOL;
}