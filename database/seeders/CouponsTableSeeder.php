<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CouponsTableSeeder extends Seeder
{
    private $coupons = [
        ['campaign_id' => 1, 'code' => 'SzeptXbox10'],
        ['campaign_id' => 1, 'code' => 'SzeptXbox20'],
        ['campaign_id' => 2, 'code' => 'OktPs10'],
        ['campaign_id' => 2, 'code' => 'OktPs20'],
        ['campaign_id' => 3, 'code' => 'NovXbox10'],
        ['campaign_id' => 3, 'code' => 'NovXbox20'],
        ['campaign_id' => 4, 'code' => '2021Osz10%'],
        ['campaign_id' => 4, 'code' => '2021Osz15%'],
        ['campaign_id' => 4, 'code' => '2021Osz20%'],
    ];


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->coupons as $coupon){
            Coupon::create([
                'campaign_id' => $coupon['campaign_id'],
                'code' => $coupon['code'],
                'is_activated' => false,
            ]);
        }
    }
}
