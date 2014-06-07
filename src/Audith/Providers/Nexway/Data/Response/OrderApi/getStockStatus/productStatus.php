<?php
namespace Audith\Providers\Nexway\Data\Response\OrderApi\getStockStatus;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class productStatus extends \Audith\Providers\Nexway\Data
{
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
