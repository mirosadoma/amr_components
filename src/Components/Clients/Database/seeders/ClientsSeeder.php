<?php

namespace App\Components\Clients\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'                  => 'client',
            'email'                 => 'client@client.com',
            'password'              => \Hash::make('client'),
            'phone'                 => '512345676',
            'is_active'             => 1,
            'city_id'               => 1,
            'type'                  => 'client',
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ]);

        $faker = \Faker\Factory::create();
        foreach (range(1,10) as $index) {
            $name = $faker->name;
            User::create([
                'name'                  => $faker->name,
                'email'                 => $faker->safeEmail,
                'password'              => bcrypt('client'),
                'phone'                 => '5' . $index * 11111111,
                'is_active'             => 1,
                'city_id'               => 1,
                'type'                  => 'client',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ]);
        }
    }
}
