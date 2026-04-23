<?php

declare(strict_types=1);

namespace GildedRose;
/**
 * Catalogue item kinds for {@see Item}; each case maps to an {@see UpdateStrategy}.
 */
enum ItemType
{
    case Epic;
    case Conjured;
    case Ticket;
    case Reverse;
    case Normal;
}