<?php
namespace App;
use App\Models\Campaign;

class Util
{
    public static function isDateOnWeekend($strDate)
    {
        return (date('N', strtotime($strDate)) >= 6);
    }

    public static function isValidDateFormat($strDate){

        return (bool)strtotime($strDate);
    }

    public static function isDateBetweenDates($strDate, $strStartDate, $strEndDate)
    {
        return  ($strDate >= $strStartDate && $strDate <= $strEndDate);
    }


    public static function isDateOnTheFirst3DaysOfTheMonth($strDate)
    {
        $numDay = date('d', strtotime($strDate));

        return $numDay <= 3;
    }

    public static function isDateOnTheLast3DaysOfTheMonth($strDate)
    {
        $numDay = date('d', strtotime($strDate));
        $numMonth = date('m', strtotime($strDate));
        $numYear = date('y', strtotime($strDate));

        $numNumberOfDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $numMonth, $numYear);

        return $numNumberOfDaysInMonth -$numDay < 3;
    }

    public static function isOverlappingCampaigns(Campaign $first, Campaign  $second){
        return ($first->start >= $second->start && $first->start <= $second->end) ||
               ($second->start >= $first->start && $second->start <= $first->end);
    }
}



