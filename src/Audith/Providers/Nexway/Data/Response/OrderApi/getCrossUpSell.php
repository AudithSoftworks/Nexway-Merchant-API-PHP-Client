<?php
namespace Audith\Providers\Nexway\Data\Response\OrderApi;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class getCrossUpSell extends \Audith\Providers\Nexway\Data\Response\OrderApi
{
    /**
     * @var array
     * @see http://wsdocs.nexway.com/APIGuide/index.html?url=responsecodetype1.html
     */
    public static $exceptionCodeMapping = array(
        100  => "ProductListIsMissingException",
        110  => "ProductRefIsMissingException",
        111  => "ProductRefIsInvalidException",
        120  => "QuantityIsMissingException",
        121  => "QuantityIsNotValidException",
        130  => "LanguageIsMissingException",
        131  => "LanguageIsNotValidException",
        1000 => "InternalErrorException",
        1010 => "ProductReferenceDoesntExistException"
    );

    /**
     * @var getCrossUpSell\productsReturn[]
     */
    public $productsReturn = array();

    /**
     * @var integer
     */
    public $responseCode;

    /**
     * @var string
     */
    public $responseMessage;
}