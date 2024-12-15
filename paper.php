<?php

class OutOfSpace extends Exception {}

class Paper {
    private static $maxSymbols = 4096;
    private $symbols;
    private $content;

    public function __construct() {
        $this->symbols = 0;
        $this->content = '';
    }

    public function getMaxSymbols() {
        return self::$maxSymbols;
    }

    public function getSymbols() {
        return $this->symbols;
    }

    public function addContent($message) {
        $messageLength = strlen($message);

        $spaceAvailable = self::$maxSymbols - $this->symbols;
        if ($spaceAvailable <= 0) {
            throw new OutOfSpace("Not enough space to add more content");
        }

        if ($messageLength < $spaceAvailable) {
            $toAdd = $messageLength;
        } else {
            $toAdd = $spaceAvailable;
        }

        // Додаємо частину повідомлення, яку можемо
        $this->content .= substr($message, 0, $toAdd);
        $this->symbols += $toAdd;

        echo "Message Length: {$messageLength}, Space Available: {$spaceAvailable}, To Add: {$toAdd}\n";

        return $toAdd;
    }

    public function show() {
        echo $this->content;
    }

    public function __toString() {
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

?>