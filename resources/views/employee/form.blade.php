@extends('layouts.master')
@section('content')
    <div class="content-page mb-5" style="min-height: calc(100vh - 240px);">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" style="border-radius: 10px;">
                        <div class="card-body shadow">
                          <h4 class="text-danger">Edit Employee</h4>  
                        </div>  
                    </div>
                </div>
            </div>
            <div class="card mt-3" style="border-radius: 10px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box-body">
								<form action="{{ route('employees.update', $employee->id) }}" method="POST">
									@csrf
									@method('PUT')
									<div class="flex__input grid-3 p-5">
										<div class="form-group">
											<label for="name">Name</label>
											<input type="text" class="form-control" id="name" name="name" value="{{ old('name', $employee->name) }}" required>
										</div>

										<div class="form-group">
											<label for="email">Email</label>
											<input type="email" class="form-control" id="email" name="email" value="{{ old('email', $employee->email) }}" required>
										</div>
										<div class="form-group">
											@foreach($permissions as $permission)
											<tr>
												<td><span class="text-capitalize"> {{ $permission->name }} </span></td>
												<td>
													@php 
														// Decode keywords JSON string to an associative array
														$keywords = json_decode($permission->keywords, true);
													@endphp
													@foreach($keywords as $key => $keyword)
														<div class="custom-checkbox mb-2">
															<label>
																<input name="permissions[]" type="checkbox"
																	value="{{ $keyword }}" {{ in_array($keyword, json_decode($employee->permissions, true) ?? []) ? 'checked' : '' }}
																	']
																	>

																<span class="text-capitalize">{{ $key }}</span>
															</label>
														</div>
													@endforeach
												</td>
											</tr>
											@endforeach
										</div>
									</div>
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


