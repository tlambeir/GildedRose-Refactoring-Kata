<?php

declare(strict_types=1);

namespace GildedRose\strategy;

use GildedRose\DegradableItem;

final class NormalStrategy extends UpdateStrategy
{
    /**
     * @param DegradableItem $degradableItem Standard item; quality decreases by the default amount
     */
    public function updateQuality(DegradableItem $degradableItem): void
    {
        $amount = $this->getDefaultAmount($degradableItem);
        $this->updateQualityAndSellin($degradableItem,$amount);
    }
}
