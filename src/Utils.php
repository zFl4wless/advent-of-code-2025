<?php

namespace AOC2025;

/**
 * Collection of utility functions for Advent of Code solutions
 */
class Utils
{
    /**
     * Parse input into a 2D grid/array
     */
    public static function parseGrid(string $input): array
    {
        return array_map('str_split', explode("\n", trim($input)));
    }

    /**
     * Get all numbers from a string
     */
    public static function extractNumbers(string $text): array
    {
        preg_match_all('/-?\d+/', $text, $matches);
        return array_map('intval', $matches[0]);
    }

    /**
     * Split input into groups separated by blank lines
     */
    public static function splitByBlankLines(string $input): array
    {
        return array_filter(
            array_map('trim', explode("\n\n", trim($input))),
            fn($s) => $s !== ''
        );
    }

    /**
     * Get neighbors of a position in a 2D grid (4 directions)
     */
    public static function getNeighbors4(int $row, int $col, int $maxRow, int $maxCol): array
    {
        $neighbors = [];
        $directions = [[-1, 0], [1, 0], [0, -1], [0, 1]]; // up, down, left, right

        foreach ($directions as [$dr, $dc]) {
            $newRow = $row + $dr;
            $newCol = $col + $dc;

            if ($newRow >= 0 && $newRow < $maxRow && $newCol >= 0 && $newCol < $maxCol) {
                $neighbors[] = [$newRow, $newCol];
            }
        }

        return $neighbors;
    }

    /**
     * Get neighbors of a position in a 2D grid (8 directions, including diagonals)
     */
    public static function getNeighbors8(int $row, int $col, int $maxRow, int $maxCol): array
    {
        $neighbors = [];

        for ($dr = -1; $dr <= 1; $dr++) {
            for ($dc = -1; $dc <= 1; $dc++) {
                if ($dr === 0 && $dc === 0) continue;

                $newRow = $row + $dr;
                $newCol = $col + $dc;

                if ($newRow >= 0 && $newRow < $maxRow && $newCol >= 0 && $newCol < $maxCol) {
                    $neighbors[] = [$newRow, $newCol];
                }
            }
        }

        return $neighbors;
    }

    /**
     * Calculate Manhattan distance between two points
     */
    public static function manhattanDistance(int $x1, int $y1, int $x2, int $y2): int
    {
        return abs($x1 - $x2) + abs($y1 - $y2);
    }

    /**
     * Calculate GCD (Greatest Common Divisor)
     */
    public static function gcd(int $a, int $b): int
    {
        while ($b !== 0) {
            $temp = $b;
            $b = $a % $b;
            $a = $temp;
        }
        return abs($a);
    }

    /**
     * Calculate LCM (Least Common Multiple)
     */
    public static function lcm(int $a, int $b): int
    {
        return abs($a * $b) / self::gcd($a, $b);
    }

    /**
     * Transpose a 2D array
     */
    public static function transpose(array $grid): array
    {
        if (empty($grid)) {
            return [];
        }

        return array_map(null, ...$grid);
    }

    /**
     * Rotate a 2D grid 90 degrees clockwise
     */
    public static function rotateClockwise(array $grid): array
    {
        return array_map('array_reverse', self::transpose($grid));
    }

    /**
     * Count occurrences of each element in an array
     */
    public static function frequencies(array $items): array
    {
        return array_count_values($items);
    }

    /**
     * Check if all elements in array satisfy a condition
     */
    public static function all(array $items, callable $predicate): bool
    {
        return array_all($items, fn($item) => $predicate($item));
    }

    /**
     * Check if any element in array satisfies a condition
     */
    public static function any(array $items, callable $predicate): bool
    {
        return array_any($items, fn($item) => $predicate($item));
    }
}

