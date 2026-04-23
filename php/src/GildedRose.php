<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    /**
     * Default values
     *
     * @param Item[] $items
     */
    public function __construct(
        private array $items,
    ) {
    }

    /**
     * Uses a factory to keep Item/items intact to satisfy the goblin
     * Use update strategy based on item type to modify quality/sellIn
     */
    public function processItems(): void
    {
        foreach ($this->items as $item) {
            $degradableItem = DegradableItemFactory::create($item);
            $degradableItem->updateQuality();
        }
    }
}
