<?php
class InsufficientFundsException extends RuntimeException {
    private int $balance;
    private int $requested;

    public function __construct(int $balance, int $requested) {
        parent::__construct("need $requested, have $balance");
        $this->balance = $balance;
        $this->requested = $requested;
    }
}

class Account {
    private int $balance;

    public function __construct(int $balance) {
        $this->balance = $balance;
    }

    public function debit(int $amount): void {
        if ($this->balance < $amount) {
            throw new InsufficientFundsException($this->balance, $amount);
        }
        $this->balance -= $amount;
    }

    public function credit(int $amount): void {
        $this->balance += $amount;
    }

    public function getBalance(): int {
        return $this->balance;
    }
    
    public function setBalance(int $balance): void {
        $this->balance = $balance;
    }
}

class Transaction {
    private Account $account;
    private int $snapshot = 0;

    public function __construct(Account $account) {
        $this->account = $account;
    }

    public function begin(): void {
        $this->snapshot = $this->account->getBalance();
    }

    public function commit(): void {
    }

    public function rollBack(): void {
        $this->account->setBalance($this->snapshot);
    }
}

function transfer(Account $from, Account $to, int $amount): void {
    $tFrom = new Transaction($from);
    $tTo = new Transaction($to);

    $tFrom->begin();
    $tTo->begin();

    try {
        $from->debit($amount);
        $to->credit($amount);
        $tFrom->commit();
        $tTo->commit();
    } catch (Throwable $e) {
        $tFrom->rollBack();
        $tTo->rollBack();
        throw $e;
    }
}

$firstLine = trim(fgets(STDIN));
if ($firstLine !== '') {
    list($balA, $balB) = explode(' ', $firstLine);

    $accountA = new Account((int)$balA);
    $accountB = new Account((int)$balB);

    $nLine = trim(fgets(STDIN));
    if ($nLine !== '') {
        $n = (int)$nLine;

        for ($i = 0; $i < $n; $i++) {
            $line = fgets(STDIN);
            if ($line === false) break;
            $line = trim($line);
            if ($line === '') {
                $i--;
                continue;
            }

            list($cmd, $fromName, $toName, $amount) = explode(' ', $line);
            $amount = (int)$amount;

            $fromAcc = ($fromName === 'A') ? $accountA : $accountB;
            $toAcc = ($toName === 'A') ? $accountA : $accountB;

            try {
                transfer($fromAcc, $toAcc, $amount);
                echo "OK A={$accountA->getBalance()} B={$accountB->getBalance()}\n";
            } catch (InsufficientFundsException $e) {
                echo "FAIL: " . $e->getMessage() . " | A={$accountA->getBalance()} B={$accountB->getBalance()}\n";
            }
        }
    }
}