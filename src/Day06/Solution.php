<?php

namespace AOC2025\Day06;

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

        $operatorLine = array_pop($lines);

        $maxLen = strlen($operatorLine);
        foreach ($lines as $line) {
            $maxLen = max($maxLen, strlen($line));
        }

        foreach ($lines as &$line) {
            if (strlen($line) < $maxLen) {
                $line = str_pad($line, $maxLen);
            }
        }
        unset($line);

        if (strlen($operatorLine) < $maxLen) {
            $operatorLine = str_pad($operatorLine, $maxLen);
        }

        $problems = [];
        $start = 0;

        for ($col = 0; $col < $maxLen; $col++) {
            $isEmptyColumn = true;
            foreach ($lines as $line) {
                if (isset($line[$col]) && trim($line[$col]) !== '') {
                    $isEmptyColumn = false;
                    break;
                }
            }
            if ($isEmptyColumn && trim($operatorLine[$col]) === '') {
                if ($col > $start) {
                    $problems[] = ['start' => $start, 'end' => $col - 1];
                }
                $start = $col + 1;
            }
        }

        if ($start < $maxLen) {
            $problems[] = ['start' => $start, 'end' => $maxLen - 1];
        }

        $results = [];

        foreach ($problems as $problem) {
            $start = $problem['start'];
            $end = $problem['end'];

            $operator = null;
            for ($i = $start; $i <= $end; $i++) {
                $char = $operatorLine[$i];
                if ($char === '+' || $char === '*') {
                    $operator = $char;
                    break;
                }
            }

            if ($operator === null) {
                continue;
            }

            $numbers = [];
            foreach ($lines as $line) {
                $numStr = '';
                for ($i = $start; $i <= $end; $i++) {
                    if (isset($line[$i])) {
                        $numStr .= $line[$i];
                    }
                }
                $numStr = trim($numStr);
                if ($numStr !== '' && is_numeric($numStr)) {
                    $numbers[] = (int)$numStr;
                }
            }

            if (empty($numbers)) {
                continue;
            }

            $result = $numbers[0];
            for ($i = 1; $i < count($numbers); $i++) {
                if ($operator === '+') {
                    $result += $numbers[$i];
                } else {
                    $result *= $numbers[$i];
                }
            }

            $results[] = $result;
        }

        return array_sum($results);
    }

    public function solvePart2(string $input): int
    {
        $lines = explode("\n", $input);

        $lines = array_filter($lines, fn($line) => trim($line) !== '');
        $lines = array_values($lines);

        if (empty($lines)) {
            return 0;
        }

        $operatorLine = array_pop($lines);

        $maxLen = strlen($operatorLine);
        foreach ($lines as $line) {
            $maxLen = max($maxLen, strlen($line));
        }

        foreach ($lines as &$line) {
            if (strlen($line) < $maxLen) {
                $line = str_pad($line, $maxLen);
            }
        }
        unset($line);

        if (strlen($operatorLine) < $maxLen) {
            $operatorLine = str_pad($operatorLine, $maxLen);
        }

        $problems = [];
        $start = 0;

        for ($col = 0; $col < $maxLen; $col++) {
            $isEmptyColumn = true;
            foreach ($lines as $line) {
                if (isset($line[$col]) && trim($line[$col]) !== '') {
                    $isEmptyColumn = false;
                    break;
                }
            }
            if ($isEmptyColumn && trim($operatorLine[$col]) === '') {
                if ($col > $start) {
                    $problems[] = ['start' => $start, 'end' => $col - 1];
                }
                $start = $col + 1;
            }
        }

        if ($start < $maxLen) {
            $problems[] = ['start' => $start, 'end' => $maxLen - 1];
        }

        $results = [];

        foreach ($problems as $problem) {
            $start = $problem['start'];
            $end = $problem['end'];

            $operator = null;
            for ($i = $start; $i <= $end; $i++) {
                $char = $operatorLine[$i];
                if ($char === '+' || $char === '*') {
                    $operator = $char;
                    break;
                }
            }

            if ($operator === null) {
                continue;
            }

            $numbers = [];

            for ($col = $end; $col >= $start; $col--) {
                $digits = '';
                foreach ($lines as $line) {
                    if (isset($line[$col])) {
                        $char = $line[$col];
                        if (trim($char) !== '') {
                            $digits .= $char;
                        }
                    }
                }

                if ($digits !== '' && is_numeric($digits)) {
                    $numbers[] = (int)$digits;
                }
            }

            if (empty($numbers)) {
                continue;
            }

            $result = $numbers[0];
            for ($i = 1; $i < count($numbers); $i++) {
                if ($operator === '+') {
                    $result += $numbers[$i];
                } else {
                    $result *= $numbers[$i];
                }
            }

            $results[] = $result;
        }

        return array_sum($results);
    }
}

if (basename(__FILE__) === basename($_SERVER['PHP_SELF'])) {
    $solution = new Solution();
    echo "Day 06:\n";
    $solution->run();
}
