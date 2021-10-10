<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use DB;

class ProductsTableSeeder extends Seeder
{
    private $products = ['XBox One', 'Xbox One S', 'XBox One X', 'PlayStation 4', 'PlayStation 4 All Digital edition'];
    private $campaign_products = [
        [1,1],
        [1,2],
        [1,3],
        [2,4],
        [2,4],
        [3,1],
        [3,2],
        [3,3],
        [4,1],
        [4,2],
        [4,3],
        [4,4],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->products as $product){
            Product::create([
                'name' => $product,
                'is_publicated' => false,
            ]);
        }

        foreach($this->campaign_products as $campaign_product){
            DB::table('campaign_product')->insert([
                'campaign_id' => $campaign_product[0],
                'product_id' => $campaign_product[1]
            ]);
        }


    }
}
