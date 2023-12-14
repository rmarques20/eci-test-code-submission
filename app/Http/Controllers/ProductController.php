<?php

namespace App\Http\Controllers;

use App\Services\LivePriceService;
use App\Services\PriceRetrievalService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Request $req)
    {
        $req->validate([
            'product_code' => 'required|array',
            'account_id' => 'nullable|string',
        ]);

        $product_code = $req->product_code;
        $account_id = $req->account_id;

        $priceRetrieval = new PriceRetrievalService(new LivePriceService);

        $response = [];

        foreach ($product_code as $key => $value) {
            $response[$key] = ['product' => $value, 'price' => $priceRetrieval->getPrice($value, $account_id)];
        }

        return $response;
    }
}
