<?php

declare(strict_types=1);

namespace GildedRose\strategy;

use GildedRose\Item;

/**
 * Aged Brie-style items: apply the inverse of the default decay (quality increases for this step).
 */
final class ReversedStrategy extends UpdateStrategy
{
    /**
     * @param Item $item Item that improves with age; applies the inverse of the default delta
     */
    public function updateQuality(Item $item): void
    {
        $amount = $this->getDefaultAmount($item);
        $this->updateQualityAndSellin($item, -$amount);
    }
}
