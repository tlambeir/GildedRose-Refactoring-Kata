<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\strategy\NormalStrategy;
use GildedRose\strategy\TicketStrategy;
use GildedRose\strategy\ConjuredStrategy;
use GildedRose\strategy\EpicStrategy;
use GildedRose\strategy\ReversedStrategy;
use GildedRose\strategy\UpdateStrategy;

enum ItemType {
    case Epic;
    case Conjured;
    case Ticket;
    case Reverse;
    case Normal;
}

class DegradableItem extends Item
{
    public UpdateStrategy $updateStrategy;

    public function __construct(
        public string $name,
        public int $sellIn,
        public int $quality,
        public ItemType $itemType = ItemType::Normal,
    ) {
        // Assign the strategy based on the type provided
        $this->updateStrategy = match($this->itemType) {
            ItemType::Normal   => new NormalStrategy(),
            ItemType::Reverse  => new ReversedStrategy(),
            ItemType::Ticket   => new TicketStrategy(),
            ItemType::Epic     => new EpicStrategy(),
            ItemType::Conjured => new ConjuredStrategy(),
        };
        parent::__construct($name, $sellIn, $quality);
    }

    public function __toString(): string
    {
        return (string) "{$this->name}, {$this->itemType->name}, {$this->sellIn}, {$this->quality}";
    }

    public function updateQuality(): void{
        $this->updateStrategy->updateQuality($this);
    }

}
