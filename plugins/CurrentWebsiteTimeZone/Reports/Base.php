<?php

/**
 * Matomo - free/libre analytics platform
 *
 * @link    https://matomo.org
 * @license https://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\CurrentWebsiteTimeZone\Reports;

use Piwik\Plugin\Report;
use Piwik\Report\ReportWidgetFactory;
use Piwik\Widget\WidgetsList;


abstract class Base extends Report
{
    protected function init()
    {
        $this->categoryId = 'Live!';
    }

    public function configureWidgets(WidgetsList $widgetsList, ReportWidgetFactory $factory)
    {
        $widgetsList->addWidgetConfig($factory->createWidget());
    }
}
