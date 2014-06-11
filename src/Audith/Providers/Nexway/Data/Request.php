<?php
namespace Audith\Providers\Nexway\Data;

/**
 * @author    Shahriyar Imanov <shehi@imanov.me>
 */
class Request extends \Audith\Providers\Nexway\Data
{
    const SALES_TERRITORY_EU = "eu";

    const SALES_TERRITORY_UK = "uk";

    const SALES_TERRITORY_US = "us";

    /**
     * @var string
     */
    public $secret;

    /**
     * @var \Audith\Providers\Nexway\Data
     */
    public $request;


    /**
     * Creates Request struct for any operation
     */
    public function __construct(\Audith\Providers\Nexway\Data $data)
    {
        $this->request = $data;

        return $this;
    }
}