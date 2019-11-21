<?php
namespace Calendar\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use Calendar\View\Helper\CalendarHelper;

/**
 * Calendar\View\Helper\CalendarHelper Test Case
 */
class CalendarHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Calendar\View\Helper\CalendarHelper
     */
    public $Calendar;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Calendar = new CalendarHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Calendar);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
