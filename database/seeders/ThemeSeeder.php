<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Retrieved from: https://www.bootstrapcdn.com/bootswatch/?theme=4
        DB::table('themes')->insert([
            'name' => 'Cerulean',
            'cdn_url' => 'https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/cerulean/bootstrap.min.css',
            'created_by' => '3',
            'updated_by' => '3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('themes')->insert([
            'name' => 'Cyborg',
            'cdn_url' => 'https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/cyborg/bootstrap.min.css',
            'created_by' => '3',
            'updated_by' => '3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('themes')->insert([
            'name' => 'Darkly',
            'cdn_url' => 'https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/darkly/bootstrap.min.css',
            'created_by' => '3',
            'updated_by' => '3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('themes')->insert([
            'name' => 'Flatly',
            'cdn_url' => 'https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/flatly/bootstrap.min.css',
            'created_by' => '3',
            'updated_by' => '3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('themes')->insert([
            'name' => 'Journal',
            'cdn_url' => 'https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/journal/bootstrap.min.css',
            'created_by' => '3',
            'updated_by' => '3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('themes')->insert([
            'name' => 'Litera',
            'cdn_url' => 'https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/litera/bootstrap.min.css',
            'created_by' => '3',
            'updated_by' => '3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('themes')->insert([
            'name' => 'Minty',
            'cdn_url' => 'https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/minty/bootstrap.min.css',
            'created_by' => '3',
            'updated_by' => '3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('themes')->insert([
            'name' => 'Pulse',
            'cdn_url' => 'https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/pulse/bootstrap.min.css',
            'created_by' => '3',
            'updated_by' => '3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('themes')->insert([
            'name' => 'Solar',
            'cdn_url' => 'https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/solar/bootstrap.min.css',
            'created_by' => '3',
            'updated_by' => '3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('themes')->insert([
            'name' => 'Yeti',
            'cdn_url' => 'https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/yeti/bootstrap.min.css',
            'created_by' => '3',
            'updated_by' => '3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
