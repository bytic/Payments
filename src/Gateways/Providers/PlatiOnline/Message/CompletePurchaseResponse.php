<?php

namespace ByTIC\Payments\Gateways\Providers\PlatiOnline\Message;

use ByTIC\Omnipay\PlatiOnline\Message\CompletePurchaseResponse as AbstractCompletePurchaseResponse;
use ByTIC\Payments\Gateways\Providers\AbstractGateway\Message\Traits\CompletePurchaseResponseTrait;

/**
 * Class CompletePurchaseResponse
 * @package ByTIC\Payments\Gateways\Providers\PlatiOnline\Message
 */
class CompletePurchaseResponse extends AbstractCompletePurchaseResponse
{
    use CompletePurchaseResponseTrait;

    /** @noinspection PhpMissingParentCallCommonInspection
     * @return bool
     */
    protected function canProcessModel()
    {
        return true;
    }
}
