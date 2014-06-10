<?php
namespace Audith\Providers\Nexway\Data\Response\OrderApi\getCrossUpSell;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class productsReturn extends \Audith\Providers\Nexway\Data
{
    /**
     * @var integer
     */
    public $ref;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $name;

    /**
     * @var float
     */
    public $amountDutyFree;

    /**
     * @var string
     */
    public $currency;

    /**
     * @var string
     */
    public $shortDescription;

    /**
     * @var string
     */
    public $language;

    /**
     * @var string
     */
    public $imageSmall;
}