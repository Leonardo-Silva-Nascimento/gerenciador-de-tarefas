<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
    {
        protected $fillable = ['firstName', 'lastName', 'email', 'phone', 'department_id'];
    
        public function department()
        {
            return $this->belongsTo(Department::class);
        }
    
        // Create a new employee
        public static function createEmployee($data)
        {
            return self::create($data);
        }
    
        // Get all employees
        public static function getAllEmployees()
        {
            return self::all();
        }
    
        // Get a specific employee by ID
        public static function getEmployeeById($id)
        {
            return self::find($id);
        }
    
        // Update an employee
        public static function updateEmployee($id, $data)
        {
            $employee = self::find($id);
            if ($employee) {
                $employee->update($data);
                return $employee;
            }
            return null;
        }
    
        // Delete an employee
        public static function deleteEmployee($id)
        {
            $employee = self::find($id);
            if ($employee) {
                $employee->delete();
                return true;
            }
            return false;
        }
}

