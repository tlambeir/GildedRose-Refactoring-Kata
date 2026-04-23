<?php

declare(strict_types=1);

namespace GildedRose\strategy;

use GildedRose\Item;

/**
 * Conjured items: the default decay step is multiplied by {@see $conjuredFactor}.
 */
final class ConjuredStrategy extends UpdateStrategy
{
    private int $conjuredFactor = 2;

    /**
     * @param Item $item Conjured item; default quality delta is multiplied by the conjured factor
     */
    public function updateQuality(Item $item): void
    {
        $amount = $this->getDefaultAmount($item);
        $this->updateQualityAndSellin($item, $amount * $this->conjuredFactor);
    }
}
