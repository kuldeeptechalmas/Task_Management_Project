<table class="table table-striped table-hover" style="margin-left: 30px; margin-top: 40px;" id="mytable">
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>WELCOME {{Auth::USER()->name}}</td>
            </tr>
            <tr>

            </tr>
            <tr>
                <td>Title</td>
                <td>Description</td>
                <td>Status</td>
                <td>Priority</td>
                <td>Due Date</td>
                <td>Actions</td>
            </tr>
            @if (isset($data))
                @foreach ($data as $item)
                    <tr>
                        <td>{{$item->title}}</td>
                        <td>{{$item->description}}</td>
                        <td>{{$item->status}}</td>
                        <td>{{$item->priority}}</td>
                        <td>{{$item->due_date}}</td>
                        <td>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                onclick="deletemodel('{{$item->title}}')">Delete</button>
                            <button type="button" class="btn btn-primary"
                                onclick="updatemodel('{{$item->id}}','{{$item->title}}','{{$item->description}}','{{$item->status}}','{{$item->priority}}','{{$item->due_date}}','{{$item->dependency}}','{{$item->subtasks}}')"
                                data-bs-toggle="modal" data-bs-target="#updateModel">Update</button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </table>


        <div class="paginationDiv" style="margin-right: 73%;">
            {{ $data->links('pagination::bootstrap-5') }}
        </div>