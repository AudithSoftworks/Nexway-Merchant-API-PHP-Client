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
     * @var string
     */
    public $province = "";

    /**
     * @var string
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
