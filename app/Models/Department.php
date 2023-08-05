<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    // Create a new department
    public static function createDepartment($data)
    {
        return self::create($data);
    }

    // Get all departments
    public static function getAllDepartments()
    {
        return self::all();
    }

    // Get a specific department by ID
    public static function getDepartmentById($id)
    {
        return self::find($id);
    }

    // Update a department
    public static function updateDepartment($id, $data)
    {
        $department = self::find($id);
        if ($department) {
            $department->update($data);
            return $department;
        }
        return null;
    }

    // Delete a department
    public static function deleteDepartment($id)
    {
        $department = self::find($id);
        if ($department) {
            $department->delete();
            return true;
        }
        return false;
    }
}
