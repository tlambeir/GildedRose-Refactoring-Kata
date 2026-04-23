<?php

declare(strict_types=1);

namespace GildedRose\strategy;

use GildedRose\Item;

/**
 * Legendary items: no change to quality or sell-in.
 */
final class EpicStrategy extends UpdateStrategy
{
    /**
     * @param Item $item Legendary item; no change to quality or sell-in
     */
    public function updateQuality(Item $item): void
    {
    }
}
