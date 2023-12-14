<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class LivePriceService
{
    /**
     * Reads the live prices from the JSON file and returns them.
     *
     * @return array
     */
    public function getLivePrices()
    {
        $jsonfile = base_path('live_prices.json');

        if (File::exists($jsonfile)) {
            $jsonData = File::get($jsonfile);
            $livePrices = json_decode($jsonData, true);

            return $livePrices;
        }

        return [];
    }
}
