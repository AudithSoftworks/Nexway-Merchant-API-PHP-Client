<?php
namespace Audith\Providers\Nexway\Data\Request\OrderApi;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class getCrossUpSell extends \Audith\Providers\Nexway\Data\Request\OrderApi
{
    /**
     * @var getCrossUpSell\getCrossUpSellProductType[]
     */
    public $products = array();

    /**
     * Language list (use ISO 3166-1-alpha-2)
     *
     * @var string
     * @usage This method accepts one language or list of language comma separated.
     *        Example: 'FR,EN,ES,IT,PT' or 'FR'
     */
    public $language = "EN";
}