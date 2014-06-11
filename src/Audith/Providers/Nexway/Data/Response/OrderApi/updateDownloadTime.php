<?php
namespace Audith\Providers\Nexway\Data\Response\OrderApi;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class updateDownloadTime extends \Audith\Providers\Nexway\Data\Response\OrderApi
{
    /**
     * @var array
     * @see http://wsdocs.nexway.com/APIGuide/index.html?url=responsecodetype6.html
     */
    public static $exceptionCodeMapping = array(
        100  => "PartnerOrderNumberIsMissingException",
        110  => "TimeValueIsMissingException",
        111  => "TimeValueIsNotValidException",
        1000 => "InternalErrorException",
        1010 => "OrderNotFoundException",
        1011 => "OrderAlreadyCancelledException"
    );

    /**
     * @var string
     */
    public $partnerOrderNumber;

    /**
     * @var string
     */
    public $newDownloadEndDate;

    /**
     * @var integer
     */
    public $responseCode;

    /**
     * @var string
     */
    public $responseMessage;
}