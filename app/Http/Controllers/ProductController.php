<?php

namespace App\Http\Controllers;

Use App\Models\Product;
Use App\Util;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function show(Product $product)
    {
        return $product->load('campaigns');
    }

    public function publicate(Request $request, Product $product)
    {
        try{
            $this->validatePublicationRequest($request, $product);
            $product->publicate();
            return response()->json($product, 200);
        }catch(Exception $e){
            return response()->json(['Error:' => $e->getMessage()], 400);
        }
    }

    private function validatePublicationRequest(Request $request, Product $product)
    {
        $strDate = $request->get('publication_date');

        if($product->is_publicated){
            throw new Exception('Can not publicate an already public product!');
        }

        if(empty($strDate)){
            throw new Exception('The publication_date field must not be empty!');
        }

        if(!Util::isValidDateFormat($strDate)){
            throw new Exception('Invalid publication_date format!');
        }

    }
}
