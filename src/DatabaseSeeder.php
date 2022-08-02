<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        foreach (glob(app_path() . '/Components/**') as $value) {
            $path = explode('/',$value);
            $value = $path[count($path) -1 ];
            $value = '\App\Components\\'.$value.'\Database\seeders\\'.$value.'Seeder';
            $this->call($value);
        }
    }
}
