<?php
namespace Audith\Providers\Nexway\Data\Request\OrderApi\calculateVAT;

use Audith\Providers\Nexway\Data\Request\OrderApi\calculateVAT;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class customer extends \Audith\Providers\Nexway\Data\Request\OrderApi
{
    /**
     * @var string
     */
    public $country = "TR";

    /**
     * @var string
     */
    public $province;

    /**
     * @var string
     */
    public $zipcode;

    /**
     * @var string
     */
    public $quality;

    /**
     * @var string
     */
    public $EEC_VAT;
}
