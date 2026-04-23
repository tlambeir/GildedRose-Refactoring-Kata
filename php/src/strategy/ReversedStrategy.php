<?php

declare(strict_types=1);

namespace GildedRose\strategy;

use GildedRose\DegradableItem;

final class ReversedStrategy extends UpdateStrategy
{
    /**
     * @param DegradableItem $degradableItem Item that improves with age; applies the inverse of the default delta
     */
    public function updateQuality(DegradableItem $degradableItem): void
    {
        $amount = $this->getDefaultAmount($degradableItem);
        $this->updateQualityAndSellin($degradableItem,-$amount);
    }
}
