<?php
namespace Audith\Providers\Nexway\Data\Response\OrderApi;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class getData extends \Audith\Providers\Nexway\Data\Response\OrderApi
{
    /**
     * @var array
     * @see http://wsdocs.nexway.com/APIGuide/index.html?url=getdataresponsetype.html
     */
    public static $exceptionCodeMapping = array(
        100  => "OrderNumberIsMissingException",
        750  => "MetadataIsMissingException",
        760  => "MetadataKeyIsMissingException",
        1000 => "InternalErrorException",
        1010 => "OrderNotFoundException",
        1020 => "ProductReferenceDoesntExistException",
        1030 => "XmlDocumentErrorException",
        1031 => "MissingOrEmptyXmlAttributesException",
        1032 => "EmptyXmlElementsException",
        1033 => "MissingXmlElementException",
        1034 => "MissingXmlDocumentException",
        1040 => "DownloadLinkErrorException",
        1051 => "LicensesCurrentlyNotAvailableException",
        1052 => "InternalErrorException",
        1060 => "OrderIsWaitingForPaymentValidationException",
        1061 => "OrderIsWaitingForFraudSystemAgreementValidationException",
        1062 => "OrderCancelledDueToFraudSuspicionException",
        1064 => "OrderCancelledDueToNotValidatedPaymentException",
        1065 => "InternalErrorOnPaymentTransactionException"

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
     * @var getData\orderLines[]
     */
    public $orderLines;

    /**
     * @var getData\downloadManager
     */
    public $downloadManager;

    /**
     * @var integer
     */
    public $responseCode;

    /**
     * @var string
     */
    public $responseMessage;
}