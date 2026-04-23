<?php

declare(strict_types=1);

namespace GildedRose\strategy;

use GildedRose\Item;

abstract class UpdateStrategy
{
    private int $minQuality = 0;
    private int $maxQuality = 50;

    /**
     * Apply this strategy’s quality and sell-in rules for one day.
     *
     * @param Item $item Item being updated in place
     */
    abstract public function updateQuality(Item $item): void;

    /**
     * Clamp quality within bounds, add the quality delta, then decrease sell-in by one.
     *
     * @param Item $item Item to mutate
     * @param int $amount Delta applied to quality before clamping
     */
    public function updateQualityAndSellin(Item $item, int $amount): void
    {
        $item->quality = min($this->maxQuality, max($this->minQuality, $item->quality + $amount));
        $item->sellIn--;
    }

    /**
     * Default per-day quality delta before strategy-specific rules (more negative after sell-by).
     *
     * @param Item $item Item whose sell-in is inspected
     *
     * @return int Quality change step (typically -1 or -2)
     */
    public function getDefaultAmount(Item $item): int
    {
        return $item->sellIn <= 0 ? -2 : -1;
    }
}
