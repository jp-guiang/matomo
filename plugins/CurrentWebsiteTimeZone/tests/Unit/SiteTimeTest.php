<?php

/**
 * Matomo - free/libre analytics platform
 *
 * @link    https://matomo.org
 * @license https://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\CurrentWebsiteTimeZone\tests\Unit;

use Piwik\Plugins\CurrentWebsiteTimeZone\Reports\GetLocalandWebsiteTime;

/**
 * @group CurrentWebsiteTimeZone
 * @group SiteTimeTest
 * @group Plugins
 */
class SiteTimeTest extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->getLocalAndWebsiteSite = new GetLocalandWebsiteTime();
    }

    public function tearDown(): void
    {
        // tear down here if needed
    }

    /**
     * All your actual test methods should start with the name "test"
     */
    public function testGetWebsiteTime()
    {
        $this->assertEquals(2, 1 + 1);
    }
}
