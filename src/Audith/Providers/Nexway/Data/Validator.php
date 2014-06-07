<?php
namespace Audith\Providers\Nexway\Data;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class Validator
{
    public function validate(\Audith\Providers\Nexway\Data $data)
    {
        return $data->validate($data);
    }


    /**
     * Checks whether all properties of the object are set (i.e. not NULL) by fetching hardcoded property list of the object in question and iteratively checking against that list.
     * Optionally, subtracts a list of omitted properties from the list of properties found in the code (such as "className" property).
     * During this check, if a property within the object is an object itself, this method is recursively invoked upon that object (only if the property in question is an instance of Audith\Providers\Data).
     *
     * @param       $object
     * @param array $listOfOmittedProperties
     *
     * @return bool
     */
    public static function isObjectFullySet($object)
    {
        $_propertyListOfObject       = get_object_vars($object);
        if (!empty($_propertyListOfObject)) {
            foreach ($_propertyListOfObject as $_property => $_value) {
                if (isset($object->$_property) and $object->$_property instanceof \Audith\Providers\Nexway\Data and self::isObjectFullySet($object->$_property) === false) {
                    return false;
                } elseif (isset($object->$_property) and is_array($object->$_property)) {
                    foreach ($object->$_property as $_key => &$_arrayCollectionElements) {
                        if (!array_key_exists($_key, $_propertyListOfObject)) { // Get rid of omitted indexes.
                            continue;
                        }
                        if (self::isObjectFullySet($_arrayCollectionElements) === false) {
                            return false;
                        }
                    }
                } elseif (!isset($object->$_property)) {
                    return false;
                }
            }
        } else {
        }

        return true;
    }
}