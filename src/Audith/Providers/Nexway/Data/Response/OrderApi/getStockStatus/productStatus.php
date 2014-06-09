<?php
namespace Audith\Providers\Nexway\Data\Response\OrderApi\getStockStatus;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class productStatus extends \Audith\Providers\Nexway\Data
{
    const STATUS__ENOUGH_STOCK = 100;

    const STATUS__ALMOST_OUT_OF_STOCK = 200;

    const STATUS__OUT_OF_STOCK = 300;

    /**
     * @var integer
     */
    public $productRef;

    /**
     * @var integer
     */
    public $status;

    /**
     * @var integer
     */
    public $responseCode;

    /**
     * @var string
     */
    public $responseMessage;
}
