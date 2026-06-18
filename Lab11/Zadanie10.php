<?php
$k = intval(trim(fgets(STDIN)));
$pdo = new PDO('sqlite::memory:', null, null, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$pdo->exec("CREATE TABLE sales(category TEXT, product TEXT, qty INTEGER, price INTEGER)");

$lines = [];
for ($i = 0; $i < $k; $i++) $lines[] = trim(fgets(STDIN));

try {
    $pdo->beginTransaction();
    $ins = $pdo->prepare("INSERT INTO sales VALUES (?, ?, ?, ?)");
    foreach ($lines as $l) {
        $p = explode(';', $l);
        $ins->execute([$p[0], $p[1], intval($p[2]), intval($p[3])]);
    }
    $pdo->commit();
} catch (Exception $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    echo "ERROR" . PHP_EOL;
    exit;
}

$tot = 0;
foreach ($pdo->query("SELECT category, SUM(qty * price) as ctot FROM sales GROUP BY category ORDER BY ctot DESC, category ASC") as $r) {
    echo "{$r['category']}:{$r['ctot']}" . PHP_EOL;
    $tot += $r['ctot'];
}
echo "TOTAL:{$tot}" . PHP_EOL;