$(document).ready(function () {
    if ($('#datatable-funcionario').length) {
        $('#datatable-funcionario').DataTable();
    }

    if ($('#datatable-departamento').length) {
        $('#datatable-departamento').DataTable();
    }

    if ($('#datatable-tarefa').length) {
        $('#datatable-tarefa').DataTable();
    }
    $('.nav-tabs a').on('click', function (event) {
        $(this).tab('show');
    });

    $('button[data-target]').on('click', function (event) {
        var target = $(this).data('target');
        $(target).modal('show');
    });

    // Inicializar os modais
    $('#modalFuncionario').modal({
        show: false
    });

    $('#modalDepartamento').modal({
        show: false
    });

    $('#modalTarefa').modal({
        show: false
    });


    $('#save-employee').on('click', function (event) {
        event.preventDefault();

        if (!verifyEmployeeDates())
            return;

        var requestData = {
            firstName: $('#name').val(),
            lastName: $('#secondName').val(),
            email: $('#email').val(),
            phone: $('#phone').val(),
            department_id: $('#departmentSelect').val(),
        };

        var csrfToken = $('#token').val();

        $.ajax({
            type: 'POST',
            url: 'controler/EmployeeManager/create',
            data: requestData,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function (response) {
                alert('Funcionario criado com sucesso!');
                location.reload();
            },
            error: function (error) {
                alert('Erro ao criar funcionario!');
            }
        });
    });

    $('#save-department').on('click', function (event) {
        event.preventDefault();

        if (!verifyDepartmentDates())
            return;

        var requestData = {
            name: $('#departmentName').val(),
        };

        var csrfToken = $('#token').val();

        $.ajax({
            type: 'POST',
            url: 'controler/DepartmentManager/create',
            data: requestData,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function (response) {
                alert('Departamento criado com sucesso!');
                location.reload();
            },
            error: function (error) {
                alert('Erro ao criar departamento!');
            }
        });
    });

    $('#save-task').on('click', function (event) {
        event.preventDefault();

        if (!verifyTaskDates())
            return;

        var requestData = {
            title: $('#taskName').val(),
            description: $('#taskDescription').val(),
            assignee_id: $('#employeeSelect').val(),
            due_date: $('#taskDueDate').val(),
        };

        var csrfToken = $('#token').val();

        $.ajax({
            type: 'POST',
            url: 'controler/TaskManager/create',
            data: requestData,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function (response) {
                alert('Tarefa criada com sucesso!');
                location.reload();
            },
            error: function (error) {
                alert('Erro ao criar tarefa!');
            }
        });
    });

    $('#edit-saveEmployee').on('click', function (event) {
        event.preventDefault();

        if (!verifyEditEmployeeDates())
            return;

        var id = $(this).data("valueid");

        var requestData = {
            id: id,
            data: {
                firstName: $('#edit-name').val(),
                lastName: $('#edit-secondName').val(),
                email: $('#edit-email').val(),
                phone: $('#edit-phone').val(),
                department_id: $('#edit-departmentSelect').val(),
            }
        };

        var csrfToken = $('#token').val();

        $.ajax({
            type: 'POST',
            url: 'controler/EmployeeManager/updateEmployee',
            data: requestData,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function (response) {
                alert('Atualizado com sucesso!');
                location.reload();
            },
            error: function (error) {
                alert('Ocorreu algum erro tente novamente!');
            }
        });
    });

    $('#edit-saveDepartment').on('click', function (event) {
        event.preventDefault();

        if (!verifyEditDepartmentDates())
            return;

        var id = $(this).data("valueid");

        var requestData = {
            id: id,
            data: {
                name: $('#edit-departmentName').val(),
            }
        };

        var csrfToken = $('#token').val();

        $.ajax({
            type: 'POST',
            url: 'controler/DepartmentManager/updateDepartment',
            data: requestData,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function (response) {
                alert('Atualizado com sucesso!');
                location.reload();
            },
            error: function (error) {
                alert('Ocorreu algum erro tente novamente!');
            }
        });
    });

    $('#edit-saveTask').on('click', function (event) {
        event.preventDefault();

        if (!verifyEditTaskDates())
            return;

        var id = $(this).data("valueid");

        var requestData = {
            id: id,
            data: {
                title: $('#edit-taskName').val(),
                description: $('#edit-taskDescription').val(),
                assignee_id: $('#edit-employeeSelect').val(),
                due_date: $('#edit-taskDueDate').val()
            }
        };

        var csrfToken = $('#token').val();

        $.ajax({
            type: 'POST',
            url: 'controler/TaskManager/updateTask',
            data: requestData,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function (response) {
                alert('Atualizado com sucesso!');
                location.reload();
            },
            error: function (error) {
                alert('Ocorreu algum erro tente novamente!');
            }
        });
    });

    function verifyEditTaskDates() {

        if ($('#edit-taskName').val() == '') {
            $('#edit-taskName').addClass("is-invalid");
            return false
        }
        else {
            $('#edit-taskName').removeClass("is-invalid");
        }

        if ($('#edit-taskDescription').val() == '') {
            $('#edit-taskDescription').addClass("is-invalid");
            return false
        }
        else {
            $('#edit-taskDescription').removeClass("is-invalid");
        }

        if ($('#edit-employeeSelect').val() == '') {
            $('#edit-employeeSelect').addClass("is-invalid");
            return false
        }
        else {
            $('#edit-employeeSelect').removeClass("is-invalid");
        }

        if ($('#edit-taskDueDate').val() == '') {
            $('#edit-taskDueDate').addClass("is-invalid");
            return false
        }
        return true

    }

    function verifyTaskDates() {

        if ($('#taskName').val() == '') {
            $('#taskName').addClass("is-invalid");
            return false
        }
        else {
            $('#taskName').removeClass("is-invalid");
        }

        if ($('#taskDescription').val() == '') {
            $('#taskDescription').addClass("is-invalid");
            return false
        }
        else {
            $('#taskDescription').removeClass("is-invalid");
        }

        if ($('#employeeSelect').val() == '') {
            $('#employeeSelect').addClass("is-invalid");
            return false
        }
        else {
            $('#employeeSelect').removeClass("is-invalid");
        }

        return true

    }

    function verifyEditDepartmentDates() {

        if ($('#edit-departmentName').val() == '') {
            $('#edit-departmentName').addClass("is-invalid");
            return false
        }
        else {
            $('#edit-departmentName').removeClass("is-invalid");
        }

        return true
    }

    function verifyDepartmentDates() {

        if ($('#departmentName').val() == '') {
            $('#departmentName').addClass("is-invalid");
            return false
        }
        else {
            $('#departmentName').removeClass("is-invalid");
        }

        return true
    }

    function verifyEditEmployeeDates() {

        if ($('#edit-name').val() == '') {
            $('#edit-name').addClass("is-invalid");
            return false
        }
        else {
            $('#edit-name').removeClass("is-invalid");
        }

        if ($('#edit-secondName').val() == '') {
            $('#edit-secondName').addClass("is-invalid");
            return false
        }
        else {
            $('#edit-secondName').removeClass("is-invalid");
        }

        if ($('#edit-email').val() == '') {
            $('#edit-email').addClass("is-invalid");
            return false
        }
        else {
            $('#edit-email').removeClass("is-invalid");
        }

        if ($('#edit-phone').val() == '') {
            $('#edit-phone').addClass("is-invalid");
            return false
        }
        else {
            $('#edit-phone').removeClass("is-invalid");
        }

        if ($('#edit-departmentSelect').val() == '') {
            $('#edit-departmentSelect').addClass("is-invalid");
            return false
        }
        else {
            $('#edit-departmentSelect').removeClass("is-invalid");
        }
        return true
    }

    function verifyEmployeeDates() {

        if ($('#name').val() == '') {
            $('#name').addClass("is-invalid");
            return false
        }
        else {
            $('#name').removeClass("is-invalid");
        }

        if ($('#secondName').val() == '') {
            $('#secondName').addClass("is-invalid");
            return false
        }
        else {
            $('#secondName').removeClass("is-invalid");
        }

        if ($('#email').val() == '') {
            $('#email').addClass("is-invalid");
            return false
        }
        else {
            $('#email').removeClass("is-invalid");
        }

        if ($('#phone').val() == '') {
            $('#phone').addClass("is-invalid");
            return false
        }
        else {
            $('#phone').removeClass("is-invalid");
        }

        if ($('#departmentSelect').val() == '') {
            $('#departmentSelect').addClass("is-invalid");
            return false
        }
        else {
            $('#departmentSelect').removeClass("is-invalid");
        }
        return true
    }

    $('.edit-employee').on('click', function (event) {
        event.preventDefault();


        var requestData = {
            id: $(this).data("valueid")
        };

        var csrfToken = $('#token').val();

        $.ajax({
            type: 'POST',
            url: 'controler/EmployeeManager/getEmployeeById',
            data: requestData,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function (response) {
                $('#edit-name').val(response.firstName),
                    $('#edit-secondName').val(response.lastName),
                    $('#edit-email').val(response.email),
                    $('#edit-phone').val(response.phone),
                    $('#edit-departmentSelect').val(response.department_id)
                    $("#edit-saveEmployee").data("valueid", response.id);
                },
            error: function (error) {
                alert('Ocorreu algum erro tente novamente!');
            }
        });
    });

    $('.edit-department').on('click', function (event) {
        event.preventDefault();

        var csrfToken = $('#token').val();
        var requestData = {
            id: $(this).data("valueid")
        };

        $.ajax({
            type: 'POST',
            url: 'controler/DepartmentManager/getDepartmentById',
            data: requestData,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function (response) {
                $('#edit-departmentName').val(response.name);
                $("#edit-saveDepartment").data("valueid", response.id);
            },
            error: function (error) {
                alert('Ocorreu algum erro tente novamente!');
            }
        });
    });

    $('.edit-task').on('click', function (event) {
        event.preventDefault();

        var csrfToken = $('#token').val();
        var requestData = {
            id: $(this).data("valueid")
        };

        $.ajax({
            type: 'POST',
            url: 'controler/TaskManager/getTaskById',
            data: requestData,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function (response) {
                $('#edit-taskName').val(response.title),
                    $('#edit-taskDescription').val(response.description),
                    $('#edit-employeeSelect').val(response.assignee_id),
                    $('#edit-taskDueDate').val(response.due_date)
                    $("#edit-saveTask").data("valueid", response.id);
            },
            error: function (error) {
                alert('Ocorreu algum erro tente novamente!');
            }
        });
    });

    $('.delete-employee').on('click', function (event) {
        event.preventDefault();


        var requestData = {
            id: $(this).data("valueid")
        };

        var csrfToken = $('#token').val();

        $.ajax({
            type: 'POST',
            url: 'controler/EmployeeManager/deleteEmployee',
            data: requestData,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function (response) {
                alert('Deletado com sucesso!');
                location.reload();
            },
            error: function (error) {
                alert('Ocorreu algum erro tente novamente!');
            }
        });
    });

    $('.delete-department').on('click', function (event) {
        event.preventDefault();

        var csrfToken = $('#token').val();
        var requestData = {
            id: $(this).data("valueid")
        };

        $.ajax({
            type: 'POST',
            url: 'controler/DepartmentManager/deleteDepartment',
            data: requestData,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function (response) {
                alert('Deletado com sucesso!');
                location.reload();
            },
            error: function (error) {
                alert('Ocorreu algum erro tente novamente!');
            }
        });
    });

    $('.delete-task').on('click', function (event) {
        event.preventDefault();

        var csrfToken = $('#token').val();
        var requestData = {
            id: $(this).data("valueid")
        };

        $.ajax({
            type: 'POST',
            url: 'controler/TaskManager/deleteTaskById',
            data: requestData,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function (response) {
                alert('Deletado com sucesso!');
                location.reload();
            },
            error: function (error) {
                alert('Ocorreu algum erro tente novamente!');
            }
        });
    });

});
