<?php

namespace App\Components\Pages\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('pages')->truncate();
        Schema::enableForeignKeyConstraints();
        
        DB::table('pages')->insert([
            [ 'image' =>'https://via.placeholder.com/150','is_active'=>1,'is_delete'=>0,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            [ 'image' =>'https://via.placeholder.com/150','is_active'=>1,'is_delete'=>0,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            [ 'image' =>'https://via.placeholder.com/150','is_active'=>1,'is_delete'=>0,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            [ 'image' =>'https://via.placeholder.com/150','is_active'=>1,'is_delete'=>0,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
        ]);
        Schema::disableForeignKeyConstraints();
        DB::table('pages_translations')->truncate();
        Schema::enableForeignKeyConstraints();
        
        DB::table('pages_translations')->insert([
            ['page_id' => 1, 'title' => 'ما تقدمه المبادرة ؟', 'excerpt' => 'وصف مختصر يكتب هنا', 'locale' => 'ar', 'content' => 'المحتوي يكتب هنا', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['page_id' => 1, 'title' => 'What does the initiative offer?', 'excerpt' => 'small description here', 'locale' => 'en', 'content' => 'Content Written Here ', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['page_id' => 2, 'title' => 'الأسئلة الشائعة', 'excerpt' => 'وصف مختصر يكتب هنا', 'locale' => 'ar', 'content' => 'المحتوي يكتب هنا', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['page_id' => 2, 'title' => 'common questions', 'excerpt' => 'small description here', 'locale' => 'en', 'content' => 'Content Written Here ', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['page_id' => 3, 'title' => 'الشروط و الاحكام','excerpt' => 'وصف مختصر يكتب هنا','locale' => 'ar','content'=>'المحتوي يكتب هنا','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['page_id' => 3, 'title' => 'Terms and Conditions','excerpt' => 'small description here','locale' => 'en','content'=>'Content Write Here ','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['page_id' => 4, 'title' => 'سياسة الخصوصية', 'excerpt' => 'وصف مختصر يكتب هنا', 'locale' => 'ar', 'content' => 'المحتوي يكتب هنا', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['page_id' => 4, 'title' => 'Privacy policy', 'excerpt' => 'small description here', 'locale' => 'en', 'content' => 'Content Written Here ', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
