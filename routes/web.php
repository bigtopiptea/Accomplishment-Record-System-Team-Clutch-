<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\StaffAssignmentController;
use App\Models\Tasks;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Response as FacadeResponse;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthenticatedSessionController::class, 'create'], function () {
    return Inertia::render('Login');
});


Route::group(['middleware' => 'auth'], function () {
    //Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'], function () {
        return Inertia::render('Dashboard');
    })->name('dashboard.index');

    Route::get('tasks', [TasksController::class, 'index'], function(){
        return Inertia::render('Tasks');
    })->name('tasks.index');

    Route::get('permissions', [PermissionsController::class, 'index'], function () {
        return Inertia::render("Permissions");
    })->name('permissions.index');

    Route::get('profile/{user}/edit',  [UserController::class, 'profile'])->name('profile.index');
    Route::put('profile/{user}', [UserController::class, 'updateProfile'])->name('roles.update');

    Route::group(['middleware' => ['role:admin|head of office']], function () {
        Route::get('users', [UserController::class, 'index'], function(){
            return Inertia::render('Users');
        })->name('users.index');
    });


    //head of office route
    Route::group(['middleware' => ['role:head of office']], function () {

        //tasks crud route
        Route::get('tasks/create', [TasksController::class, 'create'])->name('tasks.create');
        Route::get('tasks/{task}/edit', [TasksController::class, 'edit'])->name('tasks.edit');
        Route::put('tasks/{task}', [TasksController::class, 'update'])->name('tasks.update');
        Route::post('tasks', [TasksController::class, 'store'])->name('tasks.store');
        Route::delete('tasks/{task}', [TasksController::class, 'destroy'])->name('tasks.destroy');
        Route::get('download', [TasksController::class, 'download'])->name('tasks.download');
        Route::get('listofstaff', [UserController::class, 'listofstaff'])->name('staff.list');

    
        Route::get('download1/{file_name}', function($file_name = null)
        {
            $path = storage_path().'/'.'app'.'/public/attachments/file/'.$file_name;
            if (file_exists($path)) {
                return FacadeResponse::download($path);
            }
    
        })->name('tasks.download1');
        Route::post('assignment', [StaffAssignmentController::class, 'store'])->name('assignment.store');
        Route::get('tasksSubmission/{task}/check', [TasksController::class, 'submission'])->name('tasks.submission');
    
        Route::delete('homework/{homework}', [TasksController::class, 'updateStatus'])->name('homework.update');
        Route::put('homework/{homework1}', [TasksController::class, 'updateStatus1'])->name('homework.update1');
        Route::get('homework2/{homework2}', [TasksController::class, 'updateStatus2'])->name('homework.update2');
        Route::get('homework3/{homework3}', [TasksController::class, 'updateStatus3'])->name('homework.update3');
    });
        //admin route
    Route::group(['middleware' => ['role:admin']], function () {

        //user crud route
        Route::get('users/create', [UserController::class, 'create'])->name('users.create');
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::post('users', [UserController::class, 'store'])->name('users.store');
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

        //Roles Route
        Route::get('roles', [RolesController::class, 'index'], function () {
            return Inertia::render("Roles");
        })->name('roles.index');
        Route::delete('roles/{role}', [RolesController::class, 'destroy'])->name('roles.destroy');
        Route::post('roles', [RolesController::class, 'store'])->name('roles.store');
        Route::get('roles/{role}', [RolesController::class, 'edit'])->name('roles.edit');
        Route::put('roles/{role_id}', [RolesController::class, 'update'])->name('roles.updates');

        Route::get('headofofficelist', [UserController::class, 'listofhoh'])->name('hoh.list');
        Route::get('headofofficelist/{list}', [UserController::class, 'hohCheckList'])->name('hoh.check');

    });

    //staff routes
    Route::group(['middleware'=> ['role:staff']], function() {

        Route::get('download2/{file_name}', function($file_name = null)
        {
            $path = storage_path().'/'.'app'.'/public/attachments/file/'.$file_name;
            if (file_exists($path)) {
                return FacadeResponse::download($path);
            }

        })->name('tasks.download2');

        Route::get('download3/{file_name}', function($file_name = null)
        {
            $path = storage_path().'/'.'app'.'/public/attachments/reference/'.$file_name;
            if (file_exists($path)) {
                return FacadeResponse::download($path);
            }

        })->name('tasks.download3');

        Route::get('homework', [AssignmentController::class, 'index'], function () {
            return Inertia::render("Homework");
        })->name('homework.index');
        Route::get('homework/{homework}/edit', [AssignmentController::class, 'edit'])->name('homework.edit');
        Route::post('uploadAssignment/{assignmentId}', [AssignmentController::class, 'upload'])->name('assignment.upload');
        Route::put('changeStatus/{status}', [AssignmentController::class, 'updateStatus'])->name('status.update');
    });


});




require __DIR__ . '/auth.php';
