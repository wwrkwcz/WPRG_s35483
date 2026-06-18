<?php
$k = intval(trim(fgets(STDIN)));
$pdo = new PDO('sqlite::memory:');
$pdo->exec("CREATE TABLE accounts(id TEXT PRIMARY KEY, balance INTEGER)");

$ins = $pdo->prepare("INSERT INTO accounts VALUES (?, ?)");
for ($i = 0; $i < $k; $i++) {
    $p = explode('|', trim(fgets(STDIN)));
    $ins->execute([$p[0], intval($p[1])]);
}

$q = explode(' ', trim(fgets(STDIN)));
$from = $q[0]; $to = $q[1]; $amt = intval($q[2]);

$pdo->beginTransaction();
$fBal = $pdo->prepare("SELECT balance FROM accounts WHERE id = ?");
$fBal->execute([$from]); $bFrom = $fBal->fetchColumn();
$fBal->execute([$to]); $bTo = $fBal->fetchColumn();

if ($bFrom !== false && $bTo !== false && $amt > 0 && $bFrom >= $amt) {
    $upd = $pdo->prepare("UPDATE accounts SET balance = balance + ? WHERE id = ?");
    $upd->execute([-$amt, $from]);
    $upd->execute([$amt, $to]);
    $pdo->commit();
    echo "OK" . PHP_EOL;
} else {
    $pdo->rollBack();
    echo "FAILED" . PHP_EOL;
}

foreach ($pdo->query("SELECT * FROM accounts ORDER BY id ASC") as $r) {
    echo "{$r['id']}={$r['balance']}" . PHP_EOL;
}