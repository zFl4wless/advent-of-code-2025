<?php

namespace AOC2025\Day03;

require_once __DIR__ . '/../../vendor/autoload.php';

use AOC2025\AbstractSolution;

class Solution extends AbstractSolution
{
    public function solvePart1(string $input): mixed
    {
        $lines = explode("\n", $input);

        $jolts = [];

        foreach ($lines as $line) {
            if (empty($line)) {
                continue;
            }

            $batteries = str_split($line);
            $maxJoltage = 0;

            for ($i = 0; $i < count($batteries) - 1; $i++) {
                for ($j = $i + 1; $j < count($batteries); $j++) {
                    $joltage = (int)($batteries[$i] . $batteries[$j]);
                    $maxJoltage = max($maxJoltage, $joltage);
                }
            }

            $jolts[] = $maxJoltage;
        }

        return array_sum($jolts);
    }

    public function solvePart2(string $input): int
    {
        $lines = explode("\n", $input);
        return 0;
    }
}

if (basename(__FILE__) === basename($_SERVER['PHP_SELF'])) {
    $solution = new Solution();
    echo "Day 03:\n";
    $solution->run();
}
