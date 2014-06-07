<?php
namespace Audith\Providers\Nexway\Data\Response\OrderApi;

use Audith\Providers\Nexway\Data\Request\OrderApi;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class create extends \Audith\Providers\Nexway\Data\Response\OrderApi
{
    /**
     * @var string
     */
    public $partnerOrderNumber;

    /**
     * @var integer
     */
    public $orderNumber;

    /**
     * @var create\orderLines[]
     */
    public $orderLines;

    /**
     * @var create\downloadManager
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