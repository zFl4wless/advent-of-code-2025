<?php

namespace AOC2025;

abstract class AbstractSolution
{
    protected string $inputFile;
    protected string $exampleFile;

    public function __construct()
    {
        $reflection = new \ReflectionClass($this);
        $dir = dirname($reflection->getFileName());
        $this->inputFile = $dir . '/input.txt';
        $this->exampleFile = $dir . '/example.txt';
    }

    /**
     * Read input file and return as string
     */
    protected function readInput(): string
    {
        if (!file_exists($this->inputFile)) {
            throw new \RuntimeException("Input file not found: {$this->inputFile}");
        }

        return trim(file_get_contents($this->inputFile));
    }

    /**
     * Read input file and return as array of lines
     */
    protected function readInputLines(): array
    {
        return explode("\n", $this->readInput());
    }

    /**
     * Read example file and return as string
     */
    protected function readExample(): string
    {
        if (!file_exists($this->exampleFile)) {
            throw new \RuntimeException("Example file not found: {$this->exampleFile}");
        }

        return trim(file_get_contents($this->exampleFile));
    }

    /**
     * Read example file and return as array of lines
     */
    protected function readExampleLines(): array
    {
        return explode("\n", $this->readExample());
    }

    /**
     * Solve Part 1
     */
    abstract public function solvePart1(string $input): mixed;

    /**
     * Solve Part 2
     */
    abstract public function solvePart2(string $input): mixed;

    /**
     * Run both parts
     */
    public function run(): void
    {
        $input = $this->readInput();

        echo "  Part 1: " . $this->solvePart1($input) . "\n";
        echo "  Part 2: " . $this->solvePart2($input) . "\n";
    }

    /**
     * Run with example input (useful for testing)
     */
    public function runExample(): void
    {
        $input = $this->readExample();

        echo "  Part 1 (Example): " . $this->solvePart1($input) . "\n";
        echo "  Part 2 (Example): " . $this->solvePart2($input) . "\n";
    }
}

