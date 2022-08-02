<?php

namespace App\Components\Roles\Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('roles')->truncate();
        Schema::enableForeignKeyConstraints();
        
        Schema::disableForeignKeyConstraints();
        DB::table('permissions')->truncate();
        Schema::enableForeignKeyConstraints();
        
        Schema::disableForeignKeyConstraints();
        DB::table('role_has_permissions')->truncate();
        Schema::enableForeignKeyConstraints();
        
        Role::create(['guard_name'=>'admin','name' => 'admin']);
        Role::create(['guard_name'=>'admin','name' => 'writer']);

        foreach (get_permissions() as $key => $perm)
        {
            foreach ($perm as $item) {
                Permission::create(['guard_name'=>'admin', 'name' => $key.'.'.$item]);
            }
        }

        foreach (Permission::where('guard_name', 'admin')->get() as $value) {
            DB::table('role_has_permissions')->insert([
                'role_id' => 1,
                'permission_id' => $value->id,
            ]);
        }

        $user = Admin::where('id', 1)->first();
        $user->assignRole('admin');
    }
}
