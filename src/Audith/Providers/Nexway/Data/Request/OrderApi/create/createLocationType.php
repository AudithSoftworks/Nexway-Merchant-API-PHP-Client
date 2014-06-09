<?php
namespace Audith\Providers\Nexway\Data\Request\OrderApi\create;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class createLocationType extends \Audith\Providers\Nexway\Data\Request\OrderApi
{
    /**
     * @var string
     */
    public $companyName;

    /**
     * @var integer
     */
    public $title;

    /**
     * @var string
     */
    public $lastName;

    /**
     * @var string
     */
    public $firstName;

    /**
     * @var string
     */
    public $address1;

    /**
     * @var string
     */
    public $address2 = "";

    /**
     * @var string
     */
    public $zipCode;

    /**
     * @var string
     */
    public $city;

    /**
     * Customer Province: Mandatory if country is US, CA, BR or AU (USA, Canada, Brazil or Australia)
     *
     * @var string
     * @see http://wsdocs.nexway.com/APIGuide/index.html?url=province.html
     */
    public $province = "";

    /**
     * ISO 3166-1 alpha-2 country code.
     *
     * @var string
     * @see http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2
     * @see http://wsdocs.nexway.com/APIGuide/index.html?url=countrycode.html
     */
    public $country;

    /**
     * @var string
     */
    public $phone = "";

    /**
     * @var string
     */
    public $fax = "";
}
