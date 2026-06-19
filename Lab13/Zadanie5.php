<?php
class NotFoundException extends RuntimeException {}
class ForbiddenException extends RuntimeException {}
class BadRequestException extends RuntimeException {}

$n = (int)trim(fgets(STDIN));

for ($i = 0; $i < $n; $i++) {
    $line = trim(fgets(STDIN));
    if ($line === '') continue;

    $parts = explode(' ', $line, 2);
    $code = $parts[0];
    $message = $parts[1] ?? '';

    try {
        if ($code === '404') {
            throw new NotFoundException($message);
        } elseif ($code === '403') {
            throw new ForbiddenException($message);
        } elseif ($code === '400') {
            throw new BadRequestException($message);
        } else {
            throw new RuntimeException($message);
        }
    } catch (NotFoundException | ForbiddenException $e) {
        echo "CLIENT: " . $e->getMessage() . "\n";
    } catch (BadRequestException $e) {
        echo "VALIDATION: " . $e->getMessage() . "\n";
    } catch (RuntimeException $e) {
        echo "SERVER: " . $e->getMessage() . "\n";
    }
}