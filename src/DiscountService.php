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
        return ($month === 11) && $local->format('N') === '5' ? 20 : 0;
    }
}
