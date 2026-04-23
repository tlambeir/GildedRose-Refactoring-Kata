<?php

declare(strict_types=1);

namespace GildedRose\strategy;

use GildedRose\Item;

/**
 * Shared quality bounds and default decay step; subclasses implement {@see updateQuality()} per item kind.
 */
abstract class UpdateStrategy
{
    private int $minQuality = 0;
    private int $maxQuality = 50;

    /**
     * Apply this strategy's quality and sell-in rules for one day.
     *
     * @param Item $item Row to mutate in place
     */
    abstract public function updateQuality(Item $item): void;

    /**
     * Clamp quality between the configured minimum and maximum, add the delta to quality, then decrement sell-in.
     *
     * @param Item $item Row to mutate
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
     * @param Item $item Row whose sell-in is inspected
     *
     * @return int Quality delta before clamping (typically -1 or -2)
     */
    public function getDefaultAmount(Item $item): int
    {
        return $item->sellIn <= 0 ? -2 : -1;
    }
}
