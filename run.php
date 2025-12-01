<?php

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Run Advent of Code solutions
 *
 * Usage:
 *   php run.php        # Run all days
 *   php run.php 1      # Run day 1
 *   php run.php 1 -e   # Run day 1 with example input
 */

// Parse arguments
$day = null;
$useExample = false;

foreach (array_slice($argv, 1) as $arg) {
    if ($arg === '--example' || $arg === '-e') {
        $useExample = true;
    } elseif (is_numeric($arg)) {
        $day = (int)$arg;
    }
}

/**
 * Run a single day's solution
 */
function runDay(int $day, bool $useExample = false): void
{
    $dayNum = sprintf('%02d', $day);
    $className = "AOC2025\\Day$dayNum\\Solution";

    if (!class_exists($className)) {
        echo "  ❌ Day $day not found or not yet implemented\n";
        return;
    }

    echo "🎄 Day $day" . ($useExample ? " (Example)" : "") . " 🎄\n";
    echo str_repeat("=", 50) . "\n";

    $start = microtime(true);

    try {
        $solution = new $className();

        if ($useExample) {
            $solution->runExample();
        } else {
            $solution->run();
        }
    } catch (Exception $e) {
        echo "  ❌ Error: " . $e->getMessage() . "\n";
    }

    $elapsed = microtime(true) - $start;
    echo sprintf("\n  ⏱️  Time: %.4f seconds\n", $elapsed);
}

/**
 * Run all days
 */
function runAllDays(): void
{
    $totalTime = 0;
    $completedDays = 0;

    echo "🎄 Advent of Code 2025 - All Solutions 🎄\n";
    echo str_repeat("=", 50) . "\n\n";

    for ($d = 1; $d <= 12; $d++) {
        $dayNum = sprintf('%02d', $d);
        $className = "AOC2025\\Day$dayNum\\Solution";

        if (!class_exists($className)) {
            continue;
        }

        echo "Day $d:\n";
        $start = microtime(true);

        try {
            $solution = new $className();
            $solution->run();
            $completedDays++;
        } catch (Exception $e) {
            echo "  ❌ Error: " . $e->getMessage() . "\n";
        }

        $elapsed = microtime(true) - $start;
        $totalTime += $elapsed;
        echo sprintf("  ⏱️  Time: %.4f seconds\n\n", $elapsed);
    }

    echo str_repeat("=", 50) . "\n";
    echo sprintf("Completed: %d/12 days\n", $completedDays);
    echo sprintf("Total time: %.4f seconds\n", $totalTime);
}

// Execute
if ($day !== null) {
    if ($day < 1 || $day > 12) {
        echo "❌ Day must be between 1 and 12\n";
        exit(1);
    }
    runDay($day, $useExample);
} else {
    runAllDays();
}

