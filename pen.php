<?php

class OutOfInk extends Exception {}
class PenClosed extends Exception {}

class Pen {
    private int $inkAmount;
    private int $inkCapacity;
    private bool $isOpen;

    public function __construct(int $capacity = 4096) {
        $this->inkCapacity = $capacity;
        $this->inkAmount = $this->inkCapacity;
        $this->isOpen = false;
    }

    public function getInkAmount(): int {
        return $this->inkAmount;
    }

    public function getInkCapacity(): int {
        return $this->inkCapacity;
    }

    public function open(): void {
        $this->isOpen = true;
    }

    public function close(): void {
        $this->isOpen = false;
    }

    public function isOpen(): bool {
        return $this->isOpen;
    }

    public function write(string $message): int {
        if (!$this->isOpen) {
            throw new PenClosed("Ручка закрита! Спочатку відкрийте її.");
        }
        if ($this->inkAmount <= 0) {
            throw new OutOfInk("Немає чорнила!");
        }

        $messageLength = strlen($message);

        if ($messageLength <= $this->inkAmount) {
            $charsWritten = $messageLength;
        } else {
            $charsWritten = $this->inkAmount;
        }

        $this->inkAmount -= $charsWritten;
        return $charsWritten;
    }

    public function refill(): void {
        $this->inkAmount = $this->inkCapacity;
    }

    public function __toString(): string {
        if ($this->isOpen) {
            $state = "відкрита";
        } else {
            $state = "закрита";
        }

        return "Ручка ({$state}) - Чорнила: {$this->getInkAmount()} / {$this->getInkCapacity()}";
    }
}

try {
    $pen = new Pen();
    $symbols = $pen->write("Hello, Santa!"); 

    $pen->open(); 
    $symbols = $pen->write("Hello, Santa!");
    echo $symbols . PHP_EOL;              
    echo $pen . PHP_EOL;

    $pen->close();

    $lowInkPen = new Pen(5);
    $lowInkPen->open();
    $symbols = $lowInkPen->write("Привіт, світ!");
    echo $symbols . PHP_EOL;
    echo $lowInkPen . PHP_EOL;

    $symbols = $lowInkPen->write("Додатковий текст");

} catch (OutOfInk $e) {
    echo "Чорнила закінчилися!" . PHP_EOL;
} catch (PenClosed $e) {
    echo $e->getMessage() . PHP_EOL;
}

?>