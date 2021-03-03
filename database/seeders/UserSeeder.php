<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Timestamps - Retrieved from: https://laracasts.com/discuss/channels/laravel/how-to-seed-timestamps-field
        DB::table('users')->insert([
            'name' => 'Jane UserAdmin',
            'email' => 'jane@example.com',
            'password' => Hash::make('janepassword'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'name' => 'Bob Moderator',
            'email' => 'bob@example.com',
            'password' => Hash::make('bobpassword'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'name' => 'Susan ThemeAdmin',
            'email' => 'susan@example.com',
            'password' => Hash::make('susanpassword'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
