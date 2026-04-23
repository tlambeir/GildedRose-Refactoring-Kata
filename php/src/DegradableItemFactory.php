<?php

declare(strict_types=1);

namespace GildedRose;

/**
 * Wraps raw catalogue items as {@see DegradableItem} instances for {@see GildedRose::processItems()}.
 */
class DegradableItemFactory
{
    /**
     * @param mixed $item Catalogue entry; expected to be {@see DegradableItem} for the current pass-through implementation
     *
     * @return DegradableItem The same instance (unchecked cast at call sites)
     */
    public static function create(mixed $item): DegradableItem
    {
        return $item;
    }
}
