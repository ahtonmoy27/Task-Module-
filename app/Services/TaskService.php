<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskService
{
    public function storeMultiple(array $tasks)
    {
        DB::beginTransaction();
        try {
            foreach ($tasks as $task) {
                Task::create([
                    'title' => $task['title'],
                    'description' => $task['description'] ?? null,
                ]);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getAll()
    {
        return Task::latest()->get();
    }
}
