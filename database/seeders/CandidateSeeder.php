<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\Skill;
use App\Models\StatusHistory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Candidate::factory(2)
            ->has(Skill::factory(5))
            ->has(StatusHistory::factory(2))
            ->create();
    }
}
