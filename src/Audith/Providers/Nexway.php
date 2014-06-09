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

        //----------------------
        // Exception handling
        //----------------------

        if (isset($responsePackage->out->responseCode) and $responsePackage->out->responseCode != 0) {
            $this->exceptionHandler($responsePackage->out->responseMessage, $responsePackage->out->responseCode, $responseObject);
        }

        //--------------------------------------------------------
        // Map response package into our custom Response object
        //--------------------------------------------------------

        $responseObject = $responseObject->mapNexwaySoapResponseObjectToOurCustomResponseObject($responsePackage->out);

        return $responseObject;
    }


    private function exceptionHandler($msg, $code, $responseObject)
    {
        $_globalExceptionMappings = \Audith\Providers\Nexway\Exception::$exceptionCodeMapping;

        $_responseObjectNamespace = '\\' . get_class($responseObject);
        $_localExceptionMappings  = $_responseObjectNamespace::$exceptionCodeMapping;

        $_allExceptionMappings = $_globalExceptionMappings + $_localExceptionMappings;

        if (isset($_allExceptionMappings[$code])) {
            $_exceptionClassNamespace = '\\Audith\\Providers\\Nexway\\Exception\\' . $_allExceptionMappings[$code];
            throw new $_exceptionClassNamespace($msg, $code);
        } else {
            throw new \Exception("[API-Error] " . $msg, $code);
        }
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