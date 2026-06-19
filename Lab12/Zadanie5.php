<?php

trait Walker {
    public function move(): string {
        return "walk";
    }
}

trait Runner {
    public function move(): string {
        return "run";
    }
}

class Athlete {
    use Walker, Runner {
        Runner::move insteadof Walker;
        Walker::move as walkslow;
    }
}

$n = intval(trim(fgets(STDIN)));
$athlete = new Athlete();

for ($i = 0; $i < $n; $i++) {
    $command = trim(fgets(STDIN));
    if ($command === 'MOVE') {
        echo $athlete->move() . PHP_EOL;
    } elseif ($command === 'WALK') {
        echo $athlete->walkslow() . PHP_EOL;
    }
}