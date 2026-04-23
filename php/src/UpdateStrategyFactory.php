<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\strategy\ConjuredStrategy;
use GildedRose\strategy\EpicStrategy;
use GildedRose\strategy\NormalStrategy;
use GildedRose\strategy\ReversedStrategy;
use GildedRose\strategy\TicketStrategy;
use GildedRose\strategy\UpdateStrategy;

/**
 * Wraps raw catalogue items as {@see Item} instances for {@see GildedRose::processItems()}.
 */
class UpdateStrategyFactory
{

    public static function create(Item $item): UpdateStrategy {
        return match ($item->name) {
            'Aged Brie' => new ReversedStrategy(),
            'Backstage passes to a TAFKAL80ETC concert' => new TicketStrategy(),
            'Sulfuras, Hand of Ragnaros' => new EpicStrategy(),
            'Conjured Mana Cake' => new ConjuredStrategy(),
            default => new NormalStrategy(),
        };
    }

}
