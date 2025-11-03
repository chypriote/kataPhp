<?php
declare(strict_types=1);

namespace App;

use DateTimeImmutable;

final class Cart
{
    private array $lines = [];
    private DiscountService $discounts;
    private float $cachedTotal = 0.0;

    public function __construct(?DiscountService $discounts = null)
    {
        $this->discounts = $discounts ?? new DiscountService();
    }

    public function add(Product $p, int $qty): void
    {
        if ($qty === 0) {
            return;
        }
        if (!isset($this->lines[$p->getId()])) {
            $this->lines[$p->getId()] = ['product' => $p, 'qty' => 0];
        }
        $this->lines[$p->getId()]['qty'] += $qty;
        $this->cachedTotal += ($p->getPriceCents() * $qty) / 100;
    }

    public function totalCents(DateTimeImmutable $now): int
    {
        $subtotal = array_reduce($this->lines, function ($carry, $line) {
            return $carry + $line['product']->getPriceCents() * $line['qty'];
        }, 0);
        $subtotal = $this->applyDiscounts($subtotal, $now);

        return $this->applyVat($subtotal);
    }

    private function applyDiscounts(int $subtotal, DateTimeImmutable $now): int
    {
        return $subtotal - (int) round($subtotal * ($this->discounts->getDiscountPercent($now) / 100));
    }

    private function applyVat(int $subtotal): int
    {
        return $subtotal + (int) round($subtotal * 0.20);
    }

    public function rawLines(): array
    {
        return $this->lines;
    }
}
