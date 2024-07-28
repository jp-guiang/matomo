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
    public function getLocalandWebsiteTime($idSite)
    {
        $table = new DataTable();

        $table->addRowFromArray(array(Row::COLUMNS => array('local_time' => $this->getLocalTime(), 'site_time' => $this->getSiteTime($idSite))));

        return $table;
    }

    public function getSiteTime($idSite)
    {
        $date = Date::now()->getDateTime();

        $timezone = Site::getTimezoneFor($idSite);

        $timeInTz = Date::factory($date, $timezone)->getLocalized(Date::DATETIME_FORMAT_SHORT);
        
        return $timeInTz;
    }

    public function getLocalTime()
    {
        return Date::now()->getLocalized(Date::DATETIME_FORMAT_SHORT);
    }
}
