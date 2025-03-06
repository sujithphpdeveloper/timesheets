<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Timesheet>
 */
class TimesheetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $project = Project::has('users')->inRandomOrder()->first();

        if (!$project) {
            return []; // No valid project found, return an empty array (prevents errors)
        }

        $user = $project->users()->inRandomOrder()->first();

        return [
            'user_id' => $user->id,
            'project_id' => $project->id,
            'task_name' => fake()->sentence(4),
            'date' => fake()->dateTimeThisYear('now'),
            'hours' => fake()->numberBetween(1,24),
        ];
    }
}
