<?php
$n = (int)trim(fgets(STDIN));

for ($i = 0; $i < $n; $i++) {
    $line = trim(fgets(STDIN));
    
    try {
        $data = json_decode($line, true, 512, JSON_THROW_ON_ERROR);
        
        if (!isset($data['name']) || !is_string($data['name'])) {
            throw new UnexpectedValueException("missing name");
        }
        
        echo "OK: " . $data['name'] . "\n";
    } catch (JsonException $e) {
        echo "JSON: " . $e->getMessage() . "\n";
    } catch (UnexpectedValueException $e) {
        echo "STRUCT: " . $e->getMessage() . "\n";
    }
}