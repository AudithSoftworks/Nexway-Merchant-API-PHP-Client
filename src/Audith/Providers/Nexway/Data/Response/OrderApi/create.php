<?php
namespace Audith\Providers\Nexway\Data\Response\OrderApi;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class create extends \Audith\Providers\Nexway\Data\Response\OrderApi
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
        1010 => "OrderAlreadyCreatedException",
        1020 => "ProductReferenceDoesntExistException",
        1021 => "CurrencyDoesntExistException",
        1022 => "LanguageDoesntExistException",
        1023 => "CountryDoesntExistException",
        1030 => "XmlDocumentErrorException",
        1031 => "MissingOrEmptyXmlAttributesException",
        1032 => "EmptyXmlElementsException",
        1033 => "MissingXmlElementException",
        1034 => "MissingXmlDocumentException",
        1035 => "AffiliateIdIsInactiveOrInvalidException",
        1040 => "DownloadLinkErrorException",
        1041 => "CartSizeTooBigBackupFailedException",
        1042 => "ProductReferenceIsNotCompatibleWithCartException",
        1043 => "ReferenceLinkDependencyException",
        1044 => "OutOfStockException",
        1045 => "AffiliateIdIsInactiveOrInvalidException",
        1046 => "IpV4IpV6RequiredWhenPaymentPresentException",
        1047 => "PaymentTransactionIdIsRequiredForCurrentPaymentMethodException",
        1048 => "ProvinceIsRequiredForCertainLocalesException",
        1049 => "LocationProvinceIsNotValidException",
        1050 => "LocationProvinceIsNotValidException",
        1051 => "LicensesCurrentlyNotAvailableException",
        1052 => "InternalErrorException",
        1053 => "CurrentConfigurationRequiresUnitPriceHtOrTotalAmountException",
        1060 => "OrderIsWaitingForPaymentValidationException",
        1061 => "OrderIsWaitingForFraudSystemAgreementValidationException",
        1062 => "OrderCancelledDueToFraudSuspicionException",
        1063 => "PaymentTransactionNotFoundInDirectPaymentPlatformException",
        1064 => "OrderCancelledDueToNotValidatedPaymentException",
        1065 => "InternalErrorOnPaymentTransactionException"

    );

    /**
     * @var string
     */
    public $partnerOrderNumber;

    /**
     * @var integer
     */
    public $orderNumber;

    /**
     * @var create\orderLines[]
     */
    public $orderLines;

    /**
     * @var create\downloadManager
     */
    public $downloadManager;

    /**
     * @var integer
     */
    public $responseCode;

    /**
     * @var string
     */
    public $responseMessage;
}