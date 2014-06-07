<?php
namespace Audith\Providers\Nexway\Data;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class Response extends \Audith\Providers\Nexway\Data
{
    /**
     * @var integer
     */
    public $responseCode = 0;

    /**
     * @var string
     */
    public $responseMessage = "OK";
}