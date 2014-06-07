<?php
namespace Audith\Providers\Nexway;

/**
 * @author      Shahriyar Imanov <shehi@imanov.me>
 */

class Exception extends \Exception
{
    public function __construct($msg, $code = null)
    {
        $msg = "Provider/Nexway: " . $msg;
        parent::__construct($msg, $code);
    }
}