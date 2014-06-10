<?php
namespace Audith\Providers\Nexway\Data\Response\OrderApi;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class getStockStatus extends \Audith\Providers\Nexway\Data\Response\OrderApi
{
    /**
     * @var array
     * @see http://wsdocs.nexway.com/APIGuide/index.html?url=responsecodetype5.html
     */
    public static $exceptionCodeMapping = array(
        100  => "ProductRefIsMissingException",
        101  => "ProductRefIsInvalidException",
        1010 => "ProductReferenceDoesntExistException"
    );

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