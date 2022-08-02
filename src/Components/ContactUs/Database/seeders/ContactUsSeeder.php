<?php

namespace App\Components\ContactUs\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

class ContactUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('contact_us')->truncate();
        Schema::enableForeignKeyConstraints();
        
        DB::table('contact_us')->insert([
            ['name'=>'amr1','email'=>'amrmohamed171996@gmail.com','phone'=>'01276069689', 'message'=>'test message test message', 'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['name'=>'amr1','email'=>'amrmohamed171996@gmail.com','phone'=>'01276069689', 'message'=>'test message test message', 'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['name'=>'amr1','email'=>'amrmohamed171996@gmail.com','phone'=>'01276069689', 'message'=>'test message test message', 'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
        ]);
    }
}
