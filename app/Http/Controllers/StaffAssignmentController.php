<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Tasks;
use App\Models\User;
use App\Rules\Assignment as RulesAssignment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class StaffAssignmentController extends Controller
{

    public function store(Request $request)
    {
        $status = 'Unfinished';
        
        $combined = array_map(null, $request->taskIds, $request->taskName, $request->taskDue, $request->taskAssignedBy);
        foreach ($combined as $user) {
            $id = $user[0];
            $task_name = $user[1];
            $task_due = $user[2];
            $assigned_by = $user[3];

            if (Assignment::where('id',  $id)->exists()) {
                return Redirect::route('tasks.index')->with(['error' => 'Task is already assigned to the selected Staff !']);
            } else {
                Assignment::create([
                    'task_id' => $id,
                    'task_name' =>  $task_name,
                    'status' => $status,
                    'task_due' => $task_due,
                    'assigned_by' => $assigned_by,
                    'staff_name' => $request->staff_name
                ]);
            }
        }
        return Redirect::route('tasks.index')->with(['success'  => 'Task is Assigned !']);
    }
}
