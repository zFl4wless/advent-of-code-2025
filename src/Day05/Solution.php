<?php

namespace AOC2025\Day05;

require_once __DIR__ . '/../../vendor/autoload.php';

use AOC2025\AbstractSolution;

class Solution extends AbstractSolution
{
    public function solvePart1(string $input): int
    {
        $freshCount = 0;

        $ranges = [];

        $lines = explode("\n", $input);
        foreach ($lines as $line) {
            if (empty(trim($line))) {
                continue;
            }

            if (str_contains($line, '-')) {
                [$start, $end] = explode('-', $line);
                $ranges[] = [intval($start), intval($end)];
            } else {
                $num = intval($line);
                $isSpoiled = true;
                foreach ($ranges as [$start, $end]) {
                    if ($num >= $start && $num <= $end) {
                        $isSpoiled = false;
                        break;
                    }
                }

                if (!$isSpoiled) {
                    $freshCount++;
                }
            }
        }

        return $freshCount;
    }

    public function solvePart2(string $input): mixed
    {
        $ranges = [];

        $lines = explode("\n", $input);
        foreach ($lines as $line) {
            if (empty(trim($line))) {
                continue;
            }

            if (str_contains($line, '-')) {
                [$start, $end] = explode('-', $line);
                $ranges[] = [intval($start), intval($end)];
            }
        }

        usort($ranges, fn($a, $b) => $a[0] <=> $b[0]);

        $merged = [];
        foreach ($ranges as [$start, $end]) {
            if (empty($merged)) {
                $merged[] = [$start, $end];
            } else {
                $last = &$merged[count($merged) - 1];

                if ($start <= $last[1] + 1) {
                    $last[1] = max($last[1], $end);
                } else {
                    $merged[] = [$start, $end];
                }
            }
        }

        $count = 0;
        foreach ($merged as [$start, $end]) {
            $count += $end - $start + 1;
        }

        return $count;
    }
}

if (basename(__FILE__) === basename($_SERVER['PHP_SELF'])) {
    $solution = new Solution();
    echo "Day 05:\n";
    $solution->run();
}
