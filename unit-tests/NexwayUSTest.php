<?php

require_once dirname(dirname(__FILE__)) . "/vendor/autoload.php";


class NexwayUSTest extends PHPUnit_Framework_TestCase
{
    protected static $config;

    protected static $stockStatus;

    protected static $createdOrders;

    protected static $cancelledOrders;

    protected static $crossUpSales;


    public static function setUpBeforeClass()
    {
        self::$config          = array();
        self::$stockStatus     = array();
        self::$createdOrders   = array();
        self::$cancelledOrders = array();
        self::$crossUpSales    = array();
    }


    public function test_Provider_Data_getConfig()
    {
        $_environment = "development";

        if (isset($_ENV['APPLICATION_ENV']) and !empty($_ENV['APPLICATION_ENV'])) {
            $_environment = $_ENV['APPLICATION_ENV'];
        }

        $_zendConfigReader   = new \Zend\Config\Reader\Ini();
        $_configFileLocation = dirname(__FILE__) . "/config.ini";
        try {
            $_configInformationFromIniFile = $_zendConfigReader->fromFile($_configFileLocation);
        } catch (\Zend\Config\Exception\RuntimeException $e) {
            throw new \Audith\Providers\Nexway\Exception\ConfigFileNotReadableException("Error reading INI file at location " . $_configFileLocation);
        }

        $config = $_configInformationFromIniFile[$_environment];

        $this->assertNotEmpty($config['service']);
        self::$config = $config;
    }


    public function test_Provider_Nexway_Data_Request_CatalogApi_getCategories()
    {
        $getCategoriesRequest                             = new \Audith\Providers\Nexway\Data\Request\CatalogApi\getCategories();
        $getCategoriesRequest->productDescriptionLanguage = "EN"; // Not required

        $requestStruct         = new \Audith\Providers\Nexway\Data\Request($getCategoriesRequest);
        $requestStruct->secret = self::$config['service']['nexway']['secret'][Audith\Providers\Nexway\Data\Request::SALES_TERRITORY_US];

        $nexwayObject = new \Audith\Providers\Nexway(self::$config);
        $returnObject = $nexwayObject->run($requestStruct);

        /**
         * @var \Audith\Providers\Nexway\Data\Response|\stdClass $returnObject
         */
        $this->assertEquals(0, $returnObject->responseCode);
        $this->assertEquals('Audith\Providers\Nexway\Data\Response', get_class($returnObject));
        $this->assertNotEmpty($returnObject->categories);

        return $returnObject;
    }


    public function test_Provider_Nexway_Data_Request_CatalogApi_getOperatingSystems()
    {
        $getOperatingSystems = new \Audith\Providers\Nexway\Data\Request\CatalogApi\getOperatingSystems();

        $requestStruct         = new \Audith\Providers\Nexway\Data\Request($getOperatingSystems);
        $requestStruct->secret = self::$config['service']['nexway']['secret'][Audith\Providers\Nexway\Data\Request::SALES_TERRITORY_US];

        $nexwayObject = new \Audith\Providers\Nexway(self::$config);
        $returnObject = $nexwayObject->run($requestStruct);

        /**
         * @var \Audith\Providers\Nexway\Data\Response|\stdClass $returnObject
         */
        $this->assertEquals(0, $returnObject->responseCode);
        $this->assertEquals('Audith\Providers\Nexway\Data\Response', get_class($returnObject));
        $this->assertNotEmpty($returnObject->osList);

        return $returnObject;
    }


    public function data_Provider_Nexway_Data_Request_OrderApi_getStockStatus()
    {
        return array(
            array(array(760597, 659234)),
            array(array(738622)),
            array(array(-1))
        );
    }


    /**
     * @dataProvider data_Provider_Nexway_Data_Request_OrderApi_getStockStatus
     */
    public function test_Provider_Nexway_Data_Request_OrderApi_getStockStatus($data)
    {
        $getStockStatus             = new \Audith\Providers\Nexway\Data\Request\OrderApi\getStockStatus();
        $getStockStatus->productRef = $data;

        $requestStruct         = new \Audith\Providers\Nexway\Data\Request($getStockStatus);
        $requestStruct->secret = self::$config['service']['nexway']['secret'][Audith\Providers\Nexway\Data\Request::SALES_TERRITORY_US];

        $nexwayObject = new \Audith\Providers\Nexway(self::$config);
        $returnObject = $nexwayObject->run($requestStruct);

        /**
         * @var \Audith\Providers\Nexway\Data\Response\OrderApi\getStockStatus $returnObject
         */
        $this->assertNotEmpty($returnObject);
        $this->assertEquals('Audith\Providers\Nexway\Data\Response', get_class($returnObject));
        $this->assertNotEmpty($returnObject->productStatus);

        self::$stockStatus[] = $returnObject->productStatus;
    }


    public function test_Provider_Nexway_Data_Request_OrderApi_getCrossUpSell()
    {
        $this->assertNotEmpty(self::$stockStatus);

        foreach (self::$stockStatus as $_crossUpSellBasket) {
            //------------------------------------------------------------
            // Create "create" object and populate it's simple members
            //------------------------------------------------------------

            $getCrossUpSell = new \Audith\Providers\Nexway\Data\Request\OrderApi\getCrossUpSell();

            //--------------------------------------------------------------------------------------------
            // Create "create::orderLines" fields and populate it with data coming through @dataProvider
            //--------------------------------------------------------------------------------------------

            foreach ($_crossUpSellBasket as $_productStatus) {
                if ($_productStatus->responseCode != 0) {
                    $this->setExpectedException('Audith\\Providers\\Nexway\\Exception\\ProductRefIsInvalidException');
                }
                $_products                  = new \Audith\Providers\Nexway\Data\Request\OrderApi\getCrossUpSell\getCrossUpSellProductType();
                $_products->productRef      = $_productStatus->productRef;
                $_products->quantity        = rand(1, 5);
                $getCrossUpSell->products[] = $_products;
            }

            $requestStruct         = new \Audith\Providers\Nexway\Data\Request($getCrossUpSell);
            $requestStruct->secret = self::$config['service']['nexway']['secret'][Audith\Providers\Nexway\Data\Request::SALES_TERRITORY_US];

            $nexwayObject = new \Audith\Providers\Nexway(self::$config);
            $returnObject = $nexwayObject->run($requestStruct);

            /**
             * @var \Audith\Providers\Nexway\Data\Response\OrderApi\getCrossUpSell $returnObject
             */
            $this->assertEquals(0, $returnObject->responseCode);
            $this->assertEquals('Audith\Providers\Nexway\Data\Response', get_class($returnObject));
            $this->assertNotEmpty($returnObject);
            // $this->assertNotNull($returnObject->productsReturn); @todo
            // $this->assertNotEmpty($returnObject->productsReturn); @todo

            if ($returnObject->responseCode == 0) {
                self::$crossUpSales[] = $returnObject;
            }
        }
    }


    public function data_Provider_Nexway_Data_Request_OrderApi_create()
    {
        return array(
            // Valid productRef
            array(
                array(
                    array('vatRate' => 0, 'amountTotal' => null, 'productRef' => 659234, 'amountDutyFree' => null, 'quantity' => 3)
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
                    array('vatRate' => 8, 'amountTotal' => null, 'productRef' => 738622, 'amountDutyFree' => null, 'quantity' => 2),
                    array('vatRate' => 18, 'amountTotal' => null, 'productRef' => -1, 'amountDutyFree' => null, 'quantity' => 1)
                ),
                $_exceptionExpected = true
            ),
            // All valid productRefs
            array(
                array(
                    array('vatRate' => 8, 'amountTotal' => null, 'productRef' => 760597, 'amountDutyFree' => null, 'quantity' => 2),
                    array('vatRate' => 18, 'amountTotal' => null, 'productRef' => 738622, 'amountDutyFree' => null, 'quantity' => 1),

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
        if ($_exceptionExpected === true) {
            $this->setExpectedException('Audith\\Providers\\Nexway\\Exception\\ProductRefIsInvalidException');
        }

        //------------------------------------------------------------
        // Create "create" object and populate it's simple members
        //------------------------------------------------------------

        $create                     = new \Audith\Providers\Nexway\Data\Request\OrderApi\create();
        $create->partnerOrderNumber = (string) rand(100000, 10000000);
        $create->marketingProgramId = "";
        $create->currency           = "TRY";

        # Formatting "orderData" in ISO 8601 date-format (XSD dateTime format)
        $_currentTimeZone  = new \DateTimeZone(self::$config['datetime']['timezone']);
        $_dateTimeObject   = new \DateTime("now", $_currentTimeZone);
        $create->orderDate = $_dateTimeObject->format("c");

        //-------------------------------------------------------
        // Create "create::customer" and populate it with data
        //-------------------------------------------------------

        # Instantiation
        $_customer = new \Audith\Providers\Nexway\Data\Request\OrderApi\create\createCustomerType();

        # Simple members
        $_customer->email     = 'jdoe@mail.com';
        $_customer->language  = "en_US";
        $_customer->partnerId = 'customer-1';

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

        $requestStruct         = new \Audith\Providers\Nexway\Data\Request($create);
        $requestStruct->secret = self::$config['service']['nexway']['secret'][Audith\Providers\Nexway\Data\Request::SALES_TERRITORY_US];

        $nexwayObject = new \Audith\Providers\Nexway(self::$config);
        $returnObject = $nexwayObject->run($requestStruct);

        /**
         * @var \Audith\Providers\Nexway\Data\Response\OrderApi\create $returnObject
         */
        $this->assertEquals(0, $returnObject->responseCode);
        $this->assertNotNull($returnObject->orderNumber);
        $this->assertNotEquals(0, $returnObject->orderNumber);
        $this->assertNotNull($returnObject->partnerOrderNumber);
        $this->assertNotEquals("", $returnObject->partnerOrderNumber);
        $this->assertNotNull($returnObject->orderLines);
        $this->assertNotEmpty($returnObject->orderLines);
        $this->assertEquals('Audith\Providers\Nexway\Data\Response', get_class($returnObject));
        $this->assertNotEmpty($returnObject->orderLines);

        if ($returnObject->responseCode == 0) {
            self::$createdOrders[] = $returnObject;
        }
    }


    public function test_Provider_Nexway_Data_Request_OrderApi_getDownloadInfo()
    {
        $this->assertNotEmpty(self::$createdOrders);

        $_invalidOrderData                     = new \stdClass();
        $_invalidOrderData->responseCode       = 0;
        $_invalidOrderData->responseMessage    = 'OK';
        $_invalidOrderData->partnerOrderNumber = '-1';
        $_invalidOrderData->_amIFake           = true;

        $_createdOrders   = self::$createdOrders;
        $_createdOrders[] = $_invalidOrderData;

        foreach ($_createdOrders as $_order) {
            if (isset($_order->_amIFake) and $_order->_amIFake === true) {
                $this->setExpectedException('Audith\\Providers\\Nexway\\Exception\\OrderNotFoundException');
            }

            $getDownloadInfo                     = new \Audith\Providers\Nexway\Data\Request\OrderApi\getDownloadInfo();
            $getDownloadInfo->partnerOrderNumber = $_order->partnerOrderNumber;

            $requestStruct         = new \Audith\Providers\Nexway\Data\Request($getDownloadInfo);
            $requestStruct->secret = self::$config['service']['nexway']['secret'][Audith\Providers\Nexway\Data\Request::SALES_TERRITORY_US];

            $nexwayObject = new \Audith\Providers\Nexway(self::$config);
            $returnObject = $nexwayObject->run($requestStruct);

            /**
             * @var \Audith\Providers\Nexway\Data\Response\OrderApi\getDownloadInfo $returnObject
             */
            $this->assertEquals(0, $returnObject->responseCode);
            $this->assertEquals('Audith\Providers\Nexway\Data\Response', get_class($returnObject));
            $this->assertNotEmpty($returnObject->orderLines);
        }
    }


    public function test_Provider_Nexway_Data_Request_OrderApi_updateDownloadTime()
    {
        $this->assertNotEmpty(self::$createdOrders);

        $_invalidOrderData                     = new \stdClass();
        $_invalidOrderData->responseCode       = 0;
        $_invalidOrderData->responseMessage    = 'OK';
        $_invalidOrderData->partnerOrderNumber = '-1';
        $_invalidOrderData->_amIFake           = true;

        $_createdOrders   = self::$createdOrders;
        $_createdOrders[] = $_invalidOrderData;

        foreach ($_createdOrders as $_order) {
            if (isset($_order->_amIFake) and $_order->_amIFake === true) {
                $this->setExpectedException('Audith\\Providers\\Nexway\\Exception\\OrderNotFoundException');
            }

            $updateDownloadTime                     = new \Audith\Providers\Nexway\Data\Request\OrderApi\updateDownloadTime();
            $updateDownloadTime->partnerOrderNumber = $_order->partnerOrderNumber;
            $updateDownloadTime->value              = 'P7D';

            $requestStruct         = new \Audith\Providers\Nexway\Data\Request($updateDownloadTime);
            $requestStruct->secret = self::$config['service']['nexway']['secret'][Audith\Providers\Nexway\Data\Request::SALES_TERRITORY_US];

            $nexwayObject = new \Audith\Providers\Nexway(self::$config);
            $returnObject = $nexwayObject->run($requestStruct);

            /**
             * @var \Audith\Providers\Nexway\Data\Response\OrderApi\updateDownloadTime $returnObject
             */
            $this->assertEquals(0, $returnObject->responseCode);
            $this->assertEquals('Audith\Providers\Nexway\Data\Response', get_class($returnObject));
            $this->assertNotEmpty($returnObject->newDownloadEndDate);
        }
    }


    public function test_Provider_Nexway_Data_Request_OrderApi_getData()
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

            $getData                     = new \Audith\Providers\Nexway\Data\Request\OrderApi\getData();
            $getData->partnerOrderNumber = $_order->partnerOrderNumber;

            $requestStruct         = new \Audith\Providers\Nexway\Data\Request($getData);
            $requestStruct->secret = self::$config['service']['nexway']['secret'][Audith\Providers\Nexway\Data\Request::SALES_TERRITORY_US];

            $nexwayObject = new \Audith\Providers\Nexway(self::$config);
            $returnObject = $nexwayObject->run($requestStruct);

            /**
             * @var \Audith\Providers\Nexway\Data\Response\OrderApi\getData $returnObject
             */
            $this->assertEquals(0, $returnObject->responseCode);
            $this->assertNotNull($returnObject->orderNumber);
            $this->assertNotEquals(0, $returnObject->orderNumber);
            $this->assertNotNull($returnObject->partnerOrderNumber);
            $this->assertNotEquals("", $returnObject->partnerOrderNumber);
            $this->assertNotNull($returnObject->orderLines);
            $this->assertNotEmpty($returnObject->orderLines);
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

            $requestStruct         = new \Audith\Providers\Nexway\Data\Request($cancel);
            $requestStruct->secret = self::$config['service']['nexway']['secret'][Audith\Providers\Nexway\Data\Request::SALES_TERRITORY_US];

            $nexwayObject = new \Audith\Providers\Nexway(self::$config);
            $returnObject = $nexwayObject->run($requestStruct);

            /**
             * @var \Audith\Providers\Nexway\Data\Response\OrderApi\cancel $returnObject
             */
            $this->assertEquals(0, $returnObject->responseCode);
            $this->assertNotNull($returnObject->orderNumber);
            $this->assertNotEquals(0, $returnObject->orderNumber);
            $this->assertNotNull($returnObject->partnerOrderNumber);
            $this->assertNotEquals("", $returnObject->partnerOrderNumber);
            $this->assertEquals('Audith\Providers\Nexway\Data\Response', get_class($returnObject));
        }
    }


    public function data_Provider_Nexway_Data_Request_CustomerApi_getOrderHistory()
    {
        return array(
            array(array('partnerId' => "customer-1", '_amIFake' => false)),
            array(array('partnerId' => "customer-2", '_amIFake' => true)),
            array(array('partnerId' => "jdoe@mail.com", '_amIFake' => true))
        );
    }


    /**
     * @dataProvider data_Provider_Nexway_Data_Request_CustomerApi_getOrderHistory
     */
    public function test_Provider_Nexway_Data_Request_CustomerApi_getOrderHistory($data)
    {
        if ($data['_amIFake'] === true) {
            $this->setExpectedException('Audith\\Providers\\Nexway\\Exception\\PartnerNotFoundException');
        }

        $getOrderHistory            = new \Audith\Providers\Nexway\Data\Request\CustomerApi\getOrderHistory();
        $getOrderHistory->partnerId = $data['partnerId'];

        $requestStruct         = new \Audith\Providers\Nexway\Data\Request($getOrderHistory);
        $requestStruct->secret = self::$config['service']['nexway']['secret'][Audith\Providers\Nexway\Data\Request::SALES_TERRITORY_EU];

        $nexwayObject = new \Audith\Providers\Nexway(self::$config);
        $returnObject = $nexwayObject->run($requestStruct);

        /**
         * @var \Audith\Providers\Nexway\Data\Response\CustomerApi\getOrderHistory $returnObject
         */
        $this->assertEquals(0, $returnObject->responseCode);
        $this->assertNotNull($returnObject->ordersHistory);
        $this->assertNotEmpty($returnObject->ordersHistory);
        $this->assertEquals('Audith\Providers\Nexway\Data\Response', get_class($returnObject));

        return $returnObject;
    }
}