<?php

namespace Paytic\Payments\Models\PurchaseSessions;

use Paytic\Payments\Models\AbstractModels\AbstractRecordManager;

/**
 * Class PurchaseSessions
 * @package Paytic\Payments\Models\PurchaseSessions
 */
class PurchaseSessions extends AbstractRecordManager
{
    public const TABLE = 'purchases_sessions';
    public const CONTROLLER = 'purchase_sessions';

    use PurchaseSessionsTrait;
}
