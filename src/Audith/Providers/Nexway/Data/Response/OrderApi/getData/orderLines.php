<?php
namespace Audith\Providers\Nexway\Data\Response\OrderApi\getData;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class orderLines extends \Audith\Providers\Nexway\Data
{
    /**
     * @var integer
     */
    public $productRef;

    /**
     * @var orderLines\lineItems[]
     */
    public $lineItems = array();

    /**
     * @var orderLines\files[]
     */
    public $files = array();

    /**
     * @var string
     */
    public $dateEndDownload;

    /**
     * @var string
     */
    public $remark;

    /**
     * @var integer
     */
    public $responseCode;

    /**
     * @var string
     */
    public $responseMessage;
}
