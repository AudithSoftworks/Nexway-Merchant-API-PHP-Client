<?php
namespace Audith\Providers\Nexway\Data\Request\OrderApi\calculateVAT;

use Audith\Providers\Nexway\Data\Request\OrderApi\calculateVAT;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class calculateVATCart_LineType extends \Audith\Providers\Nexway\Data\Request\OrderApi
{
    /**
     * @var integer
     */
    public $product_ref;

    /**
     * @var integer
     */
    public $quantity;

    /**
     * @var float
     */
    public $priceWithVAT;

    /**
     * @var float
     */
    public $priceWithoutVAT;
}
