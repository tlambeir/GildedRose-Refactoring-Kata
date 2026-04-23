<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\Item;
use GildedRose\GildedRose;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{

    public function testFoo(): void
    {
        $items = [new Item('foo', 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->processItems();
        $this->assertSame('foo', $items[0]->name);
    }


}
