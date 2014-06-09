<?php
namespace Audith\Providers\Nexway\Data\Response\OrderApi;

use Audith\Providers\Nexway\Data\Request\OrderApi;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class getDownloadInfo extends \Audith\Providers\Nexway\Data\Response\OrderApi
{
    /**
     * @var array
     * @see http://wsdocs.nexway.com/APIGuide/index.html?url=createresponsecodetype.html
     */
    public static $exceptionCodeMapping = array(
        100  => "PartnerCustomerNumberIsMissingException",
        1000 => "InternalErrorException",
        1010 => "OrderNotFoundException"
    );

    /**
     * @var string
     */
    public $partnerOrderNumber;

    /**
     * @var string
     */
    public $downloadEndDate;

    /**
     * @var getDownloadInfo\orderLines[]
     */
    public $orderLines = array();

    /**
     * @var integer
     */
    public $responseCode;

    /**
     * @var string
     */
    public $responseMessage;
}