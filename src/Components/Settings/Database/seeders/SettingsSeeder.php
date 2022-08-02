<?php

namespace App\Components\Settings\Database\Seeders;

use App\Components\Settings\Models\SiteConfig;
use App\Components\Settings\Models\SiteSocial;
use App\Components\Settings\Models\SiteMail;
use App\Components\Settings\Models\SiteSms;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // SiteConfig
        Schema::disableForeignKeyConstraints();
        DB::table('site_config')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('site_config')->insert([
            [ 
            'email'                     => "amrmohamed171996@gmail.com",
            'phone'                     => 511111111,
            'whatsapp'                  => 511111111,
            'address'                   => "المنصورة",
            // 'chart_year'                => now()->year,
            'close'                     => 0,
            'close_msg'                 => '<h1><em><span dir=\"rtl\"><big><strong>قريباً بإذن الله ......</strong></big></span></em></h1>',
            'appstore'                  => "https://www.google.com/",
            'googleplay'                => "https://www.google.com/",
            'created_at'                => Carbon::now(),
            'updated_at'                => Carbon::now()
            ],
        ]);
        // SiteConfig Translations
        Schema::disableForeignKeyConstraints();
        DB::table('site_config_translations')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('site_config_translations')->insert([
            ['site_config_id'=>1,'title' => 'أنا إيجابى', 'keywords' => 'أنا إيجابى', 'description' => 'وصف أنا إيجابى', 'locale' => 'ar','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['site_config_id'=>1,'title' => env('APP_NAME', 'Ana Egaby'), 'keywords' => 'Ana Egaby', 'description' => 'Ana Egaby Describtions', 'locale' => 'en','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
        ]);
        // SiteSocial
        SiteSocial::create([
            'type'                  => 'facebook',
            'value'                 => 'https://www.google.com/',
            'class'                 => 'facebook-square',
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now()
        ]);
        // SiteSocial
        SiteSocial::create([
            'type'                  => 'twitter',
            'value'                 => 'https://www.google.com/',
            'class'                 => 'twitter-square',
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now()
        ]);
        // SiteSocial
        SiteSocial::create([
            'type'                  => 'instagram',
            'value'                 => 'https://www.google.com/',
            'class'                 => 'instagram-square',
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now()
        ]);
    }

}
