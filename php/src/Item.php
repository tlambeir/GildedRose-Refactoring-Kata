<?php

declare(strict_types=1);

namespace GildedRose;

/**
 * Inventory row from the kata: display name, sell-in days, and quality.
 */
class Item implements \Stringable
{
    /**
     * @param string $name Catalogue label (used with {@see UpdateStrategyFactory} to pick update rules)
     * @param int $sellIn Days until sell-by (negative when past sell-by)
     * @param int $quality Current quality score
     */
    public function __construct(
        public string $name,
        public int $sellIn,
        public int $quality
    ) {
    }

    /**
     * @return string "name, sellIn, quality"
     */
    public function __toString(): string
    {
        return (string) "{$this->name}, {$this->sellIn}, {$this->quality}";
    }
}
