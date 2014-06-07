<?php
namespace Audith\Providers\Nexway\Data\Response\OrderApi\create\orderLines;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class files extends \Audith\Providers\Nexway\Data
{
    /**
     * @var string
     */
    public $label;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $url;

    /**
     * @var float
     */
    public $size;

    /**
     * @var string
     */
    public $group;
}