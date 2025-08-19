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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .alert {
            width: 81%;
        }
    </style>
    <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
    <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>

</head>

<body>
    @auth
        <div>
            <form>
                @csrf
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#logoutmodel"
                    style="margin-left: 85%; width: 152px; height:43px;margin-top: 25px;">Logout</button>

            </form>

            <h1 style="text-align: center; margin-top: 20px;">Show Task</h1>
            <table class="table table-striped table-hover" style="margin-left: 30px; margin-top: 40p">
                <form class="d-flex" id="searchform">

                    
                    <td><button class="btn btn-outline-success" onclick="searchfunction()" type="button">Search</button>
                    </td>
                    <td>
                        <input class="form-control me-2" oninput="searchfunction()" id="searchdata" type="search"
                            name="searchdata" placeholder="Search" aria-label="Search">
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>WELCOME {{Auth::USER()->name}}</td>

                </form>

                <tr>
                    <td>Title
                        <i class="fa-solid fa-angle-up" onclick="titleAsc()" id="titleasc" hidden></i>
                        <i class="fa-solid fa-angle-down" onclick="titleDesc()" id="titledesc"></i>
                    </td>
                    <td style="width: 370px;">Description
                        <i class="fa-solid fa-angle-up" onclick="descriptionAsc()" id="descriptionasc" hidden></i>
                        <i class="fa-solid fa-angle-down" onclick="descriptionDesc()" id="descriptiondesc"></i>
                    </td>
                    <td>Status</td>
                    <td>Priority
                        <i class="fa-solid fa-angle-up" onclick="priorityAsc()" id="priorityasc" hidden></i>
                        <i class="fa-solid fa-angle-down" onclick="priorityDesc()" id="prioritydesc"></i>
                    </td>
                    <td>Due Date</td>
                    <td>Actions</td>
                </tr>
            </table>
            </td>
            <div id="show-data">
                @include('tableofdata', ['data' => $data])
            </div>


            {{-- add button model--}}
            <button type="button" class="btn btn-primary" style="margin-left: 50px" data-bs-toggle="modal"
                data-bs-target="#addModal">Add</button>

            <div id="pagination" class="mt-3"></div>
        </div>

<input type="text" name="" id="nameasc" hidden>
<input type="text" name="" id="type" hidden>

    @endauth
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
                        <div class="alert alert-danger" id="emtitle" style="width: 277%; display: none;"></div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Task Description</label>
                        <input type="text" name="description" id="mdescription" style="width: 277%" class="form-control"
                            value="{{old('description')}}">
                        <div class="alert alert-danger" id="emdescription" style="width: 277%;display: none;"></div>
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
                        <div class="alert alert-danger" id="empriority" style="width: 277%;display: none;"></div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Due Date</label>
                        <input type="date" name="due_date" id="mdue_date" style="width: 277%" class="form-control"
                            value="{{old('due_date')}}">
                        <div class="alert alert-danger" id="emdue_date" style="width: 277%;display: none;"></div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Dependency</label>
                        <input type="text" name="dependency" id="mdependency" style="width: 277%" class="form-control"
                            value="{{old('dependency')}}">
                        <div class="alert alert-danger" id="emdependency" style="width: 277%;display: none;"></div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Subtasks</label>
                        <input type="text" name="subtasks" id="msubtasks" style="width: 277%" class="form-control"
                            value="{{old('subtasks')}}">
                        <div class="alert alert-danger" id="emsubtasks" style="width: 277%;display: none;"></div>
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

    {{-- Logout Model --}}
    <div class="modal fade" id="logoutmodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">LOGOUT USER</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/logout" method="post">
                    @csrf
                    <div class="modal-body">
                        <h2>Confirm Logout</h2>
                        <p>Are you sure you want to log out?</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">LOGOUT</button>
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

        function titleAsc() {
            $("#titledesc").removeAttr("hidden");
            $("#titleasc").attr("hidden", true);
            AscDesc('title', 'asc');
        }
        function titleDesc() {
            $("#titleasc").removeAttr("hidden");
            $("#titledesc").attr("hidden", true);
            AscDesc('title', 'desc');
        }

        function descriptionAsc() {
            console.log('asc');
            $("#descriptiondesc").removeAttr("hidden");
            $("#descriptionasc").attr("hidden", true);
            AscDesc('description', 'asc');
        }
        function descriptionDesc() {
            console.log('dasc');
            $("#descriptionasc").removeAttr("hidden");
            $("#descriptiondesc").attr("hidden", true);
            AscDesc('description', 'desc');
        }

        function priorityAsc() {
            console.log('asc');
            $("#prioritydesc").removeAttr("hidden");
            $("#priorityasc").attr("hidden", true);
            AscDesc('priority', 'asc');
        }
        function priorityDesc() {
            console.log('dasc');
            $("#priorityasc").removeAttr("hidden");
            $("#prioritydesc").attr("hidden", true);
            AscDesc('priority', 'desc');
        }

        function AscDesc(nameasc, type) {
            document.getElementById('nameasc').value = nameasc;
            document.getElementById('type').value = type;
            $.ajax({
                type: "get",
                url: '/sort',
                data: {
                    nameasc: nameasc,
                    type: type
                },
                dataType: "html",
                success: function (res) {
                    $("#show-data").html(res);
                },
                error: function (e) {

                }

            })

        }
    </script>
    <script>
        function deletemodel(title) {
            document.getElementById('getdeletedata').value = title;
            var title_data = title;
        }

        function updatemodel(id, title, description, status, priority, due_date, dependency, subtasks) {
            $("#updateModel").find(".alert").css("display", "none");
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

        $(document).on('click', ".pagination a", function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            fetchData(url);
        });

        function fetchData(url) {
            $.ajax({
                type: "get",
                url: url,
                data: {
                    searchdata: $("#searchdata").val(),
                    nameasc: $("#nameasc").val(),
                    type: $("#type").val(),
                },
                dataType: "html",
                success: function (res) {
                    $("#show-data").html(res);
                },
                error: function (e) {

                }
            })
        }
        // search data
        function searchfunction() {

            console.log($("#searchdata").val());
            $.ajax({
                type: 'get',
                url: '/show-search',
                data: {
                    searchdata: $("#searchdata").val(),
                },
                success: function (data) {

                    if (data.length == 0) {
                        $('#mytable tr:gt(2)').remove();
                        $("#mytable").append(`<tr><td></td><td></td><td style="color:red;">Not Found Record<td><td></td><td></td></tr>`);
                        console.log("not found");
                    }
                    else {
                        $("#show-data").html(data);
                    }
                },
                error: function (e) {
                    console.log(e);

                }
            })
        }


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

            $('#deleteModal').on('shown.bs.modal', function () {
                toastr.warning("Delete the Record")

            });


            $.ajaxSetup({
                headers:
                    { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

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

                if ($.inArray("The title field is required.", res['title']) !== -1) {
                    // $("#emtitle").;
                    $("#emtitle").css("display", "block");
                    $("#emtitle").text(res['title'][0]);
                }
                else {
                    if ($.inArray("The title has already been taken.", res['title']) !== -1) {
                        $("#emtitle").css("display", "block");
                        $("#emtitle").text(res['title'][0]);
                    }
                    else {
                        $("#emtitle").css("display", "none");
                    }

                }

                if ($.inArray("The description field is required.", res['description']) !== -1) {
                    $("#emdescription").css("display", "block");
                    $("#emdescription").text(res['description'][0]);
                }
                else {
                    if ($.inArray("The description field must be at least 5 characters.", res['description']) !== -1) {
                        $("#emdescription").css("display", "block");
                        $("#emdescription").text(res['description'][0]);
                    }
                    else {
                        $("#emdescription").css("display", "none");
                    }

                }

                if ($.inArray("The priority field is required.", res['priority']) !== -1) {
                    $("#empriority").css("display", "block");
                    $("#empriority").text(res['priority'][0]);
                }
                else {
                    $("#empriority").css("display", "nome");
                }

                if ($.inArray("The due date field is required.", res['due_date']) !== -1) {
                    $("#emdue_date").css("display", "block");
                    $("#emdue_date").text(res['due_date'][0]);
                }
                else {
                    $("#emstatus").css("display", "none");
                }

                if ($.inArray("The dependency field is required.", res['dependency']) !== -1) {
                    $("#emdependency").css("display", "block");
                    $("#emdependency").text(res['dependency'][0]);
                }
                else {
                    $("#emdependency").css("display", "none");
                }

                if ($.inArray("The subtasks field is required.", res['subtasks']) !== -1) {
                    $("#emsubtasks").css("display", "block");
                    $("#emsubtasks").text(res['subtasks'][0]);
                }
                else {
                    $("#emsubtasks").css("display", "none");
                }

                if ($.inArray("The status field is required.", res['status']) !== -1) {
                    $("#emstatus").css("display", "block");
                    $("#emstatus").text(res['status'][0]);
                }
                else {
                    $("#emstatus").css("display", "none");
                }
            }

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


            // show function
            function show_table() {
                $.ajax({
                    type: "get",
                    url: "/show",
                    success: function (data) {
                        $("#show-data").html(data);
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
            }

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
                            toastr.success('Task added to Data!');
                            $('#addformmodel')[0].reset();
                        }
                        else {

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
</body>

</html>