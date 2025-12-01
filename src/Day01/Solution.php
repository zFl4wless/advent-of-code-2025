<?php

namespace AOC2025\Day01;

require_once __DIR__ . '/../../vendor/autoload.php';

use AOC2025\AbstractSolution;

class Solution extends AbstractSolution
{
    public function solvePart1(string $input): int
    {
        $lines = explode("\n", $input);

        $dialPosition = 50;
        $zeroCount = 0;

        foreach ($lines as $line) {
            if (empty($line)) {
                continue;
            }

            $direction = $line[0];
            $steps = (int)substr($line, 1);

            if ($direction === 'L') {
                $dialPosition -= $steps;
                $dialPosition = (($dialPosition % 100) + 100) % 100;
            } else {
                $dialPosition += $steps;
                $dialPosition = $dialPosition % 100;
            }

            if ($dialPosition === 0) {
                $zeroCount++;
            }
        }

        return $zeroCount;
    }

    public function solvePart2(string $input): int
    {
        $lines = explode("\n", $input);

        $dialPosition = 50;
        $zeroCount = 0;

        foreach ($lines as $line) {
            if (empty($line)) {
                continue;
            }

            $direction = $line[0];
            $steps = (int)substr($line, 1);

            if ($direction === 'L') {
                if ($dialPosition > 0 && $steps >= $dialPosition) {
                    $zeroCount++;
                    $remainingSteps = $steps - $dialPosition;
                    $zeroCount += (int)($remainingSteps / 100);
                } else if ($dialPosition == 0) {
                    $zeroCount += (int)($steps / 100);
                }

                $dialPosition = (($dialPosition - $steps) % 100 + 100) % 100;
            } else {
                if ($dialPosition > 0 && $steps >= (100 - $dialPosition)) {
                    $zeroCount++;
                    $remainingSteps = $steps - (100 - $dialPosition);
                    $zeroCount += (int)($remainingSteps / 100);
                } else if ($dialPosition == 0) {
                    $zeroCount += (int)($steps / 100);
                }

                $dialPosition = ($dialPosition + $steps) % 100;
            }
        }

        return $zeroCount;
    }
}

if (basename(__FILE__) === basename($_SERVER['PHP_SELF'])) {
    $solution = new Solution();
    echo "Day 1:\n";
    $solution->run();
}
