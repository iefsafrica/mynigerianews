<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Seeder;

class ThemeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (\DB::table('themes')->count() > 0) {
            return;
        }
        $themes =[
            [
                'title'=>'Maan News','author'=>'Maan Technology','version'=>'1.18.2','description'=>'Maan News- Laravel Magazine Blog Theme'
            ]
        ];
        foreach ($themes as $theme){
            Theme::create($theme);
        }
    }
}
