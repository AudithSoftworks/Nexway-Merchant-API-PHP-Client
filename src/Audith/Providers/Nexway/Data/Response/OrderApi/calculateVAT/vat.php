<?php
namespace Audith\Providers\Nexway\Data\Response\OrderApi\calculateVAT;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class vat extends \Audith\Providers\Nexway\Data
{
    /**
     * @var float
     */
    public $total;

    /**
     * @var float
     */
    public $rate;
}