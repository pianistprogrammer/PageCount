<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\PageViewLog;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class PageViewLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startDate = Carbon::now()->subMonths(6);

        for ($i = 0; $i < 180; $i++) {
            $date = $startDate->addDay();
            $count = rand(0, 1000);

            PageViewLog::create([
                'ulid' => Str::uuid(),
                'url' => 'https://example.com',
                'views_count' => $count,
                'created_at' => $date,
                'updated_at' => $date,
                'user_id' => rand(1, 10) > 5 ? rand(1, 10) : null,
            ]);
        }
    }
}
