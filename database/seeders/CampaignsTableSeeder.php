<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Campaign;
class CampaignsTableSeeder extends Seeder
{
    private $campaigns = [
        ['name' => 'Szeptemberi konzol kiárusítás', 'start' => '2021-09-01','end' =>  '2021-09-30'],
        ['name' => 'Októberi konzol kiárusítás', 'start' => '2021-10-01','end' =>  '2021-10-31'],
        ['name' => 'Novemberi konzol kiárusítás', 'start' => '2021-11-01','end' =>  '2021-11-30'],
        ['name' => 'Őszi konzol áradat', 'start' => '2021-09-01','end' =>  '2021-11-30']
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->campaigns as $campaign){
            Campaign::create([
                'name' => $campaign['name'],
                'start' => $campaign['start'],
                'end' => $campaign['end'],
                'approved' => false,
                'is_active' =>  false
            ]);
        }
    }
}
