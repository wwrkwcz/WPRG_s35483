<?php

interface Payable {
    public function pay(): float;
}

trait Identifiable {
    private int $id;

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getId(): int {
        return $this->id;
    }
}

abstract class Employee implements Payable {
    use Identifiable;

    protected string $name;

    public function __construct(int $id, string $name) {
        $this->setId($id);
        $this->name = $name;
    }

    public function describe(): string {
        $formattedPay = number_format($this->pay(), 2, '.', '');
        return "#" . $this->getId() . " " . $this->name . " -> " . $formattedPay;
    }
}

class HourlyEmployee extends Employee {
    private float $hours;
    private float $rate;

    public function __construct(int $id, string $name, float $hours, float $rate) {
        parent::__construct($id, $name);
        $this->hours = $hours;
        $this->rate = $rate;
    }

    public function pay(): float {
        return $this->hours * $this->rate;
    }
}

class SalariedEmployee extends Employee {
    private float $monthly;

    public function __construct(int $id, string $name, float $monthly) {
        parent::__construct($id, $name);
        $this->monthly = $monthly;
    }

    public function pay(): float {
        return $this->monthly;
    }
}

$n = intval(trim(fgets(STDIN)));
$employees = [];

for ($i = 0; $i < $n; $i++) {
    $line = trim(fgets(STDIN));
    if (empty($line)) continue;

    $parts = explode(' ', $line);
    $command = $parts[0];

    if ($command === 'HOURLY') {
        $id = intval($parts[1]);
        $name = $parts[2];
        $hours = floatval($parts[3]);
        $rate = floatval($parts[4]);
        $employees[$id] = new HourlyEmployee($id, $name, $hours, $rate);
    } elseif ($command === 'SALARIED') {
        $id = intval($parts[1]);
        $name = $parts[2];
        $monthly = floatval($parts[3]);
        $employees[$id] = new SalariedEmployee($id, $name, $monthly);
    } elseif ($command === 'DESCRIBE') {
        $id = intval($parts[1]);
        if (isset($employees[$id])) {
            echo $employees[$id]->describe() . PHP_EOL;
        }
    } elseif ($command === 'TOTAL') {
        $total = 0.0;
        foreach ($employees as $emp) {
            $total += $emp->pay();
        }
        echo number_format($total, 2, '.', '') . PHP_EOL;
    }
}