<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Models\task;
use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Unique;
use Symfony\Contracts\Service\Attribute\Required;
use Validator;

class Task_Controller extends Controller
{

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "Required",
            "password" => "Required",
        ]); 

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = users::where("email", $request->email)
            ->where("password", $request->password)
            ->first();

        if ($user) {
            return response()->json(["success"=>"login"]);
        }
        else
        {
            return response()->json(["user"=>"Not found"]);
        }
    }
    public function show_table()
    {
        return view("index");

    }
    public function show()
    {
        $task = Task::orderByRaw("FIELD(priority, 'Very high', 'High', 'Medium', 'Low')")->get();
        return response()->json($task);
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

        // dd($validator->errors());

        if ($validator->fails()) {
            return response()->json($validator->errors());
            // return redirect()->back()->withErrors($validator)->withInput();
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

        event(new PostCreated("save successfully"));
// dd($task);
        return response()->json(["success" => "save"]);
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "title" => "Required",
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
        // dd($task);
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
            orderByRaw("FIELD(priority, 'Very high', 'High', 'Medium', 'Low')")->get();

        return response()->json($task);
    }

    // public function add(Request $request)
    // {
    //     if ($request->isMethod("post")) {

    //         $validator = Validator::make($request->all(), [
    //             "title" => "Required||Unique:task,title",
    //             "description" => "Required||min:5",
    //             "priority" => "Required",
    //             "due_date" => "Required",
    //             "dependency" => "Required",
    //             "status" => "Required",
    //             "subtasks" => "Required",
    //         ]);

    //         if ($validator->fails()) {
    //             return redirect()->back()->withErrors($validator)->withInput();
    //         }

    //         $task = new task();
    //         $task->title = $request->title;
    //         $task->description = $request->description;
    //         $task->priority = $request->priority;
    //         $task->due_date = $request->due_date;
    //         $task->dependency = $request->dependency;
    //         $task->status = $request->status;
    //         $task->subtasks = $request->subtasks;
    //         $task->save();

    //         return redirect()->route("show",["alldata"=>"save !!!"]);
    //     }
    //     return view("add", ["add_data" => "add ok"]);
    // }

    // public function show()
    // {
    //     $task = Task::orderByRaw("FIELD(priority, 'Very high', 'High', 'Medium', 'Low')")->get();
    //     return view("show", ["showdata" => $task]);
    // }

    // public function remove(Request $request)
    // {
    //     $task = task::where("title", $request->getdata)->first();
    //     if ($task) {
    //         $task->delete();
    //         return redirect()->route("show")->with("success", "ok");
    //     } else {
    //         return redirect()->back()->with("error", "task not found");
    //     }
    // }

    // public function modify($title)
    // {
    //     $task = Task::where("title", $title)->first();
    //     if ($task) {
    //         return view("modify", ["mdata" => $task]);
    //     } else {
    //         return redirect()->back()->with("error", "not found");
    //     }
    // }
    // public function update(Request $request)
    // {
    //     // dd($request->all());
    //     $validator = Validator::make($request->all(), [
    //         "title" => "Required",
    //         "description" => "Required|min:5",
    //         "priority" => "Required",
    //         "due_date" => "Required",
    //         "dependency" => "Required",
    //         "status" => "Required",
    //         "subtasks" => "Required",
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     $task = Task::where("id", $request->id)->first();

    //    if($task){
    //         $task->update([
    //             "title"=> $request->title,
    //             "description" => $request->description,
    //             "priority" => $request->priority,
    //             "due_date" => $request->due_date,
    //             "dependency" => $request->dependency,
    //             "status" => $request->status,
    //             "subtasks" => $request->subtasks

    //         ]);
    //         return redirect()->route("show")->with("success", "");
    //     }

    // }

    // public function searchdata(Request $request)
    // {

    //     $task = task::where("title","LIKE","%". $request->searchdata ."%")->
    //     orwhere("description","LIKE","%". $request->searchdata ."%")->
    //     orwhere("status","LIKE","%". $request->searchdata ."%")->get();
    //     return view("show", ["showdata" => $task]);
    // }
}
