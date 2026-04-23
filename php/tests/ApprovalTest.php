<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\DegradableItem;
use GildedRose\GildedRose;
use GildedRose\ItemType;
use PHPUnit\Framework\TestCase;
use ApprovalTests\Approvals;

/**
 * This unit test uses [Approvals](https://github.com/approvals/ApprovalTests.php).
 *
 * There are two test cases here with different styles:
 * <li>"foo" is more similar to the unit test from the 'Java' version
 * <li>"thirtyDays" is more similar to the TextTest from the 'Java' version
 *
 * I suggest choosing one style to develop and deleting the other.
 */
class ApprovalTest extends TestCase
{

    public function testDefault(): void
    {
        $items = [
            // Don't drop below 0 quality
            new DegradableItem('normal item 1', 0, 0),
            // Reduce Quality by 1 if quality is higher than 0
            new DegradableItem('normal item 2', 1, 1),
            // Reduce Quality by 2 if sellIn is lower than 0
            new DegradableItem('normal item 3', -1, 2)
        ];
        $app = new GildedRose($items);
        $app->processItems();

        Approvals::verifyList($items);
    }

    public function testConjured(): void
    {
        $items = [
            // Don't drop below 0 quality
            new DegradableItem('Conjured Mana Cakes 1', 0, 1, ItemType::Conjured),
            // Reduce Quality by 2 if quality is higher than 0
            new DegradableItem('Conjured Mana Cakes 2', 1, 10, ItemType::Conjured),
            // Reduce Quality by 4 if sellIn is lower than 0
            new DegradableItem('Conjured Mana Cakes 3', -1, 10, ItemType::Conjured),
        ];
        $app = new GildedRose($items);
        $app->processItems();

        Approvals::verifyList($items);
    }

    public function testEpic(): void
    {
        // Epic items should never be sold or drop quality
        $items = [new DegradableItem('Sulfuras', 1, 80,ItemType::Epic)];
        $app = new GildedRose($items);
        $app->processItems();

        Approvals::verifyList($items);
    }
    public function testReverse(): void
    {
        $items = [
            // Increase quality by 1 if sellIn drops by 1
            new DegradableItem('Brie 1', 10, 49,ItemType::Reverse),
            // Don't go over max quality
            new DegradableItem('Brie 2', 10, 50,ItemType::Reverse),
            // Increase quality by 1 if sellIn is lower than 0
            new DegradableItem('Brie 3', -1, 48,ItemType::Reverse),
        ];
        $app = new GildedRose($items);
        $app->processItems();

        Approvals::verifyList($items);
    }
    public function testTicket(): void
    {
        $items = [
            // Increase quality by 1 if sellIn drops by 1
            new DegradableItem('Backstage passes 1', 15, 20,ItemType::Ticket),
            // Increase quality by 2 if sellIn is 10 or lower
            new DegradableItem('Backstage passes 2', 10, 48,ItemType::Ticket),
            // Increase quality by 3 if sellIn is 5 or lower
            new DegradableItem('Backstage passes 3', 5, 47,ItemType::Ticket),
            // Set quality to 0 after the concert
            new DegradableItem('Backstage passes 4', 0, 50,ItemType::Ticket),
            // Don't go over max quality
            new DegradableItem('Backstage passes 5', 10, 50,ItemType::Ticket),
        ];
        $app = new GildedRose($items);
        $app->processItems();

        Approvals::verifyList($items);
    }

    public function testThirtyDays(): void
    {
        ob_start();

        $argv = ["", "30"];
        include(__DIR__ . '/../fixtures/texttest_fixture.php');

        $output = ob_get_clean();

        Approvals::verifyString($output);
    }
}
