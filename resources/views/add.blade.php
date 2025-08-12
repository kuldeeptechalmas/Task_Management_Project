<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</head>
<body>
     <form class="container-md m-5" method="POST" style="width: 31%">
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

    </form> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
</body>
</html>