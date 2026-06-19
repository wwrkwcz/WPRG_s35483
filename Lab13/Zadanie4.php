<?php
abstract class PaymentException extends RuntimeException {}
class InsufficientFundsException extends PaymentException {}
class CardDeclinedException extends PaymentException {}
class GatewayTimeoutException extends PaymentException {}

$n = (int)trim(fgets(STDIN));

for ($i = 0; $i < $n; $i++) {
    $line = trim(fgets(STDIN));
    if ($line === '') continue;
    
    $parts = explode(' ', $line, 2);
    $type = $parts[0];
    $message = $parts[1] ?? '';

    try {
        if ($type === 'FUNDS') {
            throw new InsufficientFundsException($message);
        } elseif ($type === 'DECLINED') {
            throw new CardDeclinedException($message);
        } elseif ($type === 'TIMEOUT') {
            throw new GatewayTimeoutException($message);
        } else {
            throw new InvalidArgumentException("unknown");
        }
    } catch (PaymentException $e) {
        echo get_class($e) . ": " . $e->getMessage() . "\n";
    } catch (InvalidArgumentException $e) {
        echo "OTHER: " . $e->getMessage() . "\n";
    }
}