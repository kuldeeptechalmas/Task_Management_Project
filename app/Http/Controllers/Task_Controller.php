<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Models\task;
use App\Models\users;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;
use Symfony\Contracts\Service\Attribute\Required;
use Validator;

class Task_Controller extends Controller
{
    public function sort(Request $request)
    {
        if ($request->nameasc == "priority" && $request->type == 'asc') {

            $task1 = Task::orderByRaw("FIELD(priority, 'Very high', 'High', 'Medium', 'Low')")->paginate(10);
            return view("tableofdata", ['data' => $task1]);

        } else if ($request->nameasc == "priority" && $request->type == 'desc') {

            $task1 = Task::orderByRaw("FIELD(priority, 'Low','Medium','High','Very high')")->paginate(10);
            return view("tableofdata", ['data' => $task1]);

        }
        $task = task::orderBy($request->nameasc, $request->type)->paginate(10);
        return view("tableofdata", ['data' => $task]);
    }

    public function show_table(Request $request)
    {
        $task = Task::orderByRaw("FIELD(priority, 'Very high', 'High', 'Medium', 'Low')")->paginate(10);
        if (Auth::user()) {
            if ($request->ajax()) {
                return view("tableofdata", ['data' => $task]);
            }
            return view("index", ['data' => $task]);
        } else {
            return view("error");
        }
    }

    public function remove(Request $request)
    {
        $task = task::where("title", $request->title)->first();
        if ($task) {
            $task->delete();
            return response()->json(["success" => "delete"]);
        }
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "title" => "Required||Unique:task,title",
            "description" => "Required||min:5",
            "priority" => "Required",
            "due_date" => "Required",
            "dependency" => "Required",
            "status" => "Required",
            "subtasks" => "Required",
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());

        }

        $task = new task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->priority = $request->priority;
        $task->due_date = $request->due_date;
        $task->dependency = $request->dependency;
        $task->status = $request->status;
        $task->subtasks = $request->subtasks;
        $task->save();

        return response()->json(["success" => "save"]);
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => [
                'required',
                Rule::unique('task')->ignore($request->id)
            ],
            "description" => "Required|min:5",
            "priority" => "Required",
            "due_date" => "Required",
            "dependency" => "Required",
            "status" => "Required",
            "subtasks" => "Required",
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $task = Task::where("id", $request->id)->first();

        if ($task) {
            $task->update([
                "title" => $request->title,
                "description" => $request->description,
                "priority" => $request->priority,
                "due_date" => $request->due_date,
                "dependency" => $request->dependency,
                "status" => $request->status,
                "subtasks" => $request->subtasks

            ]);
            return response()->json(["success" => "modify"]);
        }

    }
    
    public function searchdata(Request $request)
    {

        $task = task::where("title", "LIKE", "%" . $request->searchdata . "%")->
            orwhere("description", "LIKE", "%" . $request->searchdata . "%")->
            orwhere("status", "LIKE", "%" . $request->searchdata . "%")->
            orwhere("priority", "LIKE", "%" . $request->searchdata . "%")->
            orderByRaw("FIELD(priority, 'Very high', 'High', 'Medium', 'Low')")->paginate(10);

        if ($request->ajax()) {
            return view("tableofdata", ['data' => $task]);
        }
        return view("index", ['data' => $task]);
    }
}
