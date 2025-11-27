<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Plan;
use Illuminate\Database\Seeder;

class DefaultPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $usd = Currency::whereCurrencyCode('USD')->first()->id;
        $input = [
            'name' => 'Standard',
            'currency_id' => $usd,
            'price' => 10,
            'frequency' => Plan::MONTHLY,
            'is_default' => 1,
            'trial_days' => 7,
            'post_count' => 7,
        ];

        $plan = Plan::create($input);

    }
}
