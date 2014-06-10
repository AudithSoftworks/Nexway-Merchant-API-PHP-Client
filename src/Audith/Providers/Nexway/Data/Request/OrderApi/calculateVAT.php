<?php
namespace Audith\Providers\Nexway\Data\Request\OrderApi;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class calculateVAT extends \Audith\Providers\Nexway\Data\Request\OrderApi
{
    /**
     * @var calculateVAT\calculateVATCart_LineType[]
     */
    public $productLine = array();

    /**
     * @var calculateVAT\customer
     */
    public $customer;
}