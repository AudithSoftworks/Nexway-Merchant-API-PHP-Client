<?php
namespace Audith\Providers;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class Nexway
{
    /**
     * Wrapper to process Nexway API Methods (single-run version)
     *
     * @param   Nexway\Data\Request $data
     *
     * @return  Nexway\Data
     */
    public function run(Nexway\Data\Request $data)
    {
        //---------------------
        // Send HTTP request
        //---------------------

        /**
         * @var \stdClass $responsePackage
         */
        $responsePackage = $this->sendRequest($data);

        //---------------------------------
        // Create clean Response object
        //---------------------------------

        $_responseMethodName = get_class($data->request);
        $_responseMethodName = str_replace("Request", "Response", $_responseMethodName);
        /**
         * @var \Audith\Providers\Nexway\Data\Response $responseObject
         */
        $responseObject = new $_responseMethodName();

        //--------------------------------------------------------
        // Map response package into our custom Response object
        //--------------------------------------------------------

        $responseObject = $responseObject->mapNexwaySoapResponseObjectToOurCustomResponseObject($responsePackage->out);

        return $responseObject;
    }


    /**
     * @param Nexway\Data $data
     *
     * @return bool
     */
    public function validate(Nexway\Data $data)
    {
        $dataValidator = new Nexway\Data\Validator();

        return $dataValidator->validate($data);
    }


    /**
     * @param Nexway\Data\Request $data
     *
     * @return string
     */
    private function sendRequest(Nexway\Data\Request $data)
    {
        $_config = \Audith\Providers\Nexway\Data::getConfig("Nexway");

        $_wsdlHttpBinding = "";
        $_wsdlServiceName = "";
        if ($data->request instanceof \Audith\Providers\Nexway\Data\Request\CatalogApi) {
            $_wsdlServiceName = "CatalogApi";
        } elseif ($data->request instanceof \Audith\Providers\Nexway\Data\Request\OrderApi) {
            $_wsdlServiceName = "OrderApi";
        } elseif ($data->request instanceof \Audith\Providers\Nexway\Data\Request\CustomerApi) {
            $_wsdlServiceName = "CustomerApi";
        }

        if (isset($_config['service']['nexway']['url'][lcfirst($_wsdlServiceName)])) {
            $_wsdlHttpBinding = $_config['service']['nexway']['url'][lcfirst($_wsdlServiceName)];
        }

        $client = new \Zend\Soap\Client();
        $client->setWSDL($_wsdlHttpBinding);
        $client->setOptions(
               array(
                   'soap_version' => SOAP_1_1
               )
        );
        preg_match('/(?P<methodName>[^\\\\]+)$/i', get_class($data->request), $_matches);
        $methodName = $_matches['methodName'];

        return $client->$methodName($data);
    }
}