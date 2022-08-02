<?php

namespace App\Components\Admins\Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'                  => 'admin',
            'email'                 => 'admin@admin.com',
            'password'              => \Hash::make('admin'),
            'phone'                 => '512345678',
            'is_active'             => 1,
            'type'                  => 'admin',
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);

    }
}
