<?php

namespace App\Domain\Shared\ValueObjects;

final readonly class Money
{
    public function __construct(private int $cents) {}

    public static function fromCents(int $cents): self
    {
        return new Money($cents);
    }

    public static function zero(): self
    {
        return new Money(0);
    }

    public function cents(): int
    {
        return $this->cents;
    }

    // Arithmétique. Chaque appel retourne une nouvelle instance.

    public function add(Money $other): self
    {
        return new self($this->cents + $other->cents());
    }

    public function subtract(Money $other): self
    {
        return new self($this->cents - $other->cents());
    }

    public function multiply(int $factor): self // prix unitaire x quantité (int, jamais float).
    {
        return new self($this->cents * $factor);
    }

    public function percentage(int $percent): self // pour les calculs de codes de réduction.
    {
        return new self((int) round($this->cents * $percent / 100));
    }

    // Comparaisons

    public function equals(Money $other): bool
    {
        return $this->cents === $other->cents;
    }

    public function greaterThan(Money $other): bool
    {
        return $this->cents > $other->cents;
    }

    public function lessThan(Money $other): bool
    {
        return $this->cents < $other->cents;
    }

    public function isZero(): bool
    {
        return $this->cents === 0;
    }

    public function isNegative(): bool
    {
        return $this->cents < 0;
    }

    // Affichage

    public function format(): string     // "12,50 €" — formatage locale FR
    {
        return number_format($this->cents / 100, 2, ',', '').' €';
    }

    public function __toString(): string // délègue à format(), pratique en Blade
    {
        return $this->format();
    }
}
