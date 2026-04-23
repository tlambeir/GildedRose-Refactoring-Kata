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
 * Selects a concrete {@see UpdateStrategy} from an {@see Item}'s {@see Item::$name} (kata catalogue names).
 */
final class UpdateStrategyFactory
{
    /**
     * @param Item $item Inventory row; only {@see Item::$name} is used for routing
     *
     * @return UpdateStrategy Stateless strategy instance for this item kind
     */
    public static function create(Item $item): UpdateStrategy
    {
        return match ($item->name) {
            'Aged Brie' => new ReversedStrategy(),
            'Backstage passes to a TAFKAL80ETC concert' => new TicketStrategy(),
            'Sulfuras, Hand of Ragnaros' => new EpicStrategy(),
            'Conjured Mana Cake' => new ConjuredStrategy(),
            default => new NormalStrategy(),
        };
    }
}
