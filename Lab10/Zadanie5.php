<?php
class Product {
    public static $count = 0;
    public $name;

    public function __construct($name) {
        $this->name = $name;
        self::$count++;
    }

    public static function getCount() {
        return self::$count;
    }
}

$n = intval(trim(fgets(STDIN)));

for ($i = 0; $i < $n; $i++) {
    $name = trim(fgets(STDIN));
    new Product($name);
}

echo Product::getCount() . "\n";
?>