<?php

declare(strict_types=1);

namespace GildedRose\strategy;

use GildedRose\DegradableItem;

final class ConjuredStrategy extends UpdateStrategy
{
    private int $conjuredFactor = 2;

    /**
     * @param DegradableItem $degradableItem Conjured item; default quality delta is multiplied by the conjured factor
     */
    public function updateQuality(DegradableItem $degradableItem): void
    {
        $amount = $this->getDefaultAmount($degradableItem);
        $this->updateQualityAndSellin($degradableItem,$amount * $this->conjuredFactor);
    }
}
