<?php

namespace ByTIC\Payments\Tests\Models\Purchases;

use ByTIC\Payments\Models\Purchases\Purchases;
use ByTIC\Payments\Models\Transactions\Statuses\Active;
use ByTIC\Payments\Tests\AbstractTestCase;

/**
 * Class PurchasesTest
 * @package ByTIC\Payments\Tests\Models\Purchases
 */
class PurchasesTest extends AbstractTestCase
{
    public function test_getController()
    {
        self::assertSame('purchases', Purchases::instance()->getController());
    }

    public function test_getStatuses()
    {
        $statuses = Purchases::instance()->getStatuses();

        self::assertCount(4, $statuses);
        self::assertInstanceOf(Active::class, $statuses['active']);
    }
}
