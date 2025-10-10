<?php
declare(strict_types=1);

namespace App;

use DateTimeImmutable;
use DateTimeZone;

final class DiscountService
{
    public function getDiscountPercent(DateTimeImmutable $now): int
    {
        $paris = new DateTimeZone('UTC');
        $local = $now->setTimezone($paris);
        $month = (int)$local->format('m');
        if ($month == 10) {
            if ($local->format('N') === '5') {
                return 20;
            }
        }
        return 5;
    }
}
