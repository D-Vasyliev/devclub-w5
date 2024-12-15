<?php

class OutOfInk extends Exception {}
class PenClosed extends Exception {}

class Pen {
    protected int $inkAmount;
    protected int $inkCapacity;

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
        return "Ручка - Чорнила: {$this->getInkAmount()} / {$this->getInkCapacity()}";
    }
}

class AutoPen extends Pen {
    private bool $isOpen;

    public function __construct(int $capacity = 4096) {
        parent::__construct($capacity);
        $this->isOpen = false;
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
        
        return parent::write($message);
    }

    public function __toString(): string {
        if ($this->isOpen) {
            $state = "відкрита";
        } else {
            $state = "закрита";
        }
        
        return "АвтоРучка ({$state}) - Чорнила: {$this->getInkAmount()} / {$this->getInkCapacity()}";
    }
}

try {
    // Звичайна ручка (Pen), без стану відкритості/закритості
    $pen = new Pen();
    $symbols = $pen->write("Hello, Santa!");
    echo $symbols . PHP_EOL;              
    echo $pen . PHP_EOL;

    // АвтоРучка (AutoPen) зі станом відкрито/закрито
    $autoPen = new AutoPen(5);
    $symbols = $autoPen->write("Привіт, світ!");

    $autoPen->open();
    $symbols = $autoPen->write("Привіт, світ!");
    echo $symbols . PHP_EOL;
    echo $autoPen . PHP_EOL;

    $symbols = $autoPen->write("Додатковий текст");

} catch (OutOfInk $e) {
    echo "Чорнила закінчилися!" . PHP_EOL;
} catch (PenClosed $e) {
    echo $e->getMessage() . PHP_EOL;
}

?>