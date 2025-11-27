<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (\DB::table('companies')->count() > 0) {
            return;
        }
        $themes =[
            [
                'name'=>'Maan News','address_line1'=>'Cecilia Chapman, 711-2880','address_line2'=>'NullaSt. Mankato Mississippi 96522 (257) 563-7401','phone'=>'+8802659874164','email'=>'maan.news@turitor.com','location_map'=>'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3645.133068555471!2d91.08454181482016!3d23.99107768447128!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3754051b50ebac3f%3A0x735c1cc426d8ebb!2sNatai%20Bodtoli%20Bazar%2C%20Natai%2C%2C%20Brahmanbaria!5e0!3m2!1sen!2sbd!4v1594548160557!5m2!1sen!2sbd','message'=>'Visit our agency or simply send us an email anytime you want. If you have any questions, please feel free.'
            ]
        ];
        foreach ($themes as $theme){
            Company::create($theme);
        }
    }
}
