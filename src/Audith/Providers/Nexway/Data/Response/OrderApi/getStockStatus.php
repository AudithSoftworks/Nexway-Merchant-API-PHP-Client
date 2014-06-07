<?php
namespace Audith\Providers\Nexway\Data\Response\OrderApi;

use Audith\Providers\Nexway\Data\Request\OrderApi;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class getStockStatus extends \Audith\Providers\Nexway\Data\Response\OrderApi
{
    /**
     * @var integer
     */
    public $productStatus;


    public function __construct()
    {
        # Nexway's getStockStatus API method doesn't have these parameters on it's response, at its root. Instead they reside in child-nodes.
        unset($this->responseCode, $this->responseMessage);
    }
}
