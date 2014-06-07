<?php
namespace Audith\Providers\Nexway\Data\Request\OrderApi;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class create extends \Audith\Providers\Nexway\Data\Request\OrderApi
{
    /**
     * @var string
     */
    public $partnerOrderNumber;

    /**
     * @var string
     */
    public $orderDate;

    /**
     * @var string
     */
    public $currency;

    /**
     * @var integer
     */
    public $affiliateId = "";

    /**
     * @var string
     */
    public $marketingProgramId = "";

    /**
     * @var create\createCustomerType
     */
    public $customer;

    /**
     * @var create\createOrderLinesType[]
     */
    public $orderLines = array();

    /**
     * @var create\createPaymentType[]
     */
    public $payment = "";

    /**
     * @var create\createDiscountType[]
     */
    public $discounts = "";

    /**
     * @var create\createMetaDataType[]
     */
    public $metaData = "";
}
