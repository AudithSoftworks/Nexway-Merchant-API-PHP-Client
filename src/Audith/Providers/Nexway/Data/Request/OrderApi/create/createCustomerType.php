<?php
namespace Audith\Providers\Nexway\Data\Request\OrderApi\create;

use Audith\Providers\Nexway\Data\Request\OrderApi\create;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class createCustomerType extends \Audith\Providers\Nexway\Data\Request\OrderApi
{
    /**
     * @var string
     */
    public $partnerId = "";

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $language = "en_XE";

    /**
     * @var create\createLocationType
     */
    public $locationDelivery = "";

    /**
     * @var create\createLocationType
     */
    public $locationInvoice;

    /**
     * @var string
     */
    public $IP_V4 = "";

    /**
     * @var string
     */
    public $IP_V = "";
}
