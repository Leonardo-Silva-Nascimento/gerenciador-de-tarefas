<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Task;
use App\Models\Department;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function view()
    {
        
		$funcionarios = Employee::getAllEmployees();
		$departamentos = Department::getAllDepartments();
		$tarefa = Task::getAllTasks();

        $funcionariosCompletos = array();
        $tasksCompletos = array();

        foreach ($funcionarios as $employee) {
            $funcio = new \stdClass();
        
            foreach ($departamentos as $department) {
                if ($department->id == $employee->department_id) {
                    $funcio->departmentName = $department->name;
                    break;
                }
            }
        
            $funcio->completeName = $employee->firstName . ' ' . $employee->lastName;
            $funcio->email = $employee->email;
            $funcio->id = $employee->id;
            $funcio->phone = $employee->phone;
        
            $funcionariosCompletos[] = $funcio;
        }

        foreach ($tarefa as $task) {
            $infoTask = new \stdClass();
        
            foreach ($funcionarios as $employee) {
                if ($task->assignee_id == $employee->id) {
                    $infoTask->assignee_id = $employee->firstName . ' ' . $employee->lastName;
                    break;
                }
            }
        
            $infoTask->title = $task->title;
            $infoTask->description = $task->description;
            $infoTask->due_date = $task->due_date;
            $infoTask->created_at = $task->created_at;
            $infoTask->id = $task->id;
        
            $tasksCompletos[] = $infoTask;
        }

        // Passando os dados para a view e retornando a view        
        return view('home', [
            'funcionarios' => $funcionariosCompletos,
            'departamentos' => $departamentos,
            'tarefa' => $tasksCompletos,
        ]);
    }
}
