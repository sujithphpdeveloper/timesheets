<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get All Users
        $users = User::all();

        // Get all Projects
        $projects = Project::all();

        foreach ($projects as $project) {
            $randomUser = $users->random(rand(1,5))->pluck('id');
            $project->users()->attach($randomUser);
        }
    }
}
