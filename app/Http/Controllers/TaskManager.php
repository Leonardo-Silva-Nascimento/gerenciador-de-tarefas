<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskManager extends Controller
{

    public function create(Request $request)
    {

        if ($request->ajax()) {

            $data = $request->all();
            Task::create($data);
            return response()->json(['message' => 'Tarefa adicionado com sucesso']);
        }

        $data = $request->all();

        Task::create($data['data']);
    }

    public function getAllTasks(Request $request)
    {
        $tasks = Task::getAllTasks();
        return json_encode($tasks);
    }

    public function getTaskById(Request $request)
    {

        if ($request->ajax()) {

            $data = $request->all();

            return response()->json(Task::getTaskById($data['id']));
        }

        $data = $request->all();

        if (is_numeric($data['id']))
            $task = Task::getTaskById($data['id']);
        else
            return print_r('[VERIFIQUE OS PARAMETROS ENVIADOS]');

        return json_encode($task);
    }

    public function updateTask(Request $request)
    {


        if ($request->ajax()) {

            $data = $request->all();
            Task::updateTask($data['id'], $data['data']);
            return response()->json(['message' => 'Tarefa atualizada com sucesso']);
        }


        $data = $request->all();

        if (is_numeric($data['id'] && isset($data['data'])))
            Task::updateTask($data['id'], $data['data']);
        else
            return print_r('[VERIFIQUE OS PARAMETROS ENVIADOS]');
    }

    public function deleteTaskById(Request $request)
    {

        if ($request->ajax()) {
	
			$data = $request->all();     
            Task::deleteTask($data['id']);
            return response()->json(['message' => 'Tarefa excluida com sucesso']);

		}

        $data = $request->all();

        if (is_numeric($data['id']))
            Task::deleteTask($data['id']);
        else
            return print_r('[VERIFIQUE OS PARAMETROS ENVIADOS]');
    }

    public function deleteSelectTasks(Request $request)
    {
        $data = $request->all();
        foreach ($data['id'] as $id)
            Task::deleteTask($id);
    }
}
