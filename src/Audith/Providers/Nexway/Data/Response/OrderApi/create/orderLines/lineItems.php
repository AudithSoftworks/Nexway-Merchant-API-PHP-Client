<?php
namespace Audith\Providers\Nexway\Data\Response\OrderApi\create\orderLines;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class lineItems extends \Audith\Providers\Nexway\Data
{
    /**
     * @var lineItems\serials[]
     */
    public $serials = array();

    /**
     * @var integer
     */
    public $subscriptionId;

    /**
     * @var integer
     */
    public $responseCode;

    /**
     * @var string
     */
    public $responseMessage;
}
