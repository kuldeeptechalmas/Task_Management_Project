<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <style>
    </style>
    <script>
        function deletemodel(title) {
            document.getElementById('getdeletedata').value = title;
            var title_data = title;
        }
    </script>
</head>

<body>
    {{-- add --}}
    {{-- <form class="container-md m-5" method="POST">
        @csrf
        <h1>Add Task</h1>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Task Title</label>
            <input type="text" name="title" class="form-control" value="{{old('title')}}">
            @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Task Description</label>
            <input type="text" name="description" class="form-control" value="{{old('description')}}">
            @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">

            <label for="exampleInputEmail1" class="form-label">Priority</label>
            <select name="priority" id="">
                <option value="">Select</option>
                <option value="Very High" {{old('priority')=='Very high' ?'selected':''}}>Very High</option>
                <option value="High" {{old('priority')=='High' ?'selected':''}}>High</option>
                <option value="Medium" {{old('priority')=='Medium' ?'selected':''}}>Medium</option>
                <option value="Low" {{old('priority')=='Low' ?'selected':''}}>Low</option>
            </select>
            @error('priority')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Due Date</label>
            <input type="date" name="due_date" class="form-control" value="{{old('due_date')}}">
            @error('due_date')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Dependency</label>
            <input type="text" name="dependency" class="form-control" value="{{old('dependency')}}">
            @error('dependency')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Subtasks</label>
            <input type="text" name="subtasks" class="form-control" value="{{old('subtasks')}}">
            @error('subtasks')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Status Logic</label>
            <input type="text" name="status" class="form-control" value="{{old('status')}}">
            @error('status')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>

    </form> --}}

    <h1 style="text-align: center; margin-top: 40px;">Show Task</h1>

    @if (isset($showdata))
        <table class="table table-striped table-hover" style="margin-left: 30px; margin-top: 40px;">

            <tr>
                <td>Title</td>
                <td>Description</td>
                <td>Status</td>
                <td>Priority</td>
                <td>Due Date</td>
                <td>Action</td>
            </tr>
            @foreach ($showdata as $item)
                <tr>
                    <td>{{$item->title}}</td>
                    <td>{{$item->description}}</td>
                    <td>{{$item->status}}</td>
                    <td>{{$item->priority}}</td>
                    <td>{{$item->due_date}}</td>
                    <td>
                        {{-- delete button --}}
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"
                            onclick="deletemodel('{{$item->title}}')">Delete</button>
                        <button type="button" class="btn btn-primary">Update</button>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif

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
                <form action="/remove" method="post">
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

    {{-- Add Model --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Task</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                <form class="container-md m-5" method="POST" action="/add">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Task Title</label>
                        <input type="text" name="title" class="form-control " style="width: 81%" value="{{old('title')}}">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Task Description</label>
                        <input type="text" name="description" style="width: 81%" class="form-control" value="{{old('description')}}">
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">

                        <label for="exampleInputEmail1" class="form-label">Priority</label>
                        <select name="priority" id="">
                            <option value="">Select</option>
                            <option value="Very High" {{old('priority') == 'Very high' ? 'selected' : ''}}>Very High</option>
                            <option value="High" {{old('priority') == 'High' ? 'selected' : ''}}>High</option>
                            <option value="Medium" {{old('priority') == 'Medium' ? 'selected' : ''}}>Medium</option>
                            <option value="Low" {{old('priority') == 'Low' ? 'selected' : ''}}>Low</option>
                        </select>
                        @error('priority')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Due Date</label>
                        <input type="date" name="due_date" class="form-control" style="width: 81%" value="{{old('due_date')}}">
                        @error('due_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Dependency</label>
                        <input type="text" name="dependency" class="form-control" style="width: 81%" value="{{old('dependency')}}">
                        @error('dependency')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Subtasks</label>
                        <input type="text" name="subtasks" class="form-control" style="width: 81%" value="{{old('subtasks')}}">
                        @error('subtasks')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Status Logic</label>
                        <input type="text" name="status" class="form-control" style="width: 81%" value="{{old('status')}}">
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
</body>

</html>