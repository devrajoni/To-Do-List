<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\UserTask;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use Yajra\DataTables\DataTables;
use App\Enums\RoleTypeEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class TaskController extends Controller
{

    public function index(Request $request)
    {
        try {
            $user               = auth()->user();
            $employee_role      = \DB::table('roles')->where('name', RoleTypeEnum::Employee->value)->first();
            $admin_role         = \DB::table('roles')->where('name', RoleTypeEnum::Admin->value)->first();

    
            if ($user->role_id == $admin_role->id) {
                $tasks      = Task::all();
            } else if ($user->role_id == $employee_role->id) {
                $userId     = auth()->user()->id;
                $tasks      = Task::where('status', 'pending')
                            ->whereHas('userTask', function ($query) use ($userId) {
                                $query->where('user_id', $userId);
                            })
                            ->with('userTask.user')
                            ->latest()
                            ->get();
            }
    
            $users          = User::where('role_id', $employee_role->id)->get();
            return view('task.index', compact('tasks', 'users'));
        } catch (Exception $e) {
            return redirect()->route('tasks.index')->with('error', 'Failed to retrieve tasks: ' . $e->getMessage());
        }
    }
    


    public function create()
    {
        return view('task.form');
    }

    public function store(StoreRequest $request)
    {
        try {
            Task::create($request->all());
            return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
        } catch (Exception $e) {
            return redirect()->route('tasks.index')->with('error', 'Failed to create task: ' . $e->getMessage());
        }
    }

    public function edit(Task $task)
    {
        return view('task.form', compact('task'));
    }

    public function update(UpdateRequest $request, Task $task)
    {
        try {
            $task->update($request->all());
            return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
        } catch (Exception $e) {
            return redirect()->route('tasks.index')->with('error', 'Failed to update task: ' . $e->getMessage());
        }
    }

    public function destroy(Task $task)
    {
        try {
            $task->delete();
            return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('tasks.index')->with('error', 'Failed to delete task: ' . $e->getMessage());
        }
    }

    public function assignUsers(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'user_id' => 'required|exists:users,id',
        ]);
    
        $task                   = Task::find($request->input('task_id'));
    
        try {
            $userTaskExists     = UserTask::where('task_id', $task->id)
                ->where('user_id', $request->user_id)
                ->exists();
    
            if (!$userTaskExists) {
                $user_task          = new UserTask();
                $user_task->task_id = $task->id;
                $user_task->user_id = $request->user_id;
                $user_task->save();
            }
    
            return redirect()->route('tasks.index')->with('success', 'User successfully assigned to the task.');
        } catch (Exception $e) {
            return redirect()->route('tasks.index')->with('error', 'Failed to assign user: ' . $e->getMessage());
        }
    }


    public function complete($id)
    {
        $task           = Task::findOrFail($id);
        $task->status   = 'completed'; 
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task marked as complete.');
    }
    


}
