<?php

namespace AOC2025\Day04;
require_once __DIR__ . '/../../vendor/autoload.php';

use AOC2025\AbstractSolution;
use AOC2025\Utils;

class Solution extends AbstractSolution
{
    public function solvePart1(string $input): mixed
    {
        $result = 0;

        $grid = Utils::parseGrid($input);
        $maxCol = count($grid);
        foreach ($grid as $y => $row) {
            $maxRow = count($row);

            foreach ($row as $x => $value) {
                if ($value !== '@') {
                    continue;
                }

                $neighbours = 0;
                for ($dy = -1; $dy <= 1; $dy++) {
                    for ($dx = -1; $dx <= 1; $dx++) {
                        if ($dy === 0 && $dx === 0) {
                            continue;
                        }

                        $nx = $x + $dx;
                        $ny = $y + $dy;
                        if ($nx >= 0 && $nx < $maxRow && $ny >= 0 && $ny < $maxCol) {
                            if ($grid[$ny][$nx] === '@') {
                                $neighbours++;
                            }
                        }
                    }
                }

                if ($neighbours < 4) {
                    $result++;
                }
            }
        }

        return $result;
    }

    public function solvePart2(string $input): mixed
    {
        $grid = Utils::parseGrid($input);
        $totalRemoved = 0;

        while (true) {
            $toRemove = [];
            $maxCol = count($grid);

            foreach ($grid as $y => $row) {
                $maxRow = count($row);

                foreach ($row as $x => $value) {
                    if ($value !== '@') {
                        continue;
                    }

                    $neighbours = 0;
                    for ($dy = -1; $dy <= 1; $dy++) {
                        for ($dx = -1; $dx <= 1; $dx++) {
                            if ($dy === 0 && $dx === 0) {
                                continue;
                            }

                            $nx = $x + $dx;
                            $ny = $y + $dy;
                            if ($nx >= 0 && $nx < $maxRow && $ny >= 0 && $ny < $maxCol) {
                                if ($grid[$ny][$nx] === '@') {
                                    $neighbours++;
                                }
                            }
                        }
                    }

                    if ($neighbours < 4) {
                        $toRemove[] = [$y, $x];
                    }
                }
            }

            if (empty($toRemove)) {
                break;
            }

            foreach ($toRemove as [$y, $x]) {
                $grid[$y][$x] = '.';
            }

            $totalRemoved += count($toRemove);
        }

        return $totalRemoved;
    }
}

if (basename(__FILE__) === basename($_SERVER['PHP_SELF'])) {
    $solution = new Solution();
    echo "Day 04:\n";
    $solution->run();
}
