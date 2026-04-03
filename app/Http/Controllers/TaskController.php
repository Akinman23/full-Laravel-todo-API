<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => Task::latest()->get(),
        ]);
    }

    public function store(StoreTaskRequest $request): JsonResponse
    {
        $task = Task::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Task created successfully.',
            'data'    => $task,
        ], 201);
    }

    public function show(Task $task): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => $task,
        ]);
    }

    public function update(UpdateTaskRequest $request, Task $task): JsonResponse
    {
        $task->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Task updated successfully.',
            'data'    => $task->fresh(),
        ]);
    }

    public function destroy(Task $task): JsonResponse
    {
        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully.',
        ]);
    }
}
