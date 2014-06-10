<?php
namespace Audith\Providers\Nexway\Data\Response\OrderApi;

use Audith\Providers\Nexway\Data\Request\OrderApi;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class calculateVAT extends \Audith\Providers\Nexway\Data\Response\OrderApi
{
    /**
     * @var array
     * @see http://wsdocs.nexway.com/APIGuide/index.html?url=createresponsecodetype.html
     */
    public static $exceptionCodeMapping = array(
        100  => "OrderIsMissingException",
        120  => "CurrencyIsMissingException",
        121  => "CurrencyIsNotValidException",
        130  => "PartnerOrderNumberIsMissingException",
        140  => "DateIsMissingException",
        141  => "DateIsNotValidException",
        150  => "TimeValueIsMissingException",
        151  => "TimeValueIsNotValidException",
        200  => "OrderDetailsIsMissingException",
        210  => "ProductRefIsMissingException",
        211  => "ProductRefIsInvalidException",
        220  => "QuantityIsMissingException",
        221  => "QuantityIsNotValidException",
        230  => "VatRateIsMissingException",
        231  => "VatRateIsNotValidException",
        240  => "AmountDutyFreeIsMissingException",
        241  => "AmountDutyFreeIsNotValidException",
        250  => "AmountTotalIsMissingException",
        251  => "AmountTotalIsNotValidException",
        310  => "CustomerPartnerIdIsMissingException",
        311  => "CustomerPartnerIdIsNotValidException",
        320  => "CustomerEmailIsMissingException",
        321  => "CustomerEmailIsNotValidException",
        330  => "CustomerLanguageIsMissingException",
        331  => "CustomerLanguageIsNotValidException",
        340  => "IpV4IsMissingException",
        341  => "IpV4IsNotValidException",
        410  => "DeliveryLocationIsMissingException",
        420  => "InvoiceLocationIsMissingException",
        430  => "LocationTitleIsMissingException",
        431  => "LocationTitleIsNotValidException",
        440  => "LocationLastNameIsMissingException",
        441  => "LocationLastNameIsNotValidException",
        450  => "LocationFirstNameIsMissingException",
        451  => "LocationFirstNameIsNotValidException",
        460  => "LocationAddressOneIsMissingException",
        461  => "LocationAddressOneIsNotValidException",
        480  => "LocationZipCodeIsMissingException",
        481  => "LocationZipCodeIsNotValidException",
        490  => "LocationCityIsMissingException",
        491  => "LocationCityIsNotValidException",
        500  => "LocationCountryIsMissingException",
        501  => "LocationCountryIsNotValidException",
        530  => "LocationPhoneIsMissingException",
        531  => "LocationPhoneIsNotValidException",
        540  => "LocationFaxIsMissingException",
        541  => "LocationFaxIsNotValidException",
        550  => "LocationProvinceIsMissingException",
        551  => "LocationProvinceIsNotValidException",
        600  => "DiscountIsMissingException",
        610  => "DiscountForeignRefIsMissingException",
        611  => "DiscountForeignRefIsNotValidException",
        620  => "DiscountLabelIsMissingException",
        621  => "DiscountLabelIsNotValidException",
        630  => "DiscountPriceDeltaIsMissingException",
        631  => "DiscountPriceDeltaIsNotValidException",
        640  => "DiscountOperationIsMissingException",
        641  => "DiscountOperationIsNotValidException",
        650  => "DiscountOperationValueIsMissingException",
        651  => "DiscountOperationValueIsNotValidException",
        700  => "PaymentIsMissingException",
        710  => "PaymentMethodIsMissingException",
        711  => "PaymentMethodIsNotValidException",
        720  => "PaymentTransactionIdIsMissingException",
        721  => "PaymentTransactionIdIsNotValidException",
        750  => "MetadataIsMissingException",
        751  => "MetadataKeyIsMissingException",
        1000 => "InternalErrorException",
        1010 => "OrderAlreadyCreatedException"
    );

    /**
     * @var calculateVAT\vat[]
     */
    public $vat = array();

    /**
     * @var float
     */
    public $totalWithoutVAT;

    /**
     * @var float
     */
    public $totalWithVAT;

    /**
     * @var integer
     */
    public $responseCode;

    /**
     * @var string
     */
    public $responseMessage;
}