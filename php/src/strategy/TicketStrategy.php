<?php

declare(strict_types=1);

namespace GildedRose\strategy;

use GildedRose\DegradableItem;

final class TicketStrategy extends UpdateStrategy
{
    /**
     * @param DegradableItem $degradableItem Backstage pass; quality rules depend on days until the show
     */
    public function updateQuality(DegradableItem $degradableItem): void
    {
        if($degradableItem->sellIn > 0){
            $amount = $degradableItem->sellIn <= 5 ? 3 : ($degradableItem->sellIn <= 10 ? 2 : 1);
            $this->updateQualityAndSellin($degradableItem,$amount);
        } else {
            $this->updateQualityAndSellin($degradableItem,-$degradableItem->quality);
        }
    }
}
