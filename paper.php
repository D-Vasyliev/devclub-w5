<?php

class OutOfSpace extends Exception {}

class Paper {
    private int $maxSymbols;
    private int $symbols;
    private string $content;

    public function __construct() {
        $this->maxSymbols = 4096;
        $this->symbols = 0;
        $this->content = '';
    }

    public function getMaxSymbols(): int {
        return $this->maxSymbols;
    }

    public function getSymbols(): int {
        return $this->symbols;
    }

    public function addContent(string $message): int {
        $messageLength = strlen($message);
        $spaceAvailable = $this->maxSymbols - $this->symbols;

        if ($spaceAvailable <= 0) {
            throw new OutOfSpace("Not enough space to add more content");
        }

        if ($messageLength < $spaceAvailable) {
            $toAdd = $messageLength;
        } else {
            $toAdd = $spaceAvailable;
        }

        $this->content .= substr($message, 0, $toAdd);
        $this->symbols += $toAdd;

        echo "Message Length: {$messageLength}, Space Available: {$spaceAvailable}, To Add: {$toAdd}\n";

        return $toAdd;
    }

    public function show(): void {
        echo $this->content;
    }

    public function __toString(): string {
        return $this->content;
    }
}

// Приклад використання
try {
    $paper = new Paper();
    $symbols = $paper->addContent("Hello, Santa!");
    echo "Added {$symbols} characters. Current symbols: {$paper->getSymbols()}\n";
    echo $paper . "\n";

    $symbols = $paper->addContent(" Putin Huilooooo!!!!!!");
    echo "Added {$symbols} characters. Current symbols: {$paper->getSymbols()}\n";
    echo $paper . "\n";

    $symbols = $paper->addContent(" This is a test of the paper.");
    echo "Added {$symbols} characters. Current symbols: {$paper->getSymbols()}\n";
    echo $paper . "\n";

} catch (OutOfSpace $e) {
    echo "Error: " . $e->getMessage() . "\n";
}