<?php

namespace App\Livewire;

use App\Services\LivePriceService;
use App\Services\PriceRetrievalService;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class PriceChecker extends Component
{
    public $result = '';
    public $product_code = '';
    public $account_id = '';

    public function checkPrice()
    {
        $this->validate([
            'product_code' => 'required|string',
            'account_id' => 'nullable|string',
        ]);

        $arrProducts =  explode(',', $this->product_code);

        $priceRetrieval = new PriceRetrievalService(new LivePriceService);

        $response = [];

        foreach ($arrProducts as $key => $value) {
            $response[$key] = ['product' => $value, 'price' => $priceRetrieval->getPrice($value, $this->account_id)];
        }

        $this->result = json_encode($response);
    }

    public function render()
    {
        return view('livewire.price-checker');
    }
}
