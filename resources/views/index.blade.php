<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task Management</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <style>
        .alert {
            width: 81%;
        }
    </style>
    <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
</head>

<body>

    <button type="button" class="btn btn-primary" style="margin-left: 82%; width: 152px; height:43px; margin-top: 20px;"
        data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
    <h1 style="text-align: center; margin-top: 20px;">Show Task</h1>

    <table class="table table-striped table-hover" style="margin-left: 30px; margin-top: 40px;" id="mytable">
        <tr>
            <form class="d-flex" id="searchform">
                <td><input class="form-control me-2" id="searchdata" type="search" name="searchdata"
                        placeholder="Search" aria-label="Search"></td>
                <td><button class="btn btn-outline-success" type="submit">Search</button></td>
            </form>
            <form id="refreshform">
                <td><button class="btn btn-outline-success" type="submit">Show</button></td>
            </form>

            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Title</td>
            <td>Description</td>
            <td>Status</td>
            <td>Priority</td>
            <td>Due Date</td>
            <td>Action</td>
        </tr>
    </table>

    {{-- add button model--}}
    <button type="button" class="btn btn-primary" style="margin-left: 50px" data-bs-toggle="modal"
        data-bs-target="#addModal">Add</button>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Task</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="deleteform">
                    @csrf
                    <div class="modal-body">
                        Conform delete this record or not <input type="text" name="getdata" readonly id="getdeletedata">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">DELETE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="updateModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Task</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form class="container-md m-5" style="width: 31%" id="modifyform">
                    @csrf
                    <h1>Update Task</h1>
                    <div class="mb-3">
                        <input type="text" name="id" id="mid" hidden>
                        <label for="exampleInputEmail1" class="form-label">Task Title</label>
                        <input type="text" name="title" style="width: 277%" id="mtitle" class="form-control"
                            value="{{old('title')}}">
                        <div class="alert alert-danger" id="emtitle" style="width: 277%" hidden></div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Task Description</label>
                        <input type="text" name="description" id="mdescription" style="width: 277%" class="form-control"
                            value="{{old('description')}}">
                        <div class="alert alert-danger" id="emdescription" style="width: 277%" hidden></div>
                    </div>

                    <div class="mb-3">

                        <label for="exampleInputEmail1" class="form-label">Priority</label>
                        <select name="priority" id="mpriority">
                            <option value="">Select</option>
                            <option value="Very High" {{old('priority') == 'Very High' ? 'selected' : ''}}>
                                Very High</option>
                            <option value="High" {{old('priority') == 'High' ? 'selected' : ''}}>High
                            </option>
                            <option value="Medium" {{old('priority') == 'Medium' ? 'selected' : ''}}>Medium
                            </option>
                            <option value="Low" {{old('priority') == 'Low' ? 'selected' : ''}}>Low</option>
                        </select>
                        <div class="alert alert-danger" id="empriority" style="width: 277%" hidden></div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Due Date</label>
                        <input type="date" name="due_date" id="mdue_date" style="width: 277%" class="form-control"
                            value="{{old('due_date')}}">
                        <div class="alert alert-danger" id="emdue_date" style="width: 277%" hidden></div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Dependency</label>
                        <input type="text" name="dependency" id="mdependency" style="width: 277%" class="form-control"
                            value="{{old('dependency')}}">
                        <div class="alert alert-danger" id="emdependency" style="width: 277%" hidden></div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Subtasks</label>
                        <input type="text" name="subtasks" id="msubtasks" style="width: 277%" class="form-control"
                            value="{{old('subtasks')}}">
                        <div class="alert alert-danger" id="emsubtasks" style="width: 277%" hidden></div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Status Logic</label>
                        <input type="text" name="status" id="mstatus" style="width: 277%" class="form-control"
                            value="{{old('status')}}">
                        <div class="alert alert-danger" id="emstatus" style="width: 277%" hidden></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>

            </div>
        </div>
    </div>

    {{-- Add Model --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Task</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                <form class="container-md m-5" id="addformmodel">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Task Title</label>
                        <input type="text" name="title" class="form-control " style="width: 81%"
                            value="{{old('title')}}" id="title">

                        <div class="alert alert-danger" id="etitle" hidden></div>

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Task Description</label>
                        <input type="text" name="description" style="width: 81%" class="form-control"
                            value="{{old('description')}}" id="description">
                        <div class="alert alert-danger" id="edescription" hidden></div>
                    </div>

                    <div class="mb-3">

                        <label for="exampleInputEmail1" class="form-label">Priority</label>
                        <select name="priority" id="priority">
                            <option value="">Select</option>
                            <option value="Very High" {{old('priority') == 'Very high' ? 'selected' : '' }}>Very High
                            </option>
                            <option value="High" {{old('priority') == 'High' ? 'selected' : '' }}>High</option>
                            <option value="Medium" {{old('priority') == 'Medium' ? 'selected' : '' }}>Medium</option>
                            <option value="Low" {{old('priority') == 'Low' ? 'selected' : '' }}>Low</option>
                        </select>
                        <div class="alert alert-danger" id="epriority" hidden></div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Due Date</label>
                        <input type="date" name="due_date" class="form-control" id="due_date" style="width: 81%"
                            value="{{old('due_date')}}">
                        <div class="alert alert-danger" id="edue_date" hidden></div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Dependency</label>
                        <input type="text" name="dependency" class="form-control" id="dependency" style="width: 81%"
                            value="{{old('dependency')}}">
                        <div class="alert alert-danger" id="edependency" hidden></div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Subtasks</label>
                        <input type="text" name="subtasks" id="subtasks" class="form-control" style="width: 81%"
                            value="{{old('subtasks')}}">
                        <div class="alert alert-danger" id="esubtasks" hidden></div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Status Logic</label>
                        <input type="text" name="status" id="status" class="form-control" style="width: 81%"
                            value="{{old('status')}}">
                        <div class="alert alert-danger" id="estatus" hidden></div>
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submit-btn">Submit</button>

                </form>
            </div>
        </div>
    </div>

    {{-- login model --}}
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">LOGIN USER</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="loginform" style="margin-left: 40px;margin-right:42px;margin-top:25px">
                    @csrf

                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="email" class="form-control" id="email" />
                        <label class="form-label" for="form2Example1">Email address</label>
                    </div>
                    <div class="alert alert-danger" id="lemail" hidden></div>

                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="password" class="form-control" id="password" />
                        <label class="form-label" for="form2Example2">Password</label>
                    </div>
                    <div class="alert alert-danger" id="lpassword" hidden></div>

                    <div class="row mb-4">
                        <div class="col d-flex justify-content-center">

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                                <label class="form-check-label" for="form2Example31"> Remember me </label>
                            </div>
                        </div>

                        <div class="col">
                            <a href="#!">Forgot password?</a>
                        </div>
                    </div>


                    <button type="submit" data-mdb-button-init data-mdb-ripple-init
                        class="btn btn-primary btn-block mb-4" style="width: 100%;">Sign in</button>


                    <div class="text-center">
                        <p>Not a member? <a href="#!">Register</a></p>
                        <p>or sign up with:</p>
                        <button type="button" data-mdb-button-init data-mdb-ripple-init
                            class="btn btn-link btn-floating mx-1">
                            <i class="fab fa-facebook-f"></i>
                        </button>

                        <button type="button" data-mdb-button-init data-mdb-ripple-init
                            class="btn btn-link btn-floating mx-1">
                            <i class="fab fa-google"></i>
                        </button>

                        <button type="button" data-mdb-button-init data-mdb-ripple-init
                            class="btn btn-link btn-floating mx-1">
                            <i class="fab fa-twitter"></i>
                        </button>

                        <button type="button" data-mdb-button-init data-mdb-ripple-init
                            class="btn btn-link btn-floating mx-1">
                            <i class="fab fa-github"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        function deletemodel(title) {
            document.getElementById('getdeletedata').value = title;
            var title_data = title;
        }

        function updatemodel(id, title, description, status, priority, due_date, dependency, subtasks) {
            document.getElementById('mtitle').value = title;
            document.getElementById('mid').value = id;
            document.getElementById('mdescription').value = description;
            document.getElementById('mstatus').value = status;
            document.getElementById('mpriority').value = priority;
            document.getElementById('mdue_date').value = due_date;
            document.getElementById('msubtasks').value = subtasks;
            document.getElementById('mdependency').value = dependency;
        }
    </script>
    <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
    <script>
        $(document).ready(function () {



            $('#addModal').on('shown.bs.modal', function () {
                $("#etitle").attr("hidden", true);
                $("#epriority").attr("hidden", true);
                $("#edescription").attr("hidden", true);
                $("#edependency").attr("hidden", true);
                $("#esubtasks").attr("hidden", true);
                $("#estatus").attr("hidden", true);
                $("#estatus").attr("hidden", true);

            });

            $('#updateModel').on('shown.bs.modal', function () {
                $("#emtitle").attr("hidden", true);
                $("#emdescription").attr("hidden", true);
                $("#empriority").attr("hidden", true);
                $("#emdependency").attr("hidden", true);
                $("#emsubtasks").attr("hidden", true);
                $("#emstatus").attr("hidden", true);
                $("#emstatus").attr("hidden", true);

            });

            $('#deleteModal').on('shown.bs.modal', function () {
                toastr.warning("Delete the Record")

            });

            $('#loginModal').on('shown.bs.modal', function () {
                $("#lemail").attr("hidden", true);
                $("#lpassword").attr("hidden", true);

            });

            $.ajaxSetup({
                headers:
                    { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            // login
            $("#loginform").on("submit", function (e) {
                e.preventDefault();

                $.ajax({
                    type: "post",
                    url: "/login",
                    data: {
                        email: $("#email").val(),
                        password: $("#password").val(),
                    },
                    success: function (res) {
                        if (res.success) {
                            toastr.success('Login user');
                            $("#loginform")[0].reset();
                            $(".btn-close").trigger("click");
                        }
                        else {
                            console.log(res);
                            if (res.user) {
                                toastr.error("User not found");
                                $("#loginform")[0].reset();
                                $(".btn-close").trigger("click");
                            }
                            else {
                                if ($.inArray("The email field is required.", res['email']) !== -1) {
                                    $("#lemail").removeAttr("hidden");
                                    $("#lemail").text(res['email'][0]);
                                }
                                else {
                                    $("#lemail").attr("hidden", true);
                                }

                                if ($.inArray("The password field is required.", res['password']) !== -1) {
                                    $("#lpassword").removeAttr("hidden");
                                    $("#lpassword").text(res['password'][0]);
                                }
                            }

                        }

                    },
                    error: function (e) {
                        console.log(e);

                    }
                });

            });

            // refresh form 
            $("#refreshform").on("submit", function (e) {
                show_table();
            })

            // function of validation error for add data
            function validation_error(res) {

                if ($.inArray("The title field is required.", res['title']) !== -1) {
                    $("#etitle").removeAttr("hidden");
                    $("#etitle").text(res['title'][0]);
                }
                else {
                    if ($.inArray("The title has already been taken.", res['title']) !== -1) {
                        $("#etitle").removeAttr("hidden");
                        $("#etitle").text(res['title'][0]);
                    }
                    else {
                        $("#etitle").attr("hidden", true);
                    }

                }

                if ($.inArray("The description field is required.", res['description']) !== -1) {
                    $("#edescription").removeAttr("hidden");
                    $("#edescription").text(res['description'][0]);
                }
                else {
                    if ($.inArray("The description field must be at least 5 characters.", res['description']) !== -1) {
                        $("#edescription").removeAttr("hidden");
                        $("#edescription").text(res['description'][0]);
                    }
                    else {
                        $("#edescription").attr("hidden", true);
                    }

                }

                if ($.inArray("The priority field is required.", res['priority']) !== -1) {
                    $("#epriority").removeAttr("hidden");
                    $("#epriority").text(res['priority'][0]);
                }
                else {
                    $("#epriority").attr("hidden", true);
                }

                if ($.inArray("The due date field is required.", res['due_date']) !== -1) {
                    $("#edue_date").removeAttr("hidden");
                    $("#edue_date").text(res['due_date'][0]);
                }
                else {
                    $("#edue_date").attr("hidden", true);
                }

                if ($.inArray("The dependency field is required.", res['dependency']) !== -1) {
                    $("#edependency").removeAttr("hidden");
                    $("#edependency").text(res['dependency'][0]);
                }
                else {
                    $("#edependency").attr("hidden", true);
                }

                if ($.inArray("The subtasks field is required.", res['subtasks']) !== -1) {
                    $("#esubtasks").removeAttr("hidden");
                    $("#esubtasks").text(res['subtasks'][0]);
                }
                else {
                    $("#esubtasks").attr("hidden", true);
                }

                if ($.inArray("The status field is required.", res['status']) !== -1) {
                    $("#estatus").removeAttr("hidden");
                    $("#estatus").text(res['status'][0]);
                }
                else {
                    $("#estatus").attr("hidden", true);
                }
            }

            // function of validation error for add data
            function validation_error_modify(res) {
                console.log(res);

                if ($.inArray("The title field is required.", res['title']) !== -1) {
                    $("#emtitle").removeAttr("hidden");
                    $("#emtitle").text(res['title'][0]);
                }
                else {
                    if ($.inArray("The title has already been taken.", res['title']) !== -1) {
                        $("#emtitle").removeAttr("hidden");
                        $("#emtitle").text(res['title'][0]);
                    }
                    else {
                        $("#emtitle").attr("hidden", true);
                    }

                }

                if ($.inArray("The description field is required.", res['description']) !== -1) {
                    $("#emdescription").removeAttr("hidden");
                    $("#emdescription").text(res['description'][0]);
                }
                else {
                    if ($.inArray("The description field must be at least 5 characters.", res['description']) !== -1) {
                        $("#emdescription").removeAttr("hidden");
                        $("#emdescription").text(res['description'][0]);
                    }
                    else {
                        $("#emdescription").attr("hidden", true);
                    }

                }

                if ($.inArray("The priority field is required.", res['priority']) !== -1) {
                    $("#empriority").removeAttr("hidden");
                    $("#empriority").text(res['priority'][0]);
                }
                else {
                    $("#empriority").attr("hidden", true);
                }

                if ($.inArray("The due date field is required.", res['due_date']) !== -1) {
                    $("#emdue_date").removeAttr("hidden");
                    $("#emdue_date").text(res['due_date'][0]);
                }
                else {
                    $("#emstatus").attr("hidden", true);
                }

                if ($.inArray("The dependency field is required.", res['dependency']) !== -1) {
                    $("#emdependency").removeAttr("hidden");
                    $("#emdependency").text(res['dependency'][0]);
                }
                else {
                    $("#emdependency").attr("hidden", true);
                }

                if ($.inArray("The subtasks field is required.", res['subtasks']) !== -1) {
                    $("#emsubtasks").removeAttr("hidden");
                    $("#emsubtasks").text(res['subtasks'][0]);
                }
                else {
                    $("#emsubtasks").attr("hidden", true);
                }

                if ($.inArray("The status field is required.", res['status']) !== -1) {
                    $("#emstatus").removeAttr("hidden");
                    $("#emstatus").text(res['status'][0]);
                }
                else {
                    $("#emstatus").attr("hidden", true);
                }
            }

            // function of show table
            function show_table() {
                $.ajax({
                    type: "get",
                    url: "/show",
                    success: function (data) {
                        let rows = "";
                        data.forEach(function (task) {
                            rows += `<tr>
                                            <td>${task.title}</td>
                                            <td>${task.description}</td>
                                            <td>${task.status}</td>
                                            <td>${task.priority}</td>
                                            <td>${task.due_date}</td>
                                            <td>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                onclick="deletemodel('${task.title}')">Delete</button>
                                                <button type="button" class="btn btn-primary" 
                                                onclick="updatemodel('${task.id}','${task.title}','${task.description}','${task.status}','${task.priority}','${task.due_date}','${task.dependency}','${task.subtasks}')" data-bs-toggle="modal" data-bs-target="#updateModel">Update</button>
                                                </td>                            
                                        </tr>`;
                        })
                        $('#mytable tr:gt(0)').remove();
                        $("#mytable").append(rows);
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
            }

            // search data
            $("#searchform").on('submit', function (e) {
                e.preventDefault();
                console.log($("#searchdata").val());
                $.ajax({
                    type: 'post',
                    url: '/show-search',
                    data: {
                        searchdata: $("#searchdata").val(),
                    },
                    success: function (data) {
                        console.log(data);
                        let rows = "";
                        data.forEach(function (task) {
                            rows += `<tr>
                                            <td>${task.title}</td>
                                            <td>${task.description}</td>
                                            <td>${task.status}</td>
                                            <td>${task.priority}</td>
                                            <td>${task.due_date}</td>
                                            <td>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                onclick="deletemodel('${task.title}')">Delete</button>
                                                <button type="button" class="btn btn-primary" 
                                                onclick="updatemodel('${task.title}','${task.description}','${task.status}','${task.priority}','${task.due_date}','${task.dependency}','${task.subtasks}')" data-bs-toggle="modal" data-bs-target="#updateModel">Update</button>
                                                </td>                            
                                        </tr>`;
                        })
                        $('#mytable tr:gt(0)').remove();
                        $("#mytable").append(rows);
                    },
                    error: function (e) {
                        console.log(e);

                    }
                })

            })

            // modify model
            $('#modifyform').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    type: 'put',
                    url: '/modify',
                    data: {
                        id: $("#mid").val(),
                        title: $("#mtitle").val(),
                        description: $("#mdescription").val(),
                        priority: $("#mpriority").val(),
                        due_date: $("#mdue_date").val(),
                        dependency: $("#mdependency").val(),
                        subtasks: $("#msubtasks").val(),
                        status: $("#mstatus").val(),
                    },
                    success: function (res) {
                        console.log(res);

                        if (res.success == "modify") {
                            console.log("save");
                            $(".btn-close").trigger("click");

                            show_table();
                            toastr.success('Update Record');
                        }
                        else {
                            validation_error_modify(res);
                            toastr.warning("Fial The Record");
                        }
                    },
                    error: function (e) {
                        console.log(e);

                    }
                });

            });

            // delete model
            $('#deleteform').on('submit', function (e) {
                e.preventDefault();
                console.log($("#getdeletedata").val());
                $.ajax({
                    type: 'delete',
                    url: '/remove',
                    data: {
                        title: $("#getdeletedata").val(),
                    },
                    success: function (res) {
                        if (res.success == "delete") {
                            console.log("save");
                            $(".btn-close").trigger("click");
                            show_table();
                            toastr.success('Delete Record');
                        }
                        else {
                            toastr.warning("not Delete")
                        }

                    },
                    error: function (e) {
                        console.log(e);

                    }
                });

            });

            // get data 
            show_table();

            // add model
            $('#addformmodel').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    type: 'post',
                    url: '/add',
                    data: {
                        title: $("#title").val(),
                        description: $("#description").val(),
                        priority: $("#priority").val(),
                        due_date: $("#due_date").val(),
                        dependency: $("#dependency").val(),
                        subtasks: $("#subtasks").val(),
                        status: $("#status").val(),
                    },
                    success: function (res) {
                        if (res.success == "save") {
                            console.log("save");
                            $(".btn-close").trigger("click");
                            show_table();
                            // Enable pusher logging - don't include this in production

                            // toastr.success('Task added to Data!');
                        }
                        else {
                            console.log(res);

                            validation_error(res);
                            toastr.warning("Fial Record");
                        }
                    },
                    error: function (e) {
                        console.log(e);

                    }
                });
            });
        });
    </script>
    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('f3599a1dd3027fe082b2', {
            cluster: 'ap2'
        });

        var channel = pusher.subscribe('mychannel');
        channel.bind('save', function (data) {
            console.log(data);

            alert(JSON.stringify(data));
        });

        // <script type="module">
    //         window.Echo.channel('posts')
    //             .listen('.create', (data) => {
    //                 console.log('Order status updated: ', data);
    //                 var d1 = document.getElementById('notification');
    //                 d1.insertAdjacentHTML('beforeend', '<div class="alert alert-success alert-dismissible fade show"><span><i class="fa fa-circle-check"></i>  '+data.message+'</span></div>');
    //             });
    // </script>
    </script>
</body>

</html>