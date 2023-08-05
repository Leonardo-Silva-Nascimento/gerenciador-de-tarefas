<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'assignee_id', 'due_date'];

    public function assignee()
    {
        return $this->belongsTo(Employee::class, 'assignee_id');
    }

    // Create a new task
    public static function createTask($data)
    {
        return self::create($data);
    }

    // Get all tasks
    public static function getAllTasks()
    {
        return self::all();
    }

    // Get a specific task by ID
    public static function getTaskById($id)
    {
        return self::find($id);
    }

    // Update a task
    public static function updateTask($id, $data)
    {
        $task = self::find($id);
        if ($task) {
            $task->update($data);
            return $task;
        }
        return null;
    }

    // Delete a task
    public static function deleteTask($id)
    {
        $task = self::find($id);
        if ($task) {
            $task->delete();
            return true;
        }
        return false;
    }
}
