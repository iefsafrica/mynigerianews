<?php

namespace Database\Seeders;

use App\Models\PaymentGateway;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class DefaultPaymentGatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         PaymentGateway::truncate();

         PaymentGateway::create([
                  'payment_gateway_id' => 1,
                  'payment_gateway' => 'Stripe',
         ]);
         PaymentGateway::create([
                  'payment_gateway_id' => 2,
                  'payment_gateway' => 'Paypal',
         ]);
         PaymentGateway::create([
                  'payment_gateway_id' => 3,
                  'payment_gateway' => 'Manually',
         ]);
    }
}
