<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'title'       => $this->faker->sentence(4),
            'description' => $this->faker->optional()->paragraph(),
            'status'      => $this->faker->randomElement(Task::STATUSES),
        ];
    }

    public function pending(): static    { return $this->state(['status' => 'pending']); }
    public function inProgress(): static { return $this->state(['status' => 'in_progress']); }
    public function done(): static       { return $this->state(['status' => 'done']); }
}
