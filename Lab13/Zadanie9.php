<?php
class simpleLogger {
    public function log(string $level, string $message, array $context = []): void {
        $levelUpper = strtoupper($level);
        
        foreach ($context as $key => $value) {
            if (is_scalar($value)) {
                $message = str_replace('{' . $key . '}', $value, $message);
            }
        }
        
        echo "[$levelUpper] $message\n";
    }
}

$n = (int)trim(fgets(STDIN));
$logger = new simpleLogger();

for ($i = 0; $i < $n; $i++) {
    $line = trim(fgets(STDIN));
    if ($line === '') continue;

    $firstSpace = strpos($line, ' ');
    $level = substr($line, 0, $firstSpace);
    $rest = substr($line, $firstSpace + 1);

    $pipePos = strpos($rest, '|');
    if ($pipePos !== false) {
        $message = substr($rest, 0, $pipePos);
        $contextStr = substr($rest, $pipePos + 1);
    } else {
        $message = $rest;
        $contextStr = '';
    }

    $context = [];
    if (!empty($contextStr)) {
        $pairs = explode(',', $contextStr);
        foreach ($pairs as $pair) {
            if (strpos($pair, '=') !== false) {
                list($k, $v) = explode('=', $pair, 2);
                $context[trim($k)] = trim($v);
            }
        }
    }

    $logger->log($level, $message, $context);
}