<?php
namespace Audith\Providers\Nexway\Data;

use \Audith\Providers\Nexway\Data;

/**
 * @author    Shahriyar Imanov <shehi@imanov.me>
 */
class Request extends \Audith\Providers\Nexway\Data
{
    const SALES_TERRITORY_EU = "EU";

    const SALES_TERRITORY_UK = "UK";

    const SALES_TERRITORY_US = "US";

    /**
     * @var string
     */
    public $secret;

    /**
     * @var Data
     */
    public $request;


    /**
     * Creates Request struct for any operation
     */
    public function __construct(Data $data, $salesTerritory = self::SALES_TERRITORY_EU)
    {
        $config = \Audith\Providers\Nexway\Data::getConfig("Nexway");

        $this->secret  = $config['service']['nexway']['secret'][strtolower($salesTerritory)];
        $this->request = $data;

        return $this;
    }
}