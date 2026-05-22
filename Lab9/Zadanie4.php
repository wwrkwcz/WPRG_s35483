<?php
$data = [];
while ($line = trim(fgets(STDIN))) {
    $parts = explode('=', $line, 2);
    if (count($parts) == 2) {
        $data[$parts[0]] = $parts[1];
    }
}

$out = "Set-Cookie: " . $data['name'] . "=" . $data['value'];

if (isset($data['expires'])) $out .= "; Expires=" . $data['expires'];
if (isset($data['path'])) $out .= "; Path=" . $data['path'];
if (isset($data['domain'])) $out .= "; Domain=" . $data['domain'];
if (isset($data['secure']) && $data['secure'] === 'true') $out .= "; Secure";
if (isset($data['httponly']) && $data['httponly'] === 'true') $out .= "; HttpOnly";

echo $out . "\n";
?>