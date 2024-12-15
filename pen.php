<?php

class OutOfInk extends Exception {}

class Pen {
    private int $inkAmount;
    private int $inkCapacity;

    public function __construct(int $capacity = 4096) {
        $this->inkCapacity = $capacity;
        $this->inkAmount = $this->inkCapacity;
    }

    public function getInkAmount(): int {
        return $this->inkAmount;
    }

    public function getInkCapacity(): int {
        return $this->inkCapacity;
    }

    public function write(string $message): int {
        if ($this->inkAmount <= 0) {
            throw new OutOfInk("Not enough ink!");
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
        return "Чорнила: " . $this->getInkAmount() . " / " . $this->getInkCapacity();
    }
}

// Приклад використання
try {
    $pen = new Pen();
    $symbols = $pen->write("Hello, Santa!");
    echo $symbols . PHP_EOL;              // Виведе: 13
    echo $pen . PHP_EOL;                 // Виведе: Чорнила: 4083 / 4096

    $lowInkPen = new Pen(5);
    $symbols = $lowInkPen->write("Привіт, світ!");
    echo $symbols . PHP_EOL;
    echo $lowInkPen . PHP_EOL;

    // Тут спроба написати більше, ніж є чорнила
    $symbols = $lowInkPen->write("Додатковий текст");

} catch (OutOfInk $e) {
    echo "Чорнила закінчилися!" . PHP_EOL;
}

?>