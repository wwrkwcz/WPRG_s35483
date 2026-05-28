<?php
class Box {
    private $label;

    public function __construct($label) {
        $this->label = $label;
    }

    public function setLabel($label) {
        $this->label = $label;
    }

    public function getLabel() {
        return $this->label;
    }
}

$n = intval(trim(fgets(STDIN)));
$objects = [];

for ($i = 0; $i < $n; $i++) {
    $parts = explode(" ", trim(fgets(STDIN)));
    $cmd = $parts[0];

    if ($cmd === 'CREATE') {
        $objects[$parts[1]] = new Box($parts[2]);
    } elseif ($cmd === 'REF') {
        $objects[$parts[2]] = $objects[$parts[1]];
    } elseif ($cmd === 'CLONE') {
        $objects[$parts[2]] = clone $objects[$parts[1]];
    } elseif ($cmd === 'SET') {
        $objects[$parts[1]]->setLabel($parts[2]);
    } elseif ($cmd === 'GET') {
        echo $objects[$parts[1]]->getLabel() . "\n";
    }
}
?>