<?php
namespace Audith\Providers\Nexway\Data\Request\OrderApi\getCrossUpSell;

use Audith\Providers\Nexway\Data\Request\OrderApi\getCrossUpSell;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class getCrossUpSellProductType extends \Audith\Providers\Nexway\Data\Request\OrderApi
{
    /**
     * @var integer
     */
    public $productRef;

    /**
     * @var integer
     */
    public $quantity;
}