<?php

declare(strict_types=1);

namespace GildedRose\strategy;

use GildedRose\Item;

final class NormalStrategy extends UpdateStrategy
{
    /**
     * @param Item $item Standard item; quality decreases by the default amount
     */
    public function updateQuality(Item $item): void
    {
        $amount = $this->getDefaultAmount($item);
        $this->updateQualityAndSellin($item,$amount);
    }
}
