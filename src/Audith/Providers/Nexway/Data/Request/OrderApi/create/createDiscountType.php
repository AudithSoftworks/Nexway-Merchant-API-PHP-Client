<?php
namespace Audith\Providers\Nexway\Data\Request\OrderApi\create;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class createDiscountType extends \Audith\Providers\Nexway\Data\Request\OrderApi
{
    /**
     * @var string
     */
    public $foreignRef;

    /**
     * @var string
     */
    public $label;

    /**
     * @var float
     */
    public $priceDelta;

    /**
     * @var "Percents"|"Amount"
     */
    public $operation;

    /**
     * @var float
     */
    public $operationValue;
}
