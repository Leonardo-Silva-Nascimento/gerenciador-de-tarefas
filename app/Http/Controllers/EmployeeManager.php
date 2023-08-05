<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeManager extends Controller
{

	public function create(Request $request)
	{

		if ($request->ajax()) {
	
			$data = $request->all();
			Employee::createEmployee($data);
			return response()->json(['message' => 'Criado com sucesso']);
		}

        $data = $request->all();
		Employee::createEmployee($data['data']);
	}

	public function getAllEmployees(Request $request)
	{
		$employee = Employee::getAllEmployees();
		return json_encode($employee);
	}

	public function getEmployeeById(Request $request)
	{

		if ($request->ajax()) {

            $data = $request->all();

            return response()->json(Employee::getEmployeeById($data['id']));
        }

        $data = $request->all();
        if (is_numeric($data['id']))
			$employee = Employee::getEmployeeById($data['id']);
		else
            return print_r('[VERIFIQUE OS PARAMETROS ENVIADOS]');

		return json_encode($employee);
	}

	public function updateEmployee(Request $request)
	{

		if ($request->ajax()) {
	
			$data = $request->all();     
			Employee::updateEmployee($data['id'], $data['data']);
            return response()->json(['message' => 'Tarefa atualizada com sucesso']);

		}

        $data = $request->all();

        if (is_numeric($data['id'] && isset($data['data'])))
			Employee::updateEmployee($data['id'],$data['data']);
		else
            return print_r('[VERIFIQUE OS PARAMETROS ENVIADOS]');
	}

	public function deleteEmployee(Request $request)
	{

		if ($request->ajax()) {
	
			$data = $request->all();     
			Employee::deleteEmployee($data['id']);
            return response()->json(['message' => 'Tarefa excluida com sucesso']);

		}

        $data = $request->all();
        if (is_numeric($data['id']))
			Employee::deleteEmployee($data['id']);
		else
            return print_r('[VERIFIQUE OS PARAMETROS ENVIADOS]');
	}

	public function deleteSelectEmployees(Request $request)
	{
        $data = $request->all();
		foreach($data['ids'] as $id)
			Employee::deleteEmployee($id);
	}
}
