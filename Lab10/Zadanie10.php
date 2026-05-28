<?php
class Account {
    protected $owner;
    protected $balance;

    public function __construct($owner, $balance) {
        $this->owner = $owner;
        $this->balance = $balance;
    }

    public function deposit($amount) {
        $this->balance += $amount;
    }

    public function withdraw($amount) {
        if ($this->balance >= $amount) {
            $this->balance -= $amount;
        }
    }

    public function getBalance() {
        return $this->balance;
    }

    public function getOwner() {
        return $this->owner;
    }
}

class SavingsAccount extends Account {
    private $rate;

    public function __construct($owner, $balance, $rate) {
        parent::__construct($owner, $balance);
        $this->rate = $rate;
    }

    public function applyInterest() {
        $this->balance += $this->balance * $this->rate / 100;
    }
}

class CheckingAccount extends Account {
    private $fee;

    public function __construct($owner, $balance, $fee) {
        parent::__construct($owner, $balance);
        $this->fee = $fee;
    }

    public function withdraw($amount) {
        parent::withdraw($amount + $this->fee);
    }
}

$n = intval(trim(fgets(STDIN)));
$accounts = [];

for ($i = 0; $i < $n; $i++) {
    $parts = explode(" ", trim(fgets(STDIN)));
    $cmd = $parts[0];

    if ($cmd === 'CREATE_SAVINGS') {
        $id = $parts[1];
        $accounts[$id] = new SavingsAccount($parts[2], (float)$parts[3], (float)$parts[4]);
    } elseif ($cmd === 'CREATE_CHECKING') {
        $id = $parts[1];
        $accounts[$id] = new CheckingAccount($parts[2], (float)$parts[3], (float)$parts[4]);
    } elseif ($cmd === 'DEPOSIT') {
        $id = $parts[1];
        $accounts[$id]->deposit((float)$parts[2]);
    } elseif ($cmd === 'WITHDRAW') {
        $id = $parts[1];
        $accounts[$id]->withdraw((float)$parts[2]);
    } elseif ($cmd === 'INTEREST') {
        $id = $parts[1];
        $accounts[$id]->applyInterest();
    } elseif ($cmd === 'BALANCE') {
        $id = $parts[1];
        echo number_format($accounts[$id]->getBalance(), 2, '.', '') . "\n";
    }
}
?>