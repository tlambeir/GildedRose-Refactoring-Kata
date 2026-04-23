<?php

declare(strict_types=1);

namespace GildedRose\strategy;

use GildedRose\DegradableItem;

final class EpicStrategy extends UpdateStrategy
{
    /**
     * @param DegradableItem $degradableItem Legendary item; no change to quality or sell-in
     */
    public function updateQuality(DegradableItem $degradableItem): void
    {

    }
}
