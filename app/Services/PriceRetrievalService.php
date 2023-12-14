<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Price;
use App\Models\Product;

class PriceRetrievalService
{
    protected $livePriceService;

    public function __construct(LivePriceService $livePriceService)
    {
        $this->livePriceService = $livePriceService;
    }

    public function getPrice($productCode, $accountId = null)
    {
        $livePrices = $this->livePriceService->getLivePrices();


        $livePrice = collect($livePrices)->first(function ($price) use ($productCode, $accountId) {
            if (isset($accountId)) {
                return $price['sku'] === $productCode && (isset($price['account']) && $price['account'] === $accountId);
            } else {
                return $price['sku'] === $productCode && !isset($price['account']);
            }
        });

        if ($livePrice) {
            return $livePrice['price'];
        }

        return $this->getDatabasePrice($productCode, $accountId);
    }

    protected function getDatabasePrice($productCode, $accountId = null)
    {
        $productId = Product::where('sku', $productCode)->first()?->id;

        $accountId = Account::where('external_reference', $accountId)->first()?->id;

        if ($accountId) {
            $accountPriceCollection = Price::where('product_id', $productId)
                ->where('account_id', $accountId)
                ->get();

            if ($accountPriceCollection) {
                $minValue = $accountPriceCollection->min('value');

                $minValueModel = $accountPriceCollection->firstWhere('value', $minValue);

                return $minValueModel->value;
            }
        }

        $freeValueCollection = Price::where('product_id', $productId)
            ->whereNull('account_id')->get();

        if ($freeValueCollection) {
            $minValue = $freeValueCollection->min('value');

            $minValueModel = $freeValueCollection->firstWhere('value', $minValue);
            return $minValueModel->value;
        }

        return null;
    }
}
