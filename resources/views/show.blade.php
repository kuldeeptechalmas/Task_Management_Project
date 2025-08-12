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
    <script>
        function deletemodel(title) {
            document.getElementById('getdeletedata').value = title;
            var title_data = title;
        }
    </script>
</head>

<body>
    <h1 style="text-align: center; margin-top: 40px;">Show Task</h1>

    @if (isset($showdata))
        <table class="table table-striped table-hover" style="margin-left: 30px; margin-top: 40px;">
            <tr>
                <form class="d-flex" action="/show-search">
                    <td><input class="form-control me-2" type="search" name="searchdata" placeholder="Search" aria-label="Search" ></td>
                    <td><button class="btn btn-outline-success" type="submit">Search</button></td></form>
                    <td><a href="/"><button class="btn btn-outline-success" type="submit">Show</button></a></td>
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
                        <a href="/modify/{{$item->title}}"><button type="button" class="btn btn-primary">Update</button></a>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif

    <a href="/add"><button type="button" class="btn btn-primary" style="margin-left: 50px">Add</button></a>

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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
</body>

</html>