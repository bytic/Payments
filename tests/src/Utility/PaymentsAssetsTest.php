<?php

namespace ByTIC\Payments\Tests\Utility;

use ByTIC\Payments\Models\Purchases\Purchase;
use ByTIC\Payments\Models\PurchaseSessions\PurchaseSessions;
use ByTIC\Payments\Tests\AbstractTestCase;
use ByTIC\Payments\Utility\PaymentsAssets;
use Nip\Records\Locator\ModelLocator;

/**
 * Class PaymentsAssetsTest
 * @package ByTIC\Payments\Tests\Utility
 */
class PaymentsAssetsTest extends AbstractTestCase
{

    public function basePath()
    {
        self::assertStringEndsWith('bytic' . DIRECTORY_SEPARATOR . 'payments', PaymentsAssets::basePath());
    }

    public function test_adminPurchasesSessionsList_empty()
    {
        $purchase = \Mockery::mock(Purchase::class)->makePartial();
        $purchase->shouldReceive('getPurchasesSessions')->once()->andReturn([]);

        ModelLocator::set(PurchaseSessions::class, PurchaseSessions::instance());

        $return = PaymentsAssets::adminPurchasesSessionsList($purchase);
        self::assertStringContainsString('dnx', $return);
    }
}