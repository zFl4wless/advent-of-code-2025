<?php

namespace AOC2025\Day02;

require_once __DIR__ . '/../../vendor/autoload.php';

use AOC2025\AbstractSolution;

class Solution extends AbstractSolution
{
    public function solvePart1(string $input): int
    {
        $invalidIds = [];

        $ranges = explode(",", $input);
        foreach ($ranges as $range) {
            [$start, $end] = explode("-", $range);

            for ($i = (int)$start; $i <= (int)$end; $i++) {
                if (!$this->isIDValid((string)$i)) {
                    $invalidIds[] = $i;
                }
            }
        }

        return array_sum($invalidIds);
    }

    public function solvePart2(string $input): int
    {
        $invalidIds = [];

        $ranges = explode(",", $input);
        foreach ($ranges as $range) {
            [$start, $end] = explode("-", $range);

            for ($i = (int)$start; $i <= (int)$end; $i++) {
                if (!$this->isIDValidPart2((string)$i)) {
                    $invalidIds[] = $i;
                }
            }
        }

        return array_sum($invalidIds);
    }

    private function isIDValid(string $id): bool
    {
        $idLength = strlen($id);

        if ($idLength % 2 !== 0) {
            return true;
        }

        $halfLength = $idLength / 2;
        $firstHalf = substr($id, 0, $halfLength);
        $secondHalf = substr($id, $halfLength);

        if ($firstHalf === $secondHalf) {
            return false;
        }

        return true;
    }

    private function isIDValidPart2(string $id): bool
    {
        $idLength = strlen($id);

        for ($patternLength = 1; $patternLength <= intval($idLength / 2); $patternLength++) {
            if ($idLength % $patternLength !== 0) {
                continue;
            }

            $repetitions = $idLength / $patternLength;

            if ($repetitions < 2) {
                continue;
            }

            $pattern = substr($id, 0, $patternLength);

            if (str_repeat($pattern, $repetitions) === $id) {
                return false;
            }
        }

        return true;
    }
}

if (basename(__FILE__) === basename($_SERVER['PHP_SELF'])) {
    $solution = new Solution();
    echo "Day 02:\n";
    $solution->run();
}
