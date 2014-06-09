<?php
namespace Audith\Providers\Nexway\Data\Response\OrderApi\getDownloadInfo;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class orderLines extends \Audith\Providers\Nexway\Data
{
    /**
     * @var integer
     */
    public $productRef;

    /**
     * @var orderLines\files[]
     */
    public $files = array();
}
