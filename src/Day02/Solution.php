<?php
namespace AOC2025\Day02;
require_once __DIR__ . '/../../vendor/autoload.php';
use AOC2025\AbstractSolution;
class Solution extends AbstractSolution
{
    public function solvePart1(string $input): mixed
    {
        // TODO: Implement part 1 solution
        $lines = explode("\n", $input);
        return 0;
    }
    public function solvePart2(string $input): mixed
    {
        // TODO: Implement part 2 solution
        $lines = explode("\n", $input);
        return 0;
    }
}
// Run solution if this file is executed directly
if (basename(__FILE__) === basename($_SERVER['PHP_SELF'])) {
    $solution = new Solution();
    echo "Day 02:\n";
    $solution->run();
}
