<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Carbon\Carbon;
use App\Models\Tasks;
use App\Models\UploadFile;
use App\Models\User;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use PDO;
use PhpParser\Node\Expr\Assign;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        Auth::user()->roles->pluck('name');

        // $users = User::role('staff')
        //     ->get();
        
        $users = User::when($request->user, function ($query, $user){
            $query->where('name', 'Like', '%' . $user . '$');
        })
        ->role('staff')
        ->select([
            'id',
            'name',
        ])
        ->with('roles')
        ->get();
        

        $tasks = Tasks::when($request->task, function ($query, $task) {
            $query->where('id', 'Like', '%' . $task . '%');
        })
            ->where('headofoffice_id', Auth::user()->id)
            ->select([
                'id',
                'assigned_by',
                'name',
                'task_due',
                'task_start',
            ])
            ->with('uploadFiles')
            ->paginate(5);

        

        return Inertia::render('Tasks/Tasks', ['tasks' => $tasks, 'users' => $users]);
    }

    public function submission($id)
    {
        $task = Tasks::findOrFail($id);

        $assignment = Assignment::findOrFail($id);

        return Inertia::render('Tasks/Submission', ['userUploads' => $task->uploadFiles]);
    }

    public function updateStatus($id)
    {
        $upload_file = UploadFile::find($id);

        $upload_file->delete();

        return Redirect::back()->with(['success' => 'Tasks returned to the Staff !']);
    }

    public function updateStatus1($id)
    {
        $assignment = Assignment::find($id);

        $status = 'Unfinished';

        $assignment->status = $status;

        $assignment->save();

        return Redirect::back()->with(['success' => 'Submitted Tasks Change Status Success!']);
    }


    public function updateStatus2($id, Request $request)
    {

        $assignment = UploadFile::find($id);

        $status = 'To be Verified';

        $assignment->task_status = $status;

        $assignment->save();

        return Redirect::back()->with(['success' => 'Submitted Tasks Change Status Success!']);
    }
    public function updateStatus3($id, Request $request)
    {

        $assignment = UploadFile::find($id);

        $status = 'Verified';

        $assignment->task_status = $status;

        $assignment->save();

        return Redirect::back()->with(['success' => 'Submitted Tasks Change Status Success!']);
    }

    public function create()
    {
        Auth::user()->roles->pluck('name');

        $users = User::role('staff')->get();

        return Inertia::render('Tasks/CreateTasks', ['users' => $users]);
    }

    public function store(Request $request)
    {

        $file = $request->file('file');


        $request->validate([
            'task_name' => ['required', 'max:50'],
            'task_requirements' => ['required', 'max:50'],
            'task_due' => 'required|date'
        ]);


        $assignedBy = Auth()->user()->name;
        $assignedById = Auth()->user()->id;

        $task_start = Carbon::now()->timezone('Asia/Kuala_Lumpur');

        $task_due = $request->task_due;

        $task_due_parse = Carbon::parse($task_due);
        $task_due_convert = $task_due_parse->toDayDateTimeString();
        $task_start_convert = $task_start->toDayDateTimeString();


        if ($file) {

            $file_name = str_replace(" ", "_", $file->getClientOriginalName());

            $storage = Storage::disk('attachments')->putFileAs('reference', $file, $file_name);

            $storageName = basename($storage);

            Tasks::create([
                'name' => $request->task_name,
                'headofoffice_id' => $assignedById,
                'assigned_by' => $assignedBy,
                'requirements' => $request->task_requirements,
                'task_due' => $task_due_convert,
                'task_start' => $task_start_convert,
                'reference' => $storageName
            ]);
        } else {
            $no_reference = 'No Reference Uploaded';
            Tasks::create([
                'name' => $request->task_name,
                'headofoffice_id' => $assignedById,
                'assigned_by' => $assignedBy,
                'requirements' => $request->task_requirements,
                'task_due' => $task_due_convert,
                'task_start' => $task_start_convert,
                'reference' => $no_reference
            ]);
        }
        return Redirect::route('tasks.index')->with(['success' => 'New Task is Created !']);
    }

    public function edit($id)
    {
        Auth::user()->roles->pluck('name');

        $tasks = Tasks::find($id);

        $isOverdue = false;

        $taskDueDateObj = Carbon::parse($tasks->task_due);
        $todayDateObj = Carbon::parse($tasks->task_start);

        $dayDiff = $todayDateObj->diffInDays($taskDueDateObj, false);

        if ($dayDiff < 0) {
            $isOverdue = true;
        }

        $task_due = Carbon::parse($tasks->task_due);


        $task_due_convert = $task_due->format('m/d/Y g:i a');


        return Inertia::render('Tasks/EditTask', [
            'tasks' => [
                'id' => $tasks->id,
                'name' => $tasks->name,
                'requirements' => $tasks->requirements,
                'task_start' => $tasks->task_start,
                'task_due' => $task_due_convert,
                'reference' => $tasks->reference,
                'overdue' => $isOverdue
            ]
        ]);
    }


    public function update($id, Request $request)
    {
        $tasks = Tasks::findOrFail($id);

        $tasks->name = $request->name;
        $tasks->requirements = $request->requirements;

        $task_due = $request->task_due;
        $task_due_parse = Carbon::parse($task_due);
        $task_due_convert = $task_due_parse->toDayDateTimeString();

        $tasks->task_due = $task_due_convert;


        $tasks->save();

        return Redirect::route('tasks.index')->with(['success'  => "Update Successfully !"]);
    }

    public function destroy($id)
    {

        $single_id = explode(',', $id);

        foreach ($single_id as $ids) {

            Tasks::findOrFail($ids)
                ->delete();

        }
        return Redirect::route('tasks.index')->with(['success' => 'Task Deleted Successfully !']);

        // return redirect()->back()->with(['toast' => ['message' => "Update Successfully!"]]);   
    }

}
