<?php

namespace App\Components\Cities\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('cities')->truncate();
        Schema::enableForeignKeyConstraints();
        
        DB::table('cities')->insert([
            ['created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
        ]);
        Schema::disableForeignKeyConstraints();
        DB::table('cities_translations')->truncate();
        Schema::enableForeignKeyConstraints();
        
        DB::table('cities_translations')->insert([
            ['city_id' => 1, 'name' => '????????', 'locale' => 'ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 1, 'name' => 'Tabuk', 'locale' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 2, 'name' => '????????????', 'locale' => 'ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 2, 'name' => 'Riyadh', 'locale' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 3, 'name' => '????????????', 'locale' => 'ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 3, 'name' => 'At Taif', 'locale' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 4, 'name' => '?????? ??????????????', 'locale' => 'ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 4, 'name' => 'Makkah Al Mukarramah', 'locale' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 5, 'name' => '????????', 'locale' => 'ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 5, 'name' => 'Hail', 'locale' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 6, 'name' => '??????????', 'locale' => 'ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 6, 'name' => 'Buraydah', 'locale' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 7, 'name' => '????????????', 'locale' => 'ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 7, 'name' => 'Al Hufuf', 'locale' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 8, 'name' => '????????????', 'locale' => 'ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 8, 'name' => 'Ad Dammam', 'locale' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 9, 'name' => '?????????????? ??????????????', 'locale' => 'ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 9, 'name' => 'Al Madinah Al Munawwarah', 'locale' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 10, 'name' => '????????', 'locale' => 'ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 10, 'name' => 'Abha', 'locale' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 11, 'name' => '??????????', 'locale' => 'ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 11, 'name' => 'Jazan', 'locale' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 12, 'name' => '??????', 'locale' => 'ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 12, 'name' => 'Jeddah', 'locale' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 13, 'name' => '??????????????', 'locale' => 'ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 13, 'name' => 'Al Majmaah', 'locale' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 14, 'name' => '??????????', 'locale' => 'ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 14, 'name' => 'Al Khubar', 'locale' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 15, 'name' => '?????? ????????????', 'locale' => 'ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 15, 'name' => 'Hafar Al Batin', 'locale' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 16, 'name' => '???????? ????????????', 'locale' => 'ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 16, 'name' => 'Qaryat Al Ulya', 'locale' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 17, 'name' => '????????????', 'locale' => 'ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 17, 'name' => 'Al Jubail', 'locale' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 18, 'name' => '????????????????', 'locale' => 'ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 18, 'name' => 'An Nuayriyah', 'locale' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 19, 'name' => '??????????????', 'locale' => 'ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 19, 'name' => 'Dhahran', 'locale' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 20, 'name' => '??????????', 'locale' => 'ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 20, 'name' => 'Al Wajh', 'locale' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 21, 'name' => '????????', 'locale' => 'ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 21, 'name' => 'Buqayq', 'locale' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 22, 'name' => '????????????', 'locale' => 'ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 22, 'name' => 'Az Zulfi', 'locale' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 23, 'name' => '????????', 'locale' => 'ar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['city_id' => 23, 'name' => 'Khaybar', 'locale' => 'en', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
        $admins = \App\Models\Admin::all();
        foreach($admins as $admin){
            $admin->update(['city_id'=>1]);
        }
    }
}