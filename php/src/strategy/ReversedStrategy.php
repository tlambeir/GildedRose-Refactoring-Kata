<?php

declare(strict_types=1);

namespace GildedRose\strategy;

use GildedRose\DegradableItem;

final class ReversedStrategy extends UpdateStrategy
{
    public function updateQuality(DegradableItem $degradableItem): void
    {
    }
}
