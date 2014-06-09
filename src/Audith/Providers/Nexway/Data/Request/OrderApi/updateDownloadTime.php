<?php
namespace Audith\Providers\Nexway\Data\Request\OrderApi;

/**
 * @author Shahriyar Imanov <shehi@imanov.me>
 */
class updateDownloadTime extends \Audith\Providers\Nexway\Data\Request\OrderApi
{
    /**
     * @var string
     */
    public $partnerOrderNumber;

    /**
     * The time value.
     *
     * @var string
     * @usage This field accepts 2 types of values:
     *        1) A date time which will be used as new expiration date: in format 'YYYY-MM-DD' (e.g. '2011-05-23').
     *        2) A period which will be added to the current expiration date: in format based on the ISO 8601 duration specification PYYYYMMDD (e.g. 'P1Y2M', 'P5D', 'P0Y6M', 'P6Y14M1D').
     */
    public $value;
}
