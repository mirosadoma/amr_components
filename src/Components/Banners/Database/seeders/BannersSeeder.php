<?php

namespace App\Components\Banners\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

class BannersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('banners')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('banners')->insert([
            ['image'=>'assets/site/images/two-confident-business-man-shaking-hands-during-meeting-office-success-dealing-greeting-partner-concept_1423-185.webp','link'=>"https://google.com",'is_active'=>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['image'=>'assets/site/images/two-confident-business-man-shaking-hands-during-meeting-office-success-dealing-greeting-partner-concept_1423-185.webp','link'=>"https://google.com",'is_active'=>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['image'=>'assets/site/images/two-confident-business-man-shaking-hands-during-meeting-office-success-dealing-greeting-partner-concept_1423-185.webp','link'=>"https://google.com",'is_active'=>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
        ]);
    }
}

