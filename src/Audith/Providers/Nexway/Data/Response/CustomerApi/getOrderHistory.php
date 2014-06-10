<?php
namespace Audith\Providers\Nexway\Data\Response\CustomerApi;

use Audith\Providers\Nexway\Data\Response\CustomerApi;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class getOrderHistory extends \Audith\Providers\Nexway\Data\Response\CustomerApi
{
    /**
     * @var array
     */
    public static $exceptionCodeMapping = array(
        1000 => "InternalErrorException",
        1010 => "PartnerNotFoundException"
    );

    /**
     * @var string
     */
    public $partnerId;

    /**
     * @var string
     */
    public $email;

    /**
     * @var getOrderHistory\ordersHistory[]
     */
    public $ordersHistory = array();

    /**
     * @var integer
     */
    public $responseCode;

    /**
     * @var string
     */
    public $responseMessage;
}