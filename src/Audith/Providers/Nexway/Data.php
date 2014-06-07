<?php
namespace Audith\Providers\Nexway;

/**
 * @author    Shahriyar Imanov <shehi@imanov.me>
 */
abstract class Data
{
    private static $mapOfSoapResponseTypesToCustomResponseObjects = array(
        'getCategoriesCategoryResponseType'       => array('nameSpace' => '\Audith\Providers\Nexway\Data\Response\CatalogApi\getCategories', 'isArray' => true),
        'getCategoriesSubCategoryResponseType'    => array('nameSpace' => '\Audith\Providers\Nexway\Data\Response\CatalogApi\getCategories\subcategory', 'isArray' => true),
        'getOperatingSystemsOsResponseType'       => array('nameSpace' => '\Audith\Providers\Nexway\Data\Response\CatalogApi\getOperatingSystems', 'isArray' => true),
        'getStockStatusproductStatusResponseType' => array('nameSpace' => '\Audith\Providers\Nexway\Data\Response\OrderApi\getStockStatus\productStatus', 'isArray' => true)
    );


    public function __get($name)
    {
        switch ($name) {
            case 'className':
                $_className = array_slice(explode('\\', get_called_class()), -1, 1);

                return $_className[0];
                break;
            default:
                return null;
        }
    }


    public function __call($name, $arguments)
    {
        switch ($name) {
            case 'getClassName':
                $_className = array_slice(explode('\\', get_called_class()), -1, 1);

                return $_className[0];
                break;
            default:
                return null;
        }
    }


    public static function __callStatic($name, $arguments)
    {
        switch ($name) {
            case 'getClassName':
                $_className = array_slice(explode('\\', get_called_class()), -1, 1);

                return $_className[0];
                break;
            default:
                return null;
        }
    }


    /**
     * Returns contents of config.ini file for working environment
     *
     * @param  string $providerName
     *
     * @return array
     * @throws \Audith\Providers\Nexway\Exception\ConfigFileNotReadableException
     */
    public static function getConfig($providerName)
    {
        $_environment = "development";

        if (isset($_ENV['APPLICATION_ENV']) and !empty($_ENV['APPLICATION_ENV'])) {
            $_environment = $_ENV['APPLICATION_ENV'];
        }

        $_zendConfigReader   = new \Zend\Config\Reader\Ini();
        $_configFileLocation = dirname(dirname(__FILE__)) . "/" . ucfirst($providerName) . "/config.ini";
        try {
            $_configInformationFromIniFile = $_zendConfigReader->fromFile($_configFileLocation);
        } catch (\Zend\Config\Exception\RuntimeException $e) {
            throw new \Audith\Providers\Nexway\Exception\ConfigFileNotReadableException("Error reading INI file at location " . $_configFileLocation);
        }

        return $_configInformationFromIniFile[$_environment];
    }


    /**
     * Maps PHP-DOMNode to Provider Response Object
     *
     * @param mixed $sourceResponsePackage
     *
     * @return self
     */
    public static function mapNexwaySoapResponseObjectToOurCustomResponseObject($sourceResponsePackage)
    {
        $destinationObject = new Data\Response();
        $destinationObject = self::parseSoapResponsePackageRecursive($sourceResponsePackage, $destinationObject);

        //---------
        // Return
        //---------

        return $destinationObject;
    }


    /**
     * @param   array|\stdClass $responseObject
     * @param   Data\Response   $destinationObject
     *
     * @return  array|Data\Response
     */
    private static function parseSoapResponsePackageRecursive($responseObject, $destinationObject)
    {
        if (is_object($responseObject)) {
            foreach ($responseObject as $_key => $_value) {
                if (is_object($_value)) {
                    $_objectProperties        = array_keys(get_object_vars($_value));
                    $_countOfObjectProperties = count($_objectProperties);
                    if ($_countOfObjectProperties == 1 and array_key_exists($_objectProperties[0], self::$mapOfSoapResponseTypesToCustomResponseObjects)) {
                        $_destinationObjectNamespace = self::$mapOfSoapResponseTypesToCustomResponseObjects[$_objectProperties[0]]['nameSpace'];
                        if (is_array($_value->{$_objectProperties[0]})) {
                            $destinationObject->{$_key} = self::parseSoapResponsePackageRecursive($_value->{$_objectProperties[0]}, $_destinationObjectNamespace);
                        } elseif (is_object($_value->{$_objectProperties[0]})) {
                            // Bug: SOAPClient converts nodes with single children to an object, instead of an array of objects as it usually does with a node with multiple children.
                            $destinationObject->{$_key} = self::parseSoapResponsePackageRecursive(array($_value->{$_objectProperties[0]}), $_destinationObjectNamespace);
                        }
                    }
                } else {
                    $destinationObject->{$_key} = $_value;
                }
            }
        } elseif (is_array($responseObject)) {
            $destinationArray = array();
            foreach ($responseObject as $_key => $_value) {
                $_destinationObjectTemplate = is_string($destinationObject)
                    ? new $destinationObject()
                    : $destinationObject; // Let's make sure it's an object
                $destinationArray[$_key]    = self::parseSoapResponsePackageRecursive($_value, $_destinationObjectTemplate);
            }

            $destinationObject = $destinationArray;
        }

        return $destinationObject;
    }


    /**
     * @param Data $data
     * @param bool $throwExceptionOnFailure
     *
     * @return bool
     * @throws Exception\InvalidDataException
     */
    public static function validate(self $data, $throwExceptionOnFailure = true)
    {
        try {
            # Instance check
            if (!($data instanceof self)) {
                if ($throwExceptionOnFailure) {
                    throw new Exception\InvalidDataException("Data isn't an instance of " . self::getClassName() . "!");
                } else {
                    return false;
                }
            }

            # Emptiness check
            if (Data\Validator::isObjectFullySet($data) === false) {
                if ($throwExceptionOnFailure) {
                    throw new Exception\InvalidDataException("Empty or missing parameter for " . self::getClassName() . " object!");
                } else {
                    return false;
                }
            }
        } catch (Exception\InvalidDataException $e) {
            throw $e;
        }

        return true;
    }


    /**
     * Unsets certain list of keys from an array, in a recursive fashion
     *
     * @param array $array
     * @param array $keysToRemove
     *
     * @return void
     */
    protected static function unsetRecursive(&$array, $keysToRemove)
    {
        if (!is_array($keysToRemove)) {
            $keysToRemove = array($keysToRemove);
        }
        foreach ($array as $key => &$value) {
            if (in_array($key, $keysToRemove, true)) {
                if (is_object($array)) {
                    unset($array->$key);
                } elseif (is_array($array)) {
                    unset($array[$key]);
                }
            } else if (is_array($value) or is_object($value)) {
                self::unsetRecursive($value, $keysToRemove);
            }
        }
    }
}