@extends('layouts.master')
@section('content')
    <div class="content-page mb-5" style="min-height: calc(100vh - 240px);">
        <div class="container-fluid">
            <div class="d-flex justify-content-end">
                @if(hasPermission('tasks.create'))
                    <a href="{{ route('tasks.create') }}" class="btn btn-danger text-light">Add Task</a>
                @endif
            </div>
            <div class="card mt-3" style="border-radius: 10px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box-body">
                                <table class="table responsive">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Due Date</th>
                                            <th>Status</th>
                                            <th>Assigned Users</th>
                                            <th>Actions</th>
                                            <th>Mark Complete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tasks as $task)
                                            <tr id="task-row-{{ $task->id }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $task->title }}</td>
                                                <td>{{ $task->description }}</td>
                                                <td>{{ $task->due_date }}</td>
                                                <td>
                                                    <span class="badge {{ config('status_color.badge_color.'.$task->status) }} text-light">
                                                        {{ ucfirst($task->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if($task->userTask->isNotEmpty() && optional($task->userTask->first()->user)->name)
                                                        {{ optional($task->userTask->first()->user)->name }}
                                                    @else
                                                        <button class="btn btn-sm btn-info" title="Assign User" data-toggle="modal" data-target="#assignUserModal" data-task-id="{{ $task->id }}">
                                                            <i class="ph-user-plus"></i> Assign User
                                                        </button>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(hasPermission('tasks.edit'))
                                                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-info" title="Edit">
                                                            <i class="ph-pencil"></i> 
                                                        </a>
                                                    @endif
                                                    @if(hasPermission('tasks.destroy'))
                                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this task?');">
                                                                <i class="ph-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                                <td>
                                                @if($task->status !== \App\Enums\StatusEnum::COMPLETED->value)
                                                    <button type="button" class="btn btn-sm btn-success mark-complete" data-task-id="{{ $task->id }}" title="Mark as Complete">
                                                        Mark Complete
                                                    </button>
                                                @else
                                                    <span class="badge badge-success">Completed</span>
                                                @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal for Assigning User --}}
    <div class="modal fade" id="assignUserModal" tabindex="-1" aria-labelledby="assignUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignUserModalLabel">Assign User to Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="assignUserForm" action="{{ route('tasks.assignUsers') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="task_id" id="taskId" value="">
                        <div class="form-group">
                            <label for="user_ids">Select Users</label>
                            <select class="form-control" name="user_id" id="userIds">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Assign</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
