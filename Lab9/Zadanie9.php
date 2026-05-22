<?php
$n = (int)trim(fgets(STDIN));
$sessions = [];

for ($i = 0; $i < $n; $i++) {
    $line = trim(fgets(STDIN));
    $parts = explode(' ', $line, 4);
    $cmd = $parts[0];
    $sid = $parts[1] ?? '';

    if ($cmd === 'START') {
        if (isset($sessions[$sid])) {
            echo "SESSION EXISTS\n";
        } else {
            $sessions[$sid] = [];
        }
    } elseif ($cmd === 'SET') {
        $key = $parts[2];
        $val = $parts[3];
        if (!isset($sessions[$sid])) {
            echo "SESSION NOT FOUND\n";
        } else {
            $sessions[$sid][$key] = $val;
        }
    } elseif ($cmd === 'GET') {
        $key = $parts[2];
        if (!isset($sessions[$sid])) {
            echo "SESSION NOT FOUND\n";
        } elseif (!isset($sessions[$sid][$key])) {
            echo "KEY NOT FOUND\n";
        } else {
            echo $sessions[$sid][$key] . "\n";
        }
    } elseif ($cmd === 'DESTROY') {
        if (!isset($sessions[$sid])) {
            echo "SESSION NOT FOUND\n";
        } else {
            unset($sessions[$sid]);
        }
    } elseif ($cmd === 'LIST') {
        if (!isset($sessions[$sid])) {
            echo "SESSION NOT FOUND\n";
        } elseif (empty($sessions[$sid])) {
            echo "EMPTY SESSION\n";
        } else {
            $keys = array_keys($sessions[$sid]);
            sort($keys);
            foreach ($keys as $k) {
                echo $k . "\n";
            }
        }
    }
}
?>