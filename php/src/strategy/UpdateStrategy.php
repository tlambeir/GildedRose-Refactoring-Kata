<?php

declare(strict_types=1);

namespace GildedRose\strategy;

use GildedRose\DegradableItem;

abstract class UpdateStrategy
{
    abstract public function updateQuality(DegradableItem $degradableItem): void;
}
