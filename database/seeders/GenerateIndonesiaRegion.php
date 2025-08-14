<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class GenerateIndonesiaRegion extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            $path = database_path('sql/indonesia.sql');
            $sql = File::get($path);
            DB::unprepared($sql);
        } catch (\Throwable $th) {
            throw $th;
            // dd($th->getMessage());
        }

        $this->command->info('Region table seeded from SQL file!');
    }
}
