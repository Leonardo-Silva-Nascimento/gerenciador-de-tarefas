<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use PhpParser\JsonDecoder;

class DepartmentManager extends Controller
{

    public function create(Request $request)
    {

        if ($request->ajax()) {

            $data = $request->all();
            Department::create($data);
            return response()->json(['message' => 'Departamento adicionado com sucesso']);
        }

        $data = $request->all();
        Department::create($data['data']);
    }

    public function getAllDepartments(Request $request)
    {

        $departments = Department::getAllDepartments();
        return json_encode($departments);
    }

    public function getDepartmentById(Request $request)
    {

        if ($request->ajax()) {

            $data = $request->all();

            return response()->json(Department::getDepartmentById($data['id']));
        }

        $data = $request->all();
        if (is_numeric($data['id']))
            $departments = Department::getDepartmentById($data['id']);
        else
            return print_r('[VERIFIQUE OS PARAMETROS ENVIADOS]');

        return json_encode($departments);
    }

    public function updateDepartment(Request $request)
    {


		if ($request->ajax()) {
	
			$data = $request->all();     
			Department::updateDepartment($data['id'], $data['data']);
            return response()->json(['message' => 'Tarefa atualizada com sucesso']);

		}

        $data = $request->all();

        if (is_numeric($data['id'] && isset($data['data'])))
            Department::updateDepartment($data['id'], $data['data']);
        else
            return print_r('[VERIFIQUE OS PARAMETROS ENVIADOS]');
    }

    public function deleteDepartment(Request $request)
    {

        if ($request->ajax()) {
	
			$data = $request->all();     
            Department::deleteDepartment($data['id']);
            return response()->json(['message' => 'Tarefa excluida com sucesso']);

		}

        $data = $request->all();

        if (is_numeric($data['id']))
            Department::deleteDepartment($data['id']);
        else
            return print_r('[VERIFIQUE OS PARAMETROS ENVIADOS]');
    }

    public function deleteSelectDepartments(Request $request)
    {
        $data = $request->all();
        foreach ($data['ids'] as $id)
            Department::deleteDepartment($id);
    }
}
