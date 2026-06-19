<?php
class DatabaseException extends RuntimeException {}
class OrderSaveFailedException extends RuntimeException {}

function saveOrder(int $id): void {
    throw new DatabaseException("db error for order $id");
}

function placeOrder(int $id): void {
    try {
        saveOrder($id);
    } catch (DatabaseException $e) {
        throw new OrderSaveFailedException("cannot save order $id", 0, $e);
    }
}

$n = (int)trim(fgets(STDIN));

for ($i = 0; $i < $n; $i++) {
    $id = trim(fgets(STDIN));
    if ($id === '') continue;
    $id = (int)$id;

    try {
        placeOrder($id);
    } catch (OrderSaveFailedException $e) {
        echo "OUTER: " . $e->getMessage() . "\n";
        if ($e->getPrevious()) {
            echo "  INNER: " . $e->getPrevious()->getMessage() . "\n";
        }
    }
}