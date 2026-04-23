<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use GildedRose\DegradableItem;
use GildedRose\GildedRose;
use GildedRose\Item;
use GildedRose\ItemType;

echo 'OMGHAI!' . PHP_EOL;

$items = [
    new DegradableItem('+5 Dexterity Vest', 10, 20),
    new DegradableItem('Aged Brie', 2, 0,ItemType::Reverse),
    new DegradableItem('Elixir of the Mongoose', 5, 7),
    new DegradableItem('Sulfuras, Hand of Ragnaros', 0, 80, ItemType::Epic),
    new DegradableItem('Sulfuras, Hand of Ragnaros', -1, 80,ItemType::Epic),
    new DegradableItem('Backstage passes to a TAFKAL80ETC concert', 15, 20,ItemType::Ticket),
    new DegradableItem('Backstage passes to a TAFKAL80ETC concert', 10, 49,ItemType::Ticket),
    new DegradableItem('Backstage passes to a TAFKAL80ETC concert', 5, 49,ItemType::Ticket),
    // this conjured item does not work properly yet
    new DegradableItem('Conjured Mana Cake', 3, 6,ItemType::Conjured),
];

$app = new GildedRose($items);

$days = 2;
if ((is_countable($argv) ? count($argv) : 0) > 1) {
    $days = (int) $argv[1];
}

for ($i = 0; $i < $days; $i++) {
    echo "-------- day {$i} --------" . PHP_EOL;
    echo 'name, sellIn, quality' . PHP_EOL;
    foreach ($items as $item) {
        echo $item . PHP_EOL;
    }
    echo PHP_EOL;
    $app->processItems();
}
