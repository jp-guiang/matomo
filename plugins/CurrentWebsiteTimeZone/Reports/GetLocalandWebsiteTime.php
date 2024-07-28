<?php

/**
 * Matomo - free/libre analytics platform
 *
 * @link    https://matomo.org
 * @license https://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\CurrentWebsiteTimeZone\Reports;

use Piwik\Piwik;
use Piwik\Plugin\ViewDataTable;
use Piwik\Plugins\VisitTime\Columns\LocalTime;

/**
 * This class defines a new report.
 *
 * See {@link http://developer.piwik.org/api-reference/Piwik/Plugin/Report} for more information.
 */
class GetLocalandWebsiteTime extends Base
{
    protected function init()
    {
        parent::init();

        $this->name          = Piwik::translate('CurrentWebsiteTimeZone_LocalandWebsiteTime');
        $this->dimension     = null;
        $this->documentation = Piwik::translate('Shows the user and website time if they are in different timezones');

        $this->order = 1;
        $this->subcategoryId = $this->name;

        $this->metrics       = array('local_time', 'site_time');

    }

    public function configureView(ViewDataTable $view)
    {
        
        $view->config->columns_to_display = array_merge($this->metrics);
    }

    public function getRelatedReports()
    {
        return array(); // eg return array(new XyzReport());
    }

}
