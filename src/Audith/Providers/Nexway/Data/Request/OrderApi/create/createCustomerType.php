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
     * The language must respect the ISO 639_ISO 3166 format (ex :fr_CA (french_CANADA))
     *
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
     * @usage ([A-Fa-f0-9]{1,4}:){7}[A-Fa-f0-9]{1,4}
     */
    public $IP_V = "";
}
