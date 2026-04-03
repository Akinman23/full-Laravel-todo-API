<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $tasks = [
            ['title' => 'Set up project repository',   'description' => 'Initialize Git repo and push to GitHub.',          'status' => 'done'],
            ['title' => 'Design database schema',       'description' => 'Define tables and relationships.',                  'status' => 'done'],
            ['title' => 'Implement REST API',           'description' => 'Build CRUD endpoints for task management.',         'status' => 'in_progress'],
            ['title' => 'Write feature tests',          'description' => 'Cover all API endpoints with PHPUnit.',             'status' => 'pending'],
            ['title' => 'Deploy to production',         'description' => 'Configure Railway and run migrations.',             'status' => 'pending'],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
