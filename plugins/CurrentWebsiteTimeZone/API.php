<?php

/**
 * Matomo - free/libre analytics platform
 *
 * @link    https://matomo.org
 * @license https://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\CurrentWebsiteTimeZone;

use Piwik\DataTable;
use Piwik\DataTable\Row;
use Piwik\Db as PiwikDb;
use Piwik\DbHelper;
use Piwik\Archive;
use Piwik\Site;
use Piwik\Date;


/**
 * API for plugin CurrentWebsiteTimeZone
 *
 * @method static \Piwik\Plugins\CurrentWebsiteTimeZone\API getInstance()
 */
class API extends \Piwik\Plugin\API
{
    /**
     * Another example method that returns a data table.
     * @param int    $idSite
     * @param string $period
     * @param string $date
     * @param bool|string $segment
     * @return DataTable
     */
    public function getLocalandWebsiteTime($idSite, $period, $date, $segment = false)
    {
        $table = new DataTable();

        $date = Date::now()->getDateTime();

        $timezone = Site::getTimezoneFor($idSite);

        $timeInTz = Date::factory($date, $timezone)->toString('d-M-Y H:i:s');

        $localTime = Date::now()->getLocalized(Date::DATETIME_FORMAT_SHORT);

        $table->addRowFromArray(array(Row::COLUMNS => array('local_time' => $localTime, 'site_time' => $timeInTz)));


        return $table;
    }
}
