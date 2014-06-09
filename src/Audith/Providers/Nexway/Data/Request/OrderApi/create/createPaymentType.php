<?php
namespace Audith\Providers\Nexway\Data\Request\OrderApi\create;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class createPaymentType extends \Audith\Providers\Nexway\Data\Request\OrderApi
{
    /**
     * @var string
     */
    public $paymentMethod = "External Payment";

    /**
     * Transaction Id, requested if payment is Internal and use DirectPayment platform
     *
     * @var string
     */
    public $transactionId = "";
}
