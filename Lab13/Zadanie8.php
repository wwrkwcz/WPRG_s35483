<?php
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    if ($errno === E_USER_WARNING || $errno === E_USER_NOTICE) {
        throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
    }
    return false;
});

$n = (int)trim(fgets(STDIN));

for ($i = 0; $i < $n; $i++) {
    $line = trim(fgets(STDIN));
    if ($line === '') continue;

    $parts = explode(' ', $line, 2);
    $level = $parts[0];
    $message = $parts[1] ?? '';

    try {
        if ($level === 'WARNING') {
            trigger_error($message, E_USER_WARNING);
        } elseif ($level === 'NOTICE') {
            trigger_error($message, E_USER_NOTICE);
        }
    } catch (ErrorException $e) {
        echo "$level: " . $e->getMessage() . "\n";
    }
}