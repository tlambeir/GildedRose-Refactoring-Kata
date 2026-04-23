<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    /**
     * Default values
     *
     * @param Item[] $items
     * @param Int $minQuality
     * @param Int $maxQuality
     * @param Int $conjuredFactor
     * @param Int[] $ticketDeltas
     */
    public function __construct(
        private array $items,
        private int $minQuality = 0,
        private int $maxQuality = 50,
        private int $conjuredFactor = 2
    ) {
    }

    /**
     * Increases or decreases quality based on operator and amount
     * Decreases sellIn by 1 step
     *
     * @param DegradableItem $item
     * @param String $operator
     * @param Int $amount
     */
    public function updateQuality($item, $amount): void{
        $item->quality = min($this->maxQuality,max($this->minQuality, $item->quality + $amount));
        $item->sellIn--;
    }

    /**
     * Uses a factory to keep Item/items intact to satisfy the goblin
     * Use switch method to modify qualtiy/sellIn based on item type
     */
    public function processItems(): void
    {
        foreach ($this->items as $item) {
            $degradableItem = DegradableItemFactory::create($item);
            $amount = $degradableItem->sellIn <= 0 ? -2 : -1;
            switch ($degradableItem->itemType) {
                case ItemType::Epic:
                    break;
                case ItemType::Reverse:
                        $this->updateQuality($degradableItem,-$amount);
                    break;
                case ItemType::Ticket:
                        if($degradableItem->sellIn > 0){
                            $amount = $degradableItem->sellIn <= 5 ? 3 : ($degradableItem->sellIn <= 10 ? 2 : 1);
                            $this->updateQuality($degradableItem,$amount);
                        } else {
                            $this->updateQuality($degradableItem,-$degradableItem->quality);
                        }
                    break;
                case ItemType::Conjured:
                        $this->updateQuality($degradableItem,$amount * $this->conjuredFactor);
                    break;
                default:
                        $this->updateQuality($degradableItem,$amount);
                    break;
            }
        }
    }
}
