<?php
namespace Audith\Providers\Nexway\Data\Response\CustomerApi\getOrderHistory;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class ordersHistory extends \Audith\Providers\Nexway\Data
{
    /**
     * @var string
     */
    public $partnerOrderNumber;

    /**
     * @var integer
     */
    public $orderNumber;

    /**
     * @var string
     */
    public $statusCode;

    /**
     * @var string
     */
    public $statusDescription;

    /**
     * @var string
     */
    public $dateOrder;

    /**
     * @var string
     */
    public $dateInvoice;
}