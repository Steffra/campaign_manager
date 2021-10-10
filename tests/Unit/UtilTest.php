<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Util;
use App\Models\Campaign;

class UtilTest extends TestCase
{

    public function testIsDayOnWeekend()
    {
        $this->assertTrue(Util::isDateOnWeekend('2021-10-09'));
        $this->assertTrue(Util::isDateOnWeekend('2021-10-10'));

        $this->assertFalse(Util::isDateOnWeekend('2021-10-08'));
        $this->assertFalse(Util::isDateOnWeekend('2021-10-11'));
    }

    public function testIsValidDateFormat()
    {
        $this->assertTrue(Util::isValidDateFormat('2021-10-08'));
        $this->assertTrue(Util::isValidDateFormat('2021/10/09'));
        $this->assertTrue(Util::isValidDateFormat('20211010'));

        $this->assertFalse(Util::isValidDateFormat('randomstring'));
        $this->assertFalse(Util::isValidDateFormat('202110100'));
        $this->assertFalse(Util::isValidDateFormat('2021.10,10'));
        $this->assertFalse(Util::isValidDateFormat('2021-10/10'));
    }

    public function testIsDateBetweenDates(){
        $this->assertTrue(Util::isDateBetweenDates('2021-10-09', '2021-01-01', '2021-12-31'));
        $this->assertTrue(Util::isDateBetweenDates('2021-10-09', '2021-10-09', '2021-10-09'));

        $this->assertFalse(Util::isDateBetweenDates('2021-10-09', '2021-10-10', '2021-10-15'));
        $this->assertFalse(Util::isDateBetweenDates('2021-10-09', '2021-10-01', '2021-10-08'));
    }

    public function testIsDateOnTheFirst3DaysOfTheMonth(){
        $this->assertTrue(Util::isDateOnTheFirst3DaysOfTheMonth('2021-10-01'));
        $this->assertTrue(Util::isDateOnTheFirst3DaysOfTheMonth('2021-10-02'));
        $this->assertTrue(Util::isDateOnTheFirst3DaysOfTheMonth('2021-10-03'));

        $this->assertFalse(Util::isDateOnTheFirst3DaysOfTheMonth('2021-10-04'));
        $this->assertFalse(Util::isDateOnTheFirst3DaysOfTheMonth('2021-10-13'));
        $this->assertFalse(Util::isDateOnTheFirst3DaysOfTheMonth('2021-10-30'));
    }

    public function testIsDateOnTheLast3DaysOfTheMonth(){
        $this->assertTrue(Util::isDateOnTheLast3DaysOfTheMonth('2021-10-31'));
        $this->assertTrue(Util::isDateOnTheLast3DaysOfTheMonth('2021-10-30'));
        $this->assertTrue(Util::isDateOnTheLast3DaysOfTheMonth('2021-10-29'));
        $this->assertTrue(Util::isDateOnTheLast3DaysOfTheMonth('2021-02-26'));
        $this->assertTrue(Util::isDateOnTheLast3DaysOfTheMonth('2020-02-27'));

        $this->assertFalse(Util::isDateOnTheLast3DaysOfTheMonth('2021-10-04'));
        $this->assertFalse(Util::isDateOnTheLast3DaysOfTheMonth('2021-10-13'));
        $this->assertFalse(Util::isDateOnTheLast3DaysOfTheMonth('2021-10-25'));
        $this->assertFalse(Util::isDateOnTheLast3DaysOfTheMonth('2021-02-25'));
        $this->assertFalse(Util::isDateOnTheLast3DaysOfTheMonth('2020-02-26'));
    }

    public function testIsOverlappingCampaigns(){
           $c1 = new Campaign;
           $c1->start = '2021-09-01';
           $c1->end = '2021-09-30';

           $c2 = new Campaign;
           $c2->start = '2021-10-01';
           $c2->end = '2021-10-31';

           $c3 = new Campaign;
           $c3->start = '2021-11-01';
           $c3->end = '2021-11-30';

           $c4 = new Campaign;
           $c4->start = '2021-09-01';
           $c4->end = '2021-11-30';

           $c5 = new Campaign;
           $c5->start = '2021-10-05';
           $c5->end = '2021-10-15';

           $c6 = new Campaign;
           $c6->start = '2021-09-05';
           $c6->end = '2021-10-15';

           $c7 = new Campaign;
           $c7->start = '2021-10-15';
           $c7->end = '2021-11-10';

           $this->assertFalse(Util::isOverlappingCampaigns($c1, $c2));
           $this->assertFalse(Util::isOverlappingCampaigns($c1, $c3));
           $this->assertFalse(Util::isOverlappingCampaigns($c2, $c3));

           $this->assertTrue(Util::isOverlappingCampaigns($c1, $c4));
           $this->assertTrue(Util::isOverlappingCampaigns($c2, $c4));
           $this->assertTrue(Util::isOverlappingCampaigns($c3, $c4));
           $this->assertTrue(Util::isOverlappingCampaigns($c2, $c5));
           $this->assertTrue(Util::isOverlappingCampaigns($c2, $c6));
           $this->assertTrue(Util::isOverlappingCampaigns($c2, $c7));
    }
}
