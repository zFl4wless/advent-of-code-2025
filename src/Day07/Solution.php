<?php

namespace AOC2025\Day07;

require_once __DIR__ . '/../../vendor/autoload.php';

use AOC2025\AbstractSolution;

class Solution extends AbstractSolution
{
    public function solvePart1(string $input): int
    {
        $lines = explode("\n", $input);
        $lines = array_filter($lines, fn($line) => trim($line) !== '');
        $lines = array_values($lines);

        if (empty($lines)) {
            return 0;
        }

        $grid = [];
        $startX = 0;
        $startY = 0;

        foreach ($lines as $y => $line) {
            $grid[$y] = str_split($line);
            $sPos = strpos($line, 'S');
            if ($sPos !== false) {
                $startX = $sPos;
                $startY = $y;
            }
        }

        $height = count($grid);
        $width = count($grid[0]);

        $beams = [[$startX, $startY + 1]];
        $splitCount = 0;

        $visited = [];

        while (!empty($beams)) {
            $newBeams = [];

            foreach ($beams as $beam) {
                list($x, $y) = $beam;

                if ($y < 0 || $y >= $height || $x < 0 || $x >= $width) {
                    continue;
                }

                $key = "$x,$y";
                if (isset($visited[$key])) {
                    continue;
                }
                $visited[$key] = true;

                $cell = $grid[$y][$x];

                if ($cell === '^') {
                    $splitCount++;

                    $newBeams[] = [$x - 1, $y + 1];
                    $newBeams[] = [$x + 1, $y + 1];
                } else {
                    $newBeams[] = [$x, $y + 1];
                }
            }

            $beams = $newBeams;
        }

        return $splitCount;
    }

    public function solvePart2(string $input): int
    {
        $lines = explode("\n", $input);
        $lines = array_filter($lines, fn($line) => trim($line) !== '');
        $lines = array_values($lines);

        if (empty($lines)) {
            return 0;
        }

        $grid = [];
        $startX = 0;
        $startY = 0;

        foreach ($lines as $y => $line) {
            $grid[$y] = str_split($line);
            $sPos = strpos($line, 'S');
            if ($sPos !== false) {
                $startX = $sPos;
                $startY = $y;
            }
        }

        $height = count($grid);
        $width = count($grid[0]);

        $currentPaths = [];
        $currentPaths["$startX," . ($startY + 1)] = 1;

        while (!empty($currentPaths)) {
            $nextPaths = [];

            foreach ($currentPaths as $posKey => $count) {
                list($x, $y) = explode(',', $posKey);
                $x = (int)$x;
                $y = (int)$y;

                if ($y < 0 || $y >= $height || $x < 0 || $x >= $width) {
                    continue;
                }

                $cell = $grid[$y][$x];

                if ($cell === '^') {
                    $newKey = ($x - 1) . ',' . ($y + 1);
                    if (!isset($nextPaths[$newKey])) {
                        $nextPaths[$newKey] = 0;
                    }
                    $nextPaths[$newKey] += $count;

                    $newKey = ($x + 1) . ',' . ($y + 1);
                } else {
                    $newKey = $x . ',' . ($y + 1);
                }
                if (!isset($nextPaths[$newKey])) {
                    $nextPaths[$newKey] = 0;
                }
                $nextPaths[$newKey] += $count;
            }

            $currentPaths = $nextPaths;
        }

        $memo = [];

        return $this->countTimelines($grid, $startX, $startY + 1, $height, $width, $memo);
    }

    private function countTimelines($grid, $x, $y, $height, $width, &$memo): int
    {
        $key = "$x,$y";
        if (isset($memo[$key])) {
            return $memo[$key];
        }

        if ($y < 0 || $y >= $height || $x < 0 || $x >= $width) {
            return 1;
        }

        $cell = $grid[$y][$x];

        if ($cell === '^') {
            $leftTimelines = $this->countTimelines($grid, $x - 1, $y + 1, $height, $width, $memo);
            $rightTimelines = $this->countTimelines($grid, $x + 1, $y + 1, $height, $width, $memo);
            $result = $leftTimelines + $rightTimelines;
        } else {
            $result = $this->countTimelines($grid, $x, $y + 1, $height, $width, $memo);
        }

        $memo[$key] = $result;
        return $result;
    }
}

if (basename(__FILE__) === basename($_SERVER['PHP_SELF'])) {
    $solution = new Solution();
    echo "Day 07:\n";
    $solution->run();
}
