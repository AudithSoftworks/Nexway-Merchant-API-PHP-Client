<?php
namespace Audith\Providers\Nexway\Data\Request\OrderApi;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class cancel extends \Audith\Providers\Nexway\Data\Request\OrderApi
{
    const REASONCODE__ORDER_CANCELLED = 2;

    const REASONCODE__UNSATISFIED_CUSTOMER = 3;

    const REASONCODE__DOUBLE_ORDER = 4;

    const REASONCODE__PRODUCT_ORDER = 5;

    const REASONCODE__INCOMPATIBLE_PRODUCT = 6;

    const REASONCODE__FRAID_CHARGEBACK = 16;

    /**
     * @var string
     */
    public $partnerOrderNumber;

    /**
     * @var integer
     */
    public $reasonCode;

    /**
     * @var string
     */
    public $comment = "";
}
