<?php

declare(strict_types=1);

namespace GildedRose\strategy;

use GildedRose\Item;

final class TicketStrategy extends UpdateStrategy
{
    /**
     * @param Item $item Backstage pass; quality rules depend on days until the show
     */
    public function updateQuality(Item $item): void
    {
        if($item->sellIn > 0){
            $amount = $item->sellIn <= 5 ? 3 : ($item->sellIn <= 10 ? 2 : 1);
            $this->updateQualityAndSellin($item,$amount);
        } else {
            $this->updateQualityAndSellin($item,-$item->quality);
        }
    }
}
