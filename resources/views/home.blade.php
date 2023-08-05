<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- CSS -->
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
	<link rel="stylesheet" href="{{ asset('fonts/bootstrap-icons/bootstrap-icons.min.css') }}">

	<title> Gestão de tarefas</title>


	<style>
		/* Estilo de fundo para a tela */
		body {
			background-color: #f8f9fa;
			/* Cinza claro neutro */
		}

		/* Estilo para os botões */
		.btn-lg {
			padding: 20px 40px;
			/* Tamanho maior */
			font-size: 20px;
			/* Tamanho da fonte maior */
		}

		/* Estilo para a div dos botões */
		.button-container {
			display: flex;
			justify-content: center;
			/* Centralizar horizontalmente */
			margin-top: 50px;
			/* Margem acima dos botões */
		}

		/* Margem entre os botões */
		.btn:not(:first-child) {
			margin-left: 20px;
		}
	</style>
</head>

<body>
<input type="hidden" id="token" value="{{ csrf_token() }}">
	<div class="container text-center">
		<div>
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="funcionario-tab" data-toggle="tab" href="#funcionario" role="tab" aria-controls="funcionario" aria-selected="true">Funcionarios</a>
					<button type="button" class="btn btn-sm btn-primary ml-2" data-target="#modalFuncionario">
						<i class="bi bi-plus"></i> Adicionar Funcionário
					</button>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="departamento-tab" data-toggle="tab" href="#departamento" role="tab" aria-controls="departamento" aria-selected="false">Departamentos</a>
					<button type="button" class="btn btn-sm btn-primary ml-2" data-target="#modalDepartamento">
						<i class="bi bi-plus"></i> Adicionar Departamento
					</button>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="tarefa-tab" data-toggle="tab" href="#tarefa" role="tab" aria-controls="tarefa" aria-selected="false">Tarefas</a>
					<button type="button" class="btn btn-sm btn-primary ml-2" data-target="#modalTarefa">
						<i class="bi bi-plus"></i> Adicionar Tarefa
					</button>
				</li>
			</ul>
		</div>
		<div class="tab-content mt-4" id="myTabContent">
			<div class="tab-pane fade show active" id="funcionario" role="tabpanel" aria-labelledby="funcionario-tab">
				<div>
					<table id="datatable-funcionario" class="display" style="width:100%">
						<thead>
							<tr>
								<th>Nome</th>
								<th>Email</th>
								<th>Telefone</th>
								<th>Nome do departamento</th>
								<th>Ações</th>
							</tr>
						</thead>
						<tbody>
							@foreach($funcionarios as $employee)
							<tr>
								<td class="td-employee">{{ $employee->completeName }}</td>
								<td>{{ $employee->email }}</td>
								<td>{{ $employee->phone }}</td>
								<td>{{ $employee->departmentName }}</td>
								<td>
									<div class="btn-group" role="group" aria-label="Ações">
										<button data-valueId="{{ $employee->id }}" type="button" class="btn btn-sm btn-danger delete-employee">
											<i class="bi bi-trash"></i>
										</button>

										<button data-valueId="{{ $employee->id }}" type="button" class="btn btn-sm btn-primary edit-employee" data-target="#edit-modalFuncionario">
											<i class="bi bi-pencil"></i>
										</button>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<div class="tab-pane fade" id="departamento" role="tabpanel" aria-labelledby="departamento-tab">
				<table id="datatable-departamento" class="display" style="width:100%">
					<thead>
						<tr>
							<th>Nome</th>
							<th>Ações</th>
						</tr>
					</thead>
					<tbody>
						@foreach($departamentos as $department)
						<tr>
							<td class="td-department">{{ $department['name'] }}</td>
							<td>
								<div class="btn-group" role="group" aria-label="Ações">
									<button data-valueId="{{ $department->id }}" type="button" class="btn btn-sm btn-danger delete-department">
										<i class="bi bi-trash"></i>
									</button>

									<button data-valueId="{{ $department->id }}" type="button" class="btn btn-sm btn-primary edit-department" data-target="#edit-modalDepartamento">
										<i class="bi bi-pencil"></i>
									</button>
								</div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="tab-pane fade" id="tarefa" role="tabpanel" aria-labelledby="tarefa-tab">
				<table id="datatable-tarefa" class="display" style="width:100%">
					<thead>
						<tr>
							<th>Titulo</th>
							<th>Descrição</th>
							<th>Funcionario</th>
							<th>Prazo</th>
							<th>Criado</th>
							<th>Ações</th>
						</tr>
					</thead>
					<tbody>
						@foreach($tarefa as $task)
						<tr>
							<td class="td-task">{{ $task->title }}</td>
							<td>{{ $task->description }}</td>
							<td>{{ $task->assignee_id }}</td>
							<td>{{ $task->due_date }}</td>
							<td>{{ $task->created_at }}</td>
							<td>
								<div class="btn-group" role="group" aria-label="Ações">
									<button data-valueId="{{ $task->id }}" type="button" class="btn btn-sm btn-danger delete-task">
										<i class="bi bi-trash"></i>
									</button>

									<button data-valueId="{{ $task->id }}" type="button" class="btn btn-sm btn-primary edit-task" data-target="#edit-modalTarefa">
										<i class="bi bi-pencil"></i>
									</button>
								</div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- Modais -->
	<!-- Modal Funcionário -->
	<div class="modal" id="modalFuncionario" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Adicionar Funcionário</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form id="employeeForm">
						<div class="mb-3">
							<label for="name" class="form-label">Nome do funcionário</label>
							<input type="text" class="form-control" id="name" required>
						</div>
						<div class="mb-3">
							<label for="secondName" class="form-label">Sobrenome do funcionário</label>
							<input type="text" class="form-control" id="secondName" required>
						</div>

						<div class="mb-3">
							<label for="email" class="form-label">Email do funcionário</label>
							<input type="email" class="form-control" id="email" required>
						</div>

						<div class="mb-3">
							<label for="phone" class="form-label">Número do funcionário</label>
							<input type="tel" class="form-control" id="phone" required>
						</div>

						<div class="mb-3">
							<label for="departmentSelect" class="form-label">Departamento do funcionário</label>
							<select class="form-select" id="departmentSelect" required>
								<option value="" disabled selected>Selecione o departamento</option>
								@foreach($departamentos as $department)
								<option value="{{ $department['id'] }}">{{ $department['name'] }}</option>
								@endforeach
							</select>
						</div>
					</form>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
					<button type="button" class="btn btn-primary" id='save-employee'>Salvar</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Departamento -->
	<div class="modal" id="modalDepartamento" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Adicionar Departamento</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form>
						<div class="mb-3">
							<label for="departmentName" class="form-label">Nome do departamento</label>
							<input type="text" class="form-control" id="departmentName" required>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
					<button type="submit" form="addDepartmentForm" id="save-department" class="btn btn-primary">Salvar</button>
				</div>
			</div>

		</div>
	</div>

	<!-- Modal Tarefa -->
	<div class="modal" id="modalTarefa" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Adicionar Tarefa</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form>
						<div class="mb-3">
							<label for="taskName" class="form-label">Nome da tarefa</label>
							<input type="text" class="form-control" id="taskName" required>
						</div>

						<div class="mb-3">
							<label for="taskDescription" class="form-label">Descrição da tarefa</label>
							<input type="text" class="form-control" id="taskDescription" required>
						</div>

						<div class="mb-3">
							<label for="employeeSelect" class="form-label">Funcionário responsável</label>
							<select class="form-select" id="employeeSelect" required>
								<option value="" disabled selected>Selecione o funcionário</option>
								@foreach($funcionarios as $employee)
								<option value="{{ $employee->id }}">{{ $employee->completeName }}</option>
								@endforeach
							</select>
						</div>

						<div class="mb-3">
							<label for="taskDueDate" class="form-label">Data de entrega</label>
							<input type="date" class="form-control" id="taskDueDate" name="taskDueDate" requiredvalue="{{ old('taskDueDate') }}">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
					<button type="submit" form="addTaskForm" id='save-task' class="btn btn-primary">Salvar</button>
				</div>
			</div>
		</div>
	</div>


	<!-- Modal Editar Funcionário -->
	<div class="modal" id="edit-modalFuncionario" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Editar Funcionário</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form>
						<div class="mb-3">
							<label for="edit-name" class="form-label">Nome do funcionário</label>
							<input type="text" class="form-control" id="edit-name" required>
						</div>
						<div class="mb-3">
							<label for="edit-secondName" class="form-label">Nome do funcionário</label>
							<input type="text" class="form-control" id="edit-secondName" required>
						</div>

						<div class="mb-3">
							<label for="edit-email" class="form-label">Email do funcionário</label>
							<input type="email" class="form-control" id="edit-email" required>
						</div>

						<div class="mb-3">
							<label for="edit-phone" class="form-label">Número do funcionário</label>
							<input type="tel" class="form-control" id="edit-phone" required>
						</div>

						<div class="mb-3">
							<label for="edit-departmentSelect" class="form-label">Departamento do funcionário</label>
							<select class="form-select" id="edit-departmentSelect" required>
								<option value="" disabled selected>Selecione o departamento</option>
								@foreach($departamentos as $department)
								<option value="{{ $department['id'] }}">{{ $department['name'] }}</option>
								@endforeach
							</select>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
					<button type="button" id="edit-saveEmployee" class="btn btn-primary">Salvar</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Editar Departamento -->
	<div class="modal" id="edit-modalDepartamento" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Editar Departamento</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form>
						<div class="mb-3">
							<label for="edit-departmentName" class="form-label">Nome do departamento</label>
							<input type="text" class="form-control" id="edit-departmentName" required>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
					<button type="button" id="edit-saveDepartment" class="btn btn-primary">Salvar</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Editar Tarefa -->
	<div class="modal" id="edit-modalTarefa" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Editar Tarefa</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form>
						<div class="mb-3">
							<label for="edit-taskName" class="form-label">Nome da tarefa</label>
							<input type="text" class="form-control" id="edit-taskName" required>
						</div>

						<div class="mb-3">
							<label for="edit-taskDescription" class="form-label">Descrição da tarefa</label>
							<input type="text" class="form-control" id="edit-taskDescription" required>
						</div>

						<div class="mb-3">
							<label for="edit-employeeSelect" class="form-label">Funcionário responsável</label>
							<select class="form-select" id="edit-employeeSelect" required>
								<option value="" disabled selected>Selecione o funcionário</option>
								@foreach($funcionarios as $employee)
								<option value="{{ $employee->id }}">{{ $employee->completeName }}</option>
								@endforeach
							</select>
						</div>

						<div class="mb-3">
							<label for="edit-taskDueDate" class="form-label">Data de entrega</label>
							<input type="date" class="form-control" id="edit-taskDueDate" name="taskDueDate" requiredvalue="{{ old('taskDueDate') }}">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
					<button type="button" id="edit-saveTask" class="btn btn-primary">Salvar</button>
				</div>
			</div>
		</div>
	</div>


	<!-- JS -->
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('Js/home.js') }}"></script>

</body>

</html>