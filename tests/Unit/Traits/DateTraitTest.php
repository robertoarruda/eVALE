<?php

namespace Tests\Nero\Evale\Traits;

use Carbon\Carbon;
use Nero\Evale\Traits\DateTrait;
use Tests\TestCase;

/**
 * @coversDefaultClass \Nero\Evale\Traits\DateTrait
 */
class DateTraitTest extends TestCase
{
    use DateTrait;

    public function setUp()
    {
        $this->carbon = new Carbon();
    }

    public function assertPreConditions()
    {
        return;
    }

    /**
     * @covers ::date
     */
    public function testDate()
    {
        $now = $this->carbon->now()->hour(0)->minute(0)->second(0);
        $this->carbon->setTestNow($now);

        $this->assertEquals(
            $now,
            $this->date()
        );
    }

    /**
     * @covers ::date
     */
    public function testDateWithBaseDate()
    {
        $baseDate = '1989-03-07';
        $date = $this->carbon->parse($baseDate)->hour(0)->minute(0)->second(0);

        $this->assertEquals(
            $date,
            $this->date($baseDate)->hour(0)->minute(0)->second(0)
        );
    }

    /**
     * @covers ::date
     */
    public function testDateWithBaseDateAndFormat()
    {
        $baseDate = '07/03/1989 00:00:00';
        $date = $this->carbon->parse('1989-03-07')->hour(0)->minute(0)->second(0);

        $this->assertEquals(
            $date,
            $this->date($baseDate, 'd/m/Y H:i:s')
        );
    }

    /**
     * @covers ::startOfMonth
     */
    public function testStartOfMonth()
    {
        $now = $this->carbon->now();
        $this->carbon->setTestNow($now);

        $this->assertEquals(
            $now->startOfMonth(),
            $this->startOfMonth()
        );
    }

    /**
     * @covers ::startOfMonth
     */
    public function testStartOfMonthWithBaseDate()
    {
        $baseDate = '1989-03-07';
        $date = $this->carbon->parse($baseDate);

        $this->assertEquals(
            $date->startOfMonth(),
            $this->startOfMonth($baseDate)
        );
    }

    /**
     * @covers ::endOfMonth
     */
    public function testEndOfMonth()
    {
        $now = $this->carbon->now();
        $this->carbon->setTestNow($now);

        $this->assertEquals(
            $now->endOfMonth(),
            $this->endOfMonth()
        );
    }

    /**
     * @covers ::endOfMonth
     */
    public function testEndOfMonthWithBaseDate()
    {
        $baseDate = '1989-03-07';
        $date = $this->carbon->parse($baseDate);

        $this->assertEquals(
            $date->endOfMonth(),
            $this->endOfMonth($baseDate)
        );
    }

    /**
     * @covers ::dateOrStartOfMonth
     */
    public function testDateOrStartOfMonth()
    {
        $now = $this->carbon->now();
        $this->carbon->setTestNow($now);

        $this->assertEquals(
            $now->startOfMonth(),
            $this->dateOrStartOfMonth()
        );
    }

    /**
     * @covers ::dateOrStartOfMonth
     */
    public function testDateOrStartOfMonthWithBaseDate()
    {
        $baseDate = '1989-03-07';
        $date = $this->carbon->parse($baseDate)->hour(0)->minute(0)->second(0);

        $this->assertEquals(
            $date,
            $this->dateOrStartOfMonth($baseDate)
        );
    }

    /**
     * @covers ::dateOrEndOfMonth
     */
    public function testDateOrEndOfMonth()
    {
        $now = $this->carbon->now();
        $this->carbon->setTestNow($now);

        $this->assertEquals(
            $now->endOfMonth(),
            $this->dateOrEndOfMonth()
        );
    }

    /**
     * @covers ::dateOrEndOfMonth
     */
    public function testDateOrEndOfMonthWithBaseDate()
    {
        $baseDate = '1989-03-07';
        $date = $this->carbon->parse($baseDate)->hour(23)->minute(59)->second(59);

        $this->assertEquals(
            $date,
            $this->dateOrEndOfMonth($baseDate)
        );
    }

}
