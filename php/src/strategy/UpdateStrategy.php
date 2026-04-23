<?php

declare(strict_types=1);

namespace GildedRose\strategy;

use GildedRose\DegradableItem;

abstract class UpdateStrategy
{
    private int $minQuality = 0;
    private int $maxQuality = 50;

    abstract public function updateQuality(DegradableItem $degradableItem): void;

    public function updateQualityAndSellin(DegradableItem $item, int $amount): void{
        $item->quality = min($this->maxQuality,max($this->minQuality, $item->quality + $amount));
        $item->sellIn--;
    }

    public function getDefaultAmount(DegradableItem $item): int
    {
        return $item->sellIn <= 0 ? -2 : -1;
    }
}
