<?php

require_once dirname(dirname(__FILE__)) . "/vendor/autoload.php";


class NexwayTest extends PHPUnit_Framework_TestCase
{
    protected static $createdOrders;

    protected static $cancelledOrders;


    public static function setUpBeforeClass()
    {
        self::$createdOrders   = array();
        self::$cancelledOrders = array();
    }


    public function test_Provider_Data_getConfig_forNexway()
    {
        $config = \Audith\Providers\Nexway\Data::getConfig("Nexway");
        $this->assertNotEmpty($config['service'], "PASSED : Configuration fetched!");

        return $config;
    }


    public function test_Provider_Nexway_Data_Request_CatalogApi_getCategories()
    {
        $getCategoriesRequest                             = new \Audith\Providers\Nexway\Data\Request\CatalogApi\getCategories();
        $getCategoriesRequest->productDescriptionLanguage = "EN";

        $requestStruct = new \Audith\Providers\Nexway\Data\Request($getCategoriesRequest);
        $nexwayObject  = new \Audith\Providers\Nexway();
        $returnObject  = $nexwayObject->run($requestStruct);

        /**
         * @var \Audith\Providers\Nexway\Data\Response\OrderApi\create $returnObject
         */
        $this->assertEquals(0, $returnObject->responseCode);

        return $returnObject;
    }


    public function test_Provider_Nexway_Data_Request_CatalogApi_getOperatingSystems()
    {
        $getOperatingSystems = new \Audith\Providers\Nexway\Data\Request\CatalogApi\getOperatingSystems();
        $requestStruct       = new \Audith\Providers\Nexway\Data\Request($getOperatingSystems);
        $nexwayObject        = new \Audith\Providers\Nexway();
        $returnObject        = $nexwayObject->run($requestStruct);

        /**
         * @var \Audith\Providers\Nexway\Data\Response\OrderApi\create $returnObject
         */
        $this->assertEquals(0, $returnObject->responseCode);

        return $returnObject;
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
        $nexwayObject  = new \Audith\Providers\Nexway();
        $returnObject  = $nexwayObject->run($requestStruct);

        /**
         * @var \Audith\Providers\Nexway\Data\Response\OrderApi\create $responseObject
         */
        $this->assertNotEmpty($returnObject);

        return $returnObject;
    }


    public function data_Provider_Nexway_Data_Request_OrderApi_create()
    {
        return array(
            // Valid productRef
            array(
                array(
                    array('vatRate' => 0, 'amountTotal' => null, 'productRef' => 4626, 'amountDutyFree' => null, 'quantity' => 3)
                ),
                $_exceptionExpected = false
            ),
            // invalid productRef
            array(
                array(
                    array('vatRate' => 0, 'amountTotal' => null, 'productRef' => -1, 'amountDutyFree' => null, 'quantity' => 3)
                ),
                $_exceptionExpected = true
            ),
            // Second one has invalid productRef
            array(
                array(
                    array('vatRate' => 8, 'amountTotal' => null, 'productRef' => 4758, 'amountDutyFree' => null, 'quantity' => 2),
                    array('vatRate' => 18, 'amountTotal' => null, 'productRef' => -1, 'amountDutyFree' => null, 'quantity' => 1)
                ),
                $_exceptionExpected = true
            ),
            // All valid productRefs
            array(
                array(
                    array('vatRate' => 8, 'amountTotal' => null, 'productRef' => 4127, 'amountDutyFree' => null, 'quantity' => 2),
                    array('vatRate' => 18, 'amountTotal' => null, 'productRef' => 4653, 'amountDutyFree' => null, 'quantity' => 1),

                ),
                $_exceptionExpected = false
            )
        );
    }


    /**
     * @dataProvider data_Provider_Nexway_Data_Request_OrderApi_create
     */
    public function test_Provider_Nexway_Data_Request_OrderApi_create($data, $_exceptionExpected = false)
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
        $nexwayObject  = new \Audith\Providers\Nexway();
        if ($_exceptionExpected === true) {
            $this->setExpectedException('Audith\\Providers\\Nexway\\Exception\\ProductRefIsInvalidException');
        }
        $returnObject = $nexwayObject->run($requestStruct);

        /**
         * @var \Audith\Providers\Nexway\Data\Response\OrderApi\create $returnObject
         */
        $this->assertEquals(0, $returnObject->responseCode);

        if ($returnObject->responseCode == 0) {
            self::$createdOrders[] = $returnObject;
        }

        return $returnObject;
    }


    public function test_Provider_Nexway_Data_Request_OrderApi_getDownloadInfo()
    {
        $this->assertNotEmpty(self::$createdOrders);

        $_invalidOrderData                     = new \stdClass();
        $_invalidOrderData->responseCode       = 0;
        $_invalidOrderData->responseMessage    = 'OK';
        $_invalidOrderData->partnerOrderNumber = '3333333333333';
        $_invalidOrderData->_amIFake           = true;

        $_createdOrders   = self::$createdOrders;
        $_createdOrders[] = $_invalidOrderData;

        foreach ($_createdOrders as $_order) {
            if (isset($_order->_amIFake) and $_order->_amIFake === true) {
                $this->setExpectedException('Audith\\Providers\\Nexway\\Exception\\OrderNotFoundException');
            }

            $getDownloadInfo                     = new \Audith\Providers\Nexway\Data\Request\OrderApi\getDownloadInfo();
            $getDownloadInfo->partnerOrderNumber = $_order->partnerOrderNumber;

            $requestStruct = new \Audith\Providers\Nexway\Data\Request($getDownloadInfo);
            $nexwayObject  = new \Audith\Providers\Nexway();
            $returnObject  = $nexwayObject->run($requestStruct);

            /**
             * @var \Audith\Providers\Nexway\Data\Response\OrderApi\create $returnObject
             */
            $this->assertEquals(0, $returnObject->responseCode);
        }
    }


    public function test_Provider_Nexway_Data_Request_OrderApi_cancel()
    {
        $this->assertNotEmpty(self::$createdOrders);

        $_invalidOrderData                     = new \stdClass();
        $_invalidOrderData->responseCode       = 0;
        $_invalidOrderData->responseMessage    = 'OK';
        $_invalidOrderData->partnerOrderNumber = '3333333333333';
        $_invalidOrderData->orderNumber        = 22;
        $_invalidOrderData->_amIFake           = true;

        $_createdOrders   = self::$createdOrders;
        $_createdOrders[] = $_invalidOrderData;

        foreach ($_createdOrders as $_order) {
            if (isset($_order->_amIFake) and $_order->_amIFake === true) {
                $this->setExpectedException('Audith\\Providers\\Nexway\\Exception\\OrderNotFoundException');
            }

            $cancel                     = new \Audith\Providers\Nexway\Data\Request\OrderApi\cancel();
            $cancel->partnerOrderNumber = $_order->partnerOrderNumber;
            $cancel->reasonCode         = \Audith\Providers\Nexway\Data\Request\OrderApi\cancel::REASONCODE__ORDER_CANCELLED;

            $requestStruct = new \Audith\Providers\Nexway\Data\Request($cancel);
            $nexwayObject  = new \Audith\Providers\Nexway();
            $returnObject  = $nexwayObject->run($requestStruct);

            /**
             * @var \Audith\Providers\Nexway\Data\Response\OrderApi\create $returnObject
             */
            $this->assertEquals(0, $returnObject->responseCode);
        }
    }
}