<?php
namespace Audith\Providers\Nexway\Exception;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */

class LocationTitleIsNotValidException extends \Audith\Providers\Nexway\Exception
{
    public function __construct($msg = "", $code = null)
    {
        parent::__construct($msg, $code);
    }
}