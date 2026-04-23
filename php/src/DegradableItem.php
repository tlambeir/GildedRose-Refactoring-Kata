<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\strategy\NormalStrategy;
use GildedRose\strategy\TicketStrategy;
use GildedRose\strategy\ConjuredStrategy;
use GildedRose\strategy\EpicStrategy;
use GildedRose\strategy\ReversedStrategy;
use GildedRose\strategy\UpdateStrategy;

/**
 * Catalogue item kinds for {@see DegradableItem}; each case maps to an {@see UpdateStrategy}.
 */
enum ItemType
{
    case Epic;
    case Conjured;
    case Ticket;
    case Reverse;
    case Normal;
}

/**
 * {@see Item} with a stable category and the {@see UpdateStrategy} used for daily updates.
 */
class DegradableItem extends Item
{
    public UpdateStrategy $updateStrategy;

    /**
     * @param string $name Item display name
     * @param int $sellIn Days until sell-by (negative if past sell-by)
     * @param int $quality Current quality (clamped elsewhere when applied)
     * @param ItemType $itemType Category; selects {@see $updateStrategy} via a match expression
     */
    public function __construct(
        string $name,
        int $sellIn,
        int $quality,
        public ItemType $itemType = ItemType::Normal,
    ) {
        // Assign the strategy based on the type provided
        $this->updateStrategy = match ($this->itemType) {
            ItemType::Normal => new NormalStrategy(),
            ItemType::Reverse => new ReversedStrategy(),
            ItemType::Ticket => new TicketStrategy(),
            ItemType::Epic => new EpicStrategy(),
            ItemType::Conjured => new ConjuredStrategy(),
        };
        parent::__construct($name, $sellIn, $quality);
    }

    /**
     * @return string "name, typeName, sellIn, quality" (type name matches {@see ItemType} case name)
     */
    public function __toString(): string
    {
        return (string) "{$this->name}, {$this->itemType->name}, {$this->sellIn}, {$this->quality}";
    }

    /**
     * Apply one day of rules using {@see $updateStrategy}.
     */
    public function updateQuality(): void
    {
        $this->updateStrategy->updateQuality($this);
    }
}
