<?php

declare(strict_types=1);

namespace GildedRose;

enum ItemType {
    case Epic;
    case Conjured;
    case Ticket;
    case Reverse;
    case Normal;
}

class DegradableItem extends Item
{
    public function __construct(
        string $name,
        int $sellIn,
        int $quality,
        public ItemType $itemType = ItemType::Normal
    ) {
        parent::__construct($name, $sellIn, $quality);
    }

    public function __toString(): string
    {
        return (string) "{$this->name}, {$this->itemType->name}, {$this->sellIn}, {$this->quality}";
    }

    public function updateQuality(DegradableItem $item): void{

    }

}
