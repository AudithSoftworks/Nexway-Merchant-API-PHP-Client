<?php
namespace Audith\Providers\Nexway\Data\Response\CatalogApi;

use Audith\Providers\Nexway\Data\Request\CatalogApi;

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
     * @var CatalogApi/subcategory[]
     */
    public $subcategory = array();
}
