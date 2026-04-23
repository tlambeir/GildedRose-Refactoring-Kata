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
        $itemType = match ($item->name) {
            'Aged Brie' => ItemType::Reverse,
            'Backstage passes to a TAFKAL80ETC concert' => ItemType::Ticket,
            'Sulfuras, Hand of Ragnaros' => ItemType::Epic,
            'Conjured Mana Cake' => ItemType::Conjured,
            default => ItemType::Normal,
        };
        // Assign the strategy based on the type provided
        return match ($itemType) {
            ItemType::Normal => new NormalStrategy(),
            ItemType::Reverse => new ReversedStrategy(),
            ItemType::Ticket => new TicketStrategy(),
            ItemType::Epic => new EpicStrategy(),
            ItemType::Conjured => new ConjuredStrategy(),
        };
    }

}
