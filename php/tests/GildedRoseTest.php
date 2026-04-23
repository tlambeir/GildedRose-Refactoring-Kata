<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\DegradableItem;
use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{

    public function testFoo(): void
    {
        $items = [new DegradableItem('foo', 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->processItems();
        $this->assertSame('foo', $items[0]->name);
    }


}
