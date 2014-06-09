<?php
namespace Audith\Providers\Nexway\Data\Response\OrderApi;

use Audith\Providers\Nexway\Data\Request\OrderApi;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class cancel extends \Audith\Providers\Nexway\Data\Response\OrderApi
{
    public static $exceptionCodeMapping = array(
        100  => "ReasonCodeIsMissingException",
        101  => "ReasonCodeIsNotValidException",
        110  => "OrderNumberIsMissingException",
        1000 => "InternalErrorException",
        1010 => "OrderNotFoundException",
        1011 => "OrderAlreadyCancelledException",
        1020 => "ExpiredCancelPeriodException",
        1030 => "UnauthorizedCancelException",
    );

    /**
     * @var string
     */
    public $partnerOrderNumber;

    /**
     * @var integer
     */
    public $orderNumber;

    /**
     * @var integer
     */
    public $responseCode;

    /**
     * @var string
     */
    public $responseMessage;
}