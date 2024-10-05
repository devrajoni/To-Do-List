@extends('layouts.master')
@section('content')
    <div class="content-page mb-5" style="min-height: calc(100vh - 240px);">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" style="border-radius: 10px;">
                        <div class="card-body shadow">
                          <h4 class="text-danger">{{ isset($task) ? 'Edit Task' : 'Add Task' }}</h4>  
                        </div>  
                    </div>
                </div>
            </div>
            <div class="card mt-3" style="border-radius: 10px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box-body">
								<form action="{{ isset($task) ? route('tasks.update', $task->id) : route('tasks.store') }}" method="POST" class="addTeam" id="addTeam" enctype="multipart/form-data">
									@csrf
									@if (isset($task))
										@method('PUT')
									@endif
									<!-- <div class="card"> -->
										<div class="flex__input grid-3 p-5">
											<div class="form-group">
												<label for="title">Title</label>
												<input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $task->title ?? '') }}" placeholder="Enter Task Title" />
												@error('title')
													<div class="alert__txt invalid-feedback">{{ $message }}</div>
												@enderror
											</div>
											<div class="form-group">
												<label for="description">Description</label>
												<input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description', $task->description ?? '') }}" placeholder="Enter Task Description" />
												@error('description')
													<div class="alert__txt invalid-feedback">{{ $message }}</div>
												@enderror
											</div>
											<div class="form-group">
												<label for="due_date">Due Date</label>
												<input type="date" class="form-control @error('due_date') is-invalid @enderror" id="due_date" name="due_date" value="{{ old('due_date', $task->due_date ?? '') }}" />
												@error('due_date')
													<div class="alert__txt invalid-feedback">{{ $message }}</div>
												@enderror
											</div>
											<div class="form-group">
												<label for="status">Status</label>
												<select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
													<option value="" disabled>Select Status</option>
													<option value="{{ \App\Enums\StatusEnum::PENDING->value }}" {{ (old('status', $task->status ?? '') === \App\Enums\StatusEnum::PENDING->value) ? 'selected' : '' }}>Pending</option>
													<option value="{{ \App\Enums\StatusEnum::COMPLETED->value }}" {{ (old('status', $task->status ?? '') === \App\Enums\StatusEnum::COMPLETED->value) ? 'selected' : '' }}>Completed</option>
												</select>
												@error('status')
													<div class="alert__txt invalid-feedback">{{ $message }}</div>
												@enderror
											</div>
										</div>
									<!-- </div> -->
									<div class="save__btn position-relative text-end">
										<button type="submit" class="btn  btn-lg btn-danger px-3 ">{{ isset($task) ? 'Update' : 'Save' }}</button>
									</div>
								</form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

