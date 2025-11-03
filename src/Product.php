<?php
declare(strict_types=1);

namespace App;

final class Product
{
    private string $id;
    private ?string $name;
    private int $priceCents;

    public function __construct(string $id, string $name, int $priceCents = 0)
    {
        if ('' === $id || $priceCents < 0) {
            throw new \InvalidArgumentException('Invalid product');
        }

        $this->id = $id;
        $this->name = $name;
        $this->priceCents = $priceCents;
    }

    public function getPriceCents(): int
    {
        return $this->priceCents;
    }

    public function setName(string $name): string
    {
        $this->name = trim($name);
        return $this->name;
    }

    public function equals(Product $other): bool
    {
        return $this->id === $other->id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}
