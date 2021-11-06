<?php

namespace App\Http\Controllers;

use App\Models\{
    Assignment,
    Tasks,
    UploadFile,
    User
};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Auth,
    Redirect,
    Request as FacadesRequest,
    Storage
};
use Inertia\Inertia;
use PhpParser\Node\Expr\Assign;

class AssignmentController extends Controller
{

    public function index(User $user)
    {
        Auth::user()->roles->pluck('name');


        $assignmentIds = Assignment::where('staff_name', Auth::user()->name)
            ->select([
                'id',
                'staff_name',
                'task_id',
                'status',
                'task_name',
                'task_due',
                'assigned_by'
            ])
            ->with('uploadFiles')
            ->get();

        return Inertia::render('StaffAssignment/Index', [
            'assignments' => $assignmentIds
        ]);
    }

    public function upload($assignmentId, Request $request)

    {
        foreach ($request->file('attachments') as $attachment) {

            $file = $attachment;

            $file_name = str_replace(" ", "_", $file->getClientOriginalName());

            $storage = Storage::disk('attachments')->putFileAs('file', $file, $file_name);

            $storageName = basename($storage);

            $time_submitted = Carbon::now()->timezone('Asia/Kuala_Lumpur');

            $time = $time_submitted->toDayDateTimeString();

            $task_id = $request->task_id;

            $status = 'To be Verified';

            $submittedBy = Auth::user()->name;

            UploadFile::create([
                'assignment_id' => $assignmentId,
                'task_id' => $task_id,
                'submitted_by' => $submittedBy,
                'storage_path' => $storageName,
                'time_submitted' => $time,
                'task_status' =>  $status
            ]);
        }

        return Redirect::route('homework.index')->with(['success' => 'The Task is submitted to the Head of Office!']);
    }

    public function edit($id, Tasks $tasks)
    {
        Auth::user()->roles->pluck('name');

        $task = Assignment::find($id);

        if ($task) {

            $tasksId = Tasks::whereIn('id', $task)
                ->first();

            $isOverdue = false;

            $taskDueDateObj = Carbon::parse($tasksId->task_due);

            $time = $taskDueDateObj->toDayDateTimeString();

            $todayDateObj = Carbon::parse($tasksId->task_start);

            //task_start
            $today =  $todayDateObj->toDayDateTimeString();

            $dayDiff = $todayDateObj->diffInDays($taskDueDateObj, false);

            if ($dayDiff < 0) {
                $isOverdue = true;
            }


            
            $params = [
                'assignment' => [
                    'id' => $tasksId->id,
                    'name' => $tasksId->name,
                    'requirements' => $tasksId->requirements,
                    'task_due' => $time,
                    'isOverdue' => $isOverdue,
                    'assigned_by' => $tasksId->assigned_by,
                    'status' => $task->status,
                    'reference' => $tasksId->reference,
                    'upload_files' => $task->uploadFiles
                ],
                'route_slug' => route('assignment.upload', ['assignmentId' => $task->id]),
                'token' => csrf_token()
            ];
        }

        return Inertia::render('StaffAssignment/Edit', $params);
    }


    public function updateStatus($id)
    {
        $task = Assignment::find($id);

        $status = 'To be Verified';

        $task->status = $status;

        $task->save();

        return Inertia::render('homework.edit')->with(['toast' => ['message' => 'Successfully Updated!']]);
    }
}
