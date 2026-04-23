<?php

declare(strict_types=1);

namespace GildedRose\strategy;

use GildedRose\DegradableItem;

abstract class UpdateStrategy
{
    private int $minQuality = 0;
    private int $maxQuality = 50;

    /**
     * Apply this strategy’s quality and sell-in rules for one day.
     *
     * @param DegradableItem $degradableItem Item being updated in place
     */
    abstract public function updateQuality(DegradableItem $degradableItem): void;

    /**
     * Clamp quality within bounds, add the quality delta, then decrease sell-in by one.
     *
     * @param DegradableItem $item Item to mutate
     * @param int $amount Delta applied to quality before clamping
     */
    public function updateQualityAndSellin(DegradableItem $item, int $amount): void
    {
        $item->quality = min($this->maxQuality, max($this->minQuality, $item->quality + $amount));
        $item->sellIn--;
    }

    /**
     * Default per-day quality delta before strategy-specific rules (more negative after sell-by).
     *
     * @param DegradableItem $item Item whose sell-in is inspected
     *
     * @return int Quality change step (typically -1 or -2)
     */
    public function getDefaultAmount(DegradableItem $item): int
    {
        return $item->sellIn <= 0 ? -2 : -1;
    }
}
