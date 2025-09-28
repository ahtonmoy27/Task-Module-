<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        // Just return the view
        $tasks = $this->taskService->getAll();

        return view('task', compact('tasks'));
    }

    public function getTasks()
    {
        $tasks = $this->taskService->getAll(); // Fetch all tasks from DB
        return response()->json([
            'status' => true,
            'data' => $tasks
        ]);
    }

    public function store(TaskRequest $request): JsonResponse
    {
        try {
            $this->taskService->storeMultiple($request->validated()['tasks']);
            $tasks = $this->taskService->getAll();
            return response()->json([
                'status' => true,
                'data' => $tasks,
                'message' => 'Tasks saved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error saving tasks',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function update(\Illuminate\Http\Request $request, $id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->title = $request->input('title');
            $task->description = $request->input('description');
            $task->save();
            return response()->json([
                'status' => true,
                'message' => 'Task updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error updating task',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function destroy($id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->delete();
            return response()->json([
                'status' => true,
                'message' => 'Task deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error deleting task',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
