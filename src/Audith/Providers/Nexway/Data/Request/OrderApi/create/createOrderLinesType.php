<?php
namespace Audith\Providers\Nexway\Data\Request\OrderApi\create;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class createOrderLinesType extends \Audith\Providers\Nexway\Data\Request\OrderApi
{
    /**
     * @var integer
     */
    public $productRef;

    /**
     * @var integer
     */
    public $quantity;

    /**
     * @var float
     */
    public $vatRate;

    /**
     * @var float
     */
    public $amountDutyFree;

    /**
     * @var float
     */
    public $amountTotal;

    /**
     * @var createDiscountType[]
     */
    public $discounts = array();
}