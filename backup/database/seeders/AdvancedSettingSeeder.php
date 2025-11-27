<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

/**
 * Class AdvancedSettingSeeder
 */
class AdvancedSettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::create(['key' => 'registration_system', 'value' => 1]);
        Setting::create(['key' => 'emoji_system', 'value' => 1]);
    }
}
