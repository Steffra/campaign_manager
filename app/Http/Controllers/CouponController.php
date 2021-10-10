<?php

namespace App\Http\Controllers;

Use App\Models\Coupon;
Use App\Util;
use Exception;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        return Coupon::all();
    }

    public function show(Coupon $coupon)
    {
        return response()->json($coupon->load('campaign'), 200);
    }

    public function activate(Request $request, Coupon $coupon)
    {
        try{
            $this->validateActivationRequest($request, $coupon);
            $coupon->activate();
            return response()->json($coupon, 200);
        }catch(Exception $e){
            return response()->json(['Error:' => $e->getMessage()], 400);
        }
    }

    private function validateActivationRequest($request, Coupon $coupon)
    {
        $strDate = $request->get('activation_date');

        if($coupon->is_activated){
            throw new Exception('Can not activate an already active coupon!');
        }

        if(empty($strDate)){
            throw new Exception('The activation_date field must not be empty!');
        }

        if(!Util::isValidDateFormat($strDate)){
            throw new Exception('Invalid activation_date format!');
        }

        if(!(Util::isDateOnTheFirst3DaysOfTheMonth($strDate) || Util::isDateOnTheLast3DaysOfTheMonth($strDate))){
            throw new Exception("A coupon can only be activated on the first or last 3 days of the given month.");
        }

        //Check if the date is during the campaign or not
        if(!Util::isDateBetweenDates($strDate, $coupon->campaign->start, $coupon->campaign->end)){
            throw new Exception("The selected date must be between the start and end of the campaign.");
        }
    }
}
