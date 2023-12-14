<?php

/**
 * 
 * Used the seeder so I could import the data form the csv file to the database
 * 
 */

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Price;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class priceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $csvfie = base_path('import.csv');

        if (($handle = fopen($csvfie, 'r')) !== false) {
            fgetcsv($handle);

            while (($data = fgetcsv($handle)) !== false) {
                $price = new Price();

                // Since the csv file had this data based on other columns
                // I had to use each Model to get the specific value for it's id as shown
                $price->product_id = Product::where('sku', $data[0])->first()?->id;
                $price->account_id = Account::where('external_reference', $data[1])->first()?->id;
                $price->user_id = User::where('external_reference', $data[2])->first()?->id;

                $price->quantity = $data[3];
                $price->value = $data[4];

                $price->save();
            }

            fclose($handle);
        }
    }
}
