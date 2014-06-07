<?php

require_once dirname(dirname(__FILE__)) . "/vendor/autoload.php";


class NexwayTest extends PHPUnit_Framework_TestCase
{
    public function test_Provider_Data_getConfig_forNexway()
    {
        $config = \Audith\Providers\Nexway\Data::getConfig("Nexway");
        $this->assertNotEmpty($config['service']);

        return $config;
    }


    public function test_Provider_Nexway_Data_Request_CatalogApi_getCategories()
    {
        $getCategoriesRequest                             = new \Audith\Providers\Nexway\Data\Request\CatalogApi\getCategories();
        $getCategoriesRequest->productDescriptionLanguage = "EN";

        $requestStruct = new \Audith\Providers\Nexway\Data\Request($getCategoriesRequest);

        $nexwayObject = new \Audith\Providers\Nexway();

        return $nexwayObject->run($requestStruct);
    }


    public function test_Provider_Nexway_Data_Request_CatalogApi_getOperatingSystems()
    {
        $getOperatingSystems = new \Audith\Providers\Nexway\Data\Request\CatalogApi\getOperatingSystems();

        $requestStruct = new \Audith\Providers\Nexway\Data\Request($getOperatingSystems);

        $nexwayObject = new \Audith\Providers\Nexway();

        return $nexwayObject->run($requestStruct);
    }


    public function data_Provider_Nexway_Data_Request_OrderApi_getStockStatus()
    {
        return array(
            array(array(4626, 4649)),
            array(array(412721212121)),
            array(array(4127))
        );
    }


    /**
     * @dataProvider data_Provider_Nexway_Data_Request_OrderApi_getStockStatus
     */
    public function test_Provider_Nexway_Data_Request_OrderApi_getStockStatus($data)
    {
        $getStockStatus             = new \Audith\Providers\Nexway\Data\Request\OrderApi\getStockStatus();
        $getStockStatus->productRef = $data;

        $requestStruct = new \Audith\Providers\Nexway\Data\Request($getStockStatus);

        $nexwayObject = new \Audith\Providers\Nexway();

        return $nexwayObject->run($requestStruct);
    }


    public function data_Provider_Nexway_Data_Request_OrderApi_create()
    {
        return array(
            // Valid productRef
            array(
                array(
                    array('vatRate' => 0, 'amountTotal' => "", 'productRef' => 4626, 'amountDutyFree' => "", 'quantity' => 3)
                )
            ),
            // invalid productRef
            array(
                array(
                    array('vatRate' => 0, 'amountTotal' => "", 'productRef' => 45456626, 'amountDutyFree' => "", 'quantity' => 3),
                )
            ),
            // All valid productRefs
            array(
                array(
                    array('vatRate' => 8, 'amountTotal' => "", 'productRef' => 4127, 'amountDutyFree' => "", 'quantity' => 2),
                    array('vatRate' => 18, 'amountTotal' => "", 'productRef' => 4653, 'amountDutyFree' => "", 'quantity' => 1),

                )
            ),
            // Second one has invalid productRef
            array(
                array(
                    array('vatRate' => 8, 'amountTotal' => "", 'productRef' => 4758, 'amountDutyFree' => "", 'quantity' => 2),
                    array('vatRate' => 18, 'amountTotal' => "", 'productRef' => 4622525653, 'amountDutyFree' => "", 'quantity' => 1)
                )
            )
        );
    }


    /**
     * @dataProvider data_Provider_Nexway_Data_Request_OrderApi_create
     */
    public function test_Provider_Nexway_Data_Request_OrderApi_create($data)
    {
        //------------------------------------------------------------
        // Create "create" object and populate it's simple members
        //------------------------------------------------------------

        $create                     = new \Audith\Providers\Nexway\Data\Request\OrderApi\create();
        $create->partnerOrderNumber = (string) rand(100000, 10000000);
        $create->marketingProgramId = "";
        $create->currency           = "EUR";

        # Formatting "orderData" in ISO 8601 date-format (XSD dateTime format)
        $_config           = \Audith\Providers\Nexway\Data::getConfig("Nexway");
        $_currentTimeZone  = new \DateTimeZone($_config['datetime']['timezone']);
        $_dateTimeObject   = new \DateTime("now", $_currentTimeZone);
        $create->orderDate = $_dateTimeObject->format("c");

        //-------------------------------------------------------
        // Create "create::customer" and populate it with data
        //-------------------------------------------------------

        # Instantiation
        $_customer = new \Audith\Providers\Nexway\Data\Request\OrderApi\create\createCustomerType();

        # Simple members
        $_customer->email    = 'jdoe@mail.com';
        $_customer->language = "en_XE";

        # "locationInvoice" and its members
        $_customer->locationInvoice              = new \Audith\Providers\Nexway\Data\Request\OrderApi\create\createLocationType();
        $_customer->locationInvoice->title       = 1;
        $_customer->locationInvoice->firstName   = 'John';
        $_customer->locationInvoice->lastName    = 'Doe';
        $_customer->locationInvoice->address1    = 'Hell Blvd., 24';
        $_customer->locationInvoice->companyName = "";
        $_customer->locationInvoice->zipCode     = "";
        $_customer->locationInvoice->city        = 'Nanterre';
        $_customer->locationInvoice->country     = 'FR';

        # Done.
        $create->customer = $_customer;

        //--------------------------------------------------------------------------------------------
        // Create "create::orderLines" fields and populate it with data coming through @dataProvider
        //--------------------------------------------------------------------------------------------

        foreach ($data as $_orderLineItem) {
            $_orderLine                 = new \Audith\Providers\Nexway\Data\Request\OrderApi\create\createOrderLinesType();
            $_orderLine->vatRate        = $_orderLineItem['vatRate'];
            $_orderLine->amountTotal    = $_orderLineItem['amountTotal'];
            $_orderLine->productRef     = $_orderLineItem['productRef'];
            $_orderLine->amountDutyFree = $_orderLineItem['amountDutyFree'];
            $_orderLine->quantity       = $_orderLineItem['quantity'];
            $create->orderLines[]       = $_orderLine;
        }

        $requestStruct = new \Audith\Providers\Nexway\Data\Request($create);
        $nexwayObject = new \Audith\Providers\Nexway();
        $responseObject = $nexwayObject->run($requestStruct);

        /**
         * @var \Audith\Providers\Nexway\Data\Response\OrderApi\create $responseObject
         */
        $this->assertEquals(0, $responseObject->responseCode);

        return $responseObject;
    }
}