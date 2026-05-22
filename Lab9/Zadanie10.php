<?php
$n = (int)trim(fgets(STDIN));
$sessions = [];
$req_count = 0;

for ($i = 0; $i < $n; $i++) {
    $req_count++;

    $req_line = '';
    while (($line = fgets(STDIN)) !== false) {
        $req_line = trim($line);
        if ($req_line !== '') break;
    }
    if ($req_line === '') break;

    $req_parts = explode(' ', $req_line);
    $path_full = $req_parts[1];
    $path_parts = explode('?', $path_full, 2);
    $path = $path_parts[0];
    $query = $path_parts[1] ?? '';

    $auth_header = null;
    $cookie_header = null;

    while (($header_line = fgets(STDIN)) !== false) {
        $header_line = trim($header_line);
        if ($header_line === '') break;

        $h_parts = explode(':', $header_line, 2);
        if (count($h_parts) == 2) {
            $h_name = trim($h_parts[0]);
            $h_val = trim($h_parts[1]);
            if ($h_name === 'Authorization') $auth_header = $h_val;
            if ($h_name === 'Cookie') $cookie_header = $h_val;
        }
    }

    $phpsessid = null;
    if ($cookie_header) {
        $cookies = explode(';', $cookie_header);
        foreach ($cookies as $c) {
            $c_parts = explode('=', trim($c), 2);
            if ($c_parts[0] === 'PHPSESSID' && isset($c_parts[1])) {
                $phpsessid = $c_parts[1];
            }
        }
    }

    if ($auth_header !== null && strpos($auth_header, 'Basic ') === 0) {
        $decoded = base64_decode(substr($auth_header, 6));
        if ($decoded === 'admin:secret') {
            echo "200 AUTH OK user=admin\n";
        } else {
            echo "401 UNAUTHORIZED\n";
        }
        continue;
    }

    if ($path === '/start') {
        $new_id = "sess_" . $req_count;
        $sessions[$new_id] = [];
        echo "200 SESSION STARTED id=$new_id\n";
        continue;
    }

    if ($path === '/set') {
        if ($phpsessid !== null && isset($sessions[$phpsessid])) {
            $params = explode('=', $query, 2);
            if (count($params) === 2) {
                $sessions[$phpsessid][$params[0]] = $params[1];
            }
            echo "200 SET OK\n";
        } else {
            echo "403 NO SESSION\n";
        }
        continue;
    }

    if ($phpsessid !== null) {
        if (isset($sessions[$phpsessid])) {
            $vars_count = count($sessions[$phpsessid]);
            echo "200 SESSION ACTIVE vars=$vars_count\n";
        } else {
            echo "200 SESSION EXPIRED\n";
        }
        continue;
    }

    echo "200 OK\n";
}
?>