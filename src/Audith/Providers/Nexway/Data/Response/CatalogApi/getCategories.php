<?php
namespace Audith\Providers\Nexway\Data\Response\CatalogApi;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class getCategories extends \Audith\Providers\Nexway\Data\Response\CatalogApi
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $label;

    /**
     * @var getCategories/subcategory[]
     */
    public $subcategory = array();
}