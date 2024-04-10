<?php

namespace Paytic\Payments\Gateways\Providers\AbstractGateway\Traits;

use Nip\Records\AbstractModels\Record;
use Nip\Utility\Traits\NameWorksTrait;
use Omnipay\Common\Message\RequestInterface;
use Paytic\Omnipay\Common\Gateway\Traits\HasPsr18ClientTrait;
use Paytic\Payments\Gateways\Manager;
use Paytic\Payments\Models\Methods\Traits\RecordTrait as PaymentMethodRecord;
use Paytic\Payments\Models\Purchase\Traits\IsPurchasableModelTrait;
use Paytic\Payments\Utility\GatewayImages;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class Gateway
 * @package Paytic\Payments\Gateways\Providers\AbstractGateway
 *
 * @property $parameters \Symfony\Component\HttpFoundation\ParameterBag
 */
trait GatewayTrait
{
    use NameWorksTrait;
    use MagicMessagesTrait;
    use HasFormsTrait;
    use DetectFromHttpRequestTrait;
    use OverwriteCompletePurchaseTrait;
    use HasPsr18ClientTrait;

    /**
     * @var null|string
     */
    protected $name = null;

    /**
     * @var null|string
     */
    protected $label = null;

    /**
     * @var Manager
     */
    protected $manager;

    /**
     * @var PaymentMethodRecord
     */
    protected $paymentMethod;



    /**
     * @param IsPurchasableModelTrait $record
     * @return RequestInterface
     */
    public function purchaseFromModel($record)
    {
        $parameters = $record->getPurchaseParameters();

        return $this->purchase($parameters);
    }

    /**
     * @return null|string
     */
    public function getName()
    {
        if ($this->name === null) {
            $this->initName();
        }

        return $this->name;
    }

    // ------------ GETTERS & SETTERS ------------ //

    /**
     * @param null $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    public function initName()
    {
        $this->setName($this->generateName());
    }

    /**
     * @return string
     */
    protected function generateName()
    {
        return strtolower($this->getLabel());
    }

    /**
     * @return null|string
     */
    public function getLabel()
    {
        if ($this->label === null) {
            $this->initLabel();
        }

        return $this->label;
    }

    /**
     * @param null|string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    public function initLabel()
    {
        $this->setLabel($this->generateLabel());
    }

    /**
     * @return string
     */
    public function generateLabel()
    {
        return $this->getNamespaceParentFolder();
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setSandbox($value)
    {
        $return = $this->setParameter('sandbox', $value);
        $this->setTestMode($this->getSandbox() == 'yes');
        return $return;
    }

    /**
     * @return mixed
     */
    public function getSandbox()
    {
        return $this->getParameter('sandbox');
    }

    /**
     * @return Manager
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * @param Manager $manager
     */
    public function setManager($manager)
    {
        $this->manager = $manager;
    }

    /**
     * @return PaymentMethodRecord|Record
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * @param PaymentMethodRecord $paymentMethod
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * @param HttpRequest $httpRequest
     */
    public function setHttpRequest($httpRequest)
    {
        $this->httpRequest = $httpRequest;
    }

    /**
     * @param null $default
     * @return string|null
     */
    public function getImageBand($default = null)
    {
        return GatewayImages::band($this->getName(), $default);
    }

    /**
     * @param null $default
     * @return string|null
     */
    public function getLogo($default = null)
    {
        return GatewayImages::logo($this->getName(), $default);
    }

    /**
     * @return boolean
     */
    abstract public function isActive();
}
