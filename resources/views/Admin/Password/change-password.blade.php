@extends('Admin.admin_master')

@section('content')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-title m-3">
                        <h4>Change Password</h4>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('update.password') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label for="current_password" class="col-sm-2 col-form-label">Current Password <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="password" name="current_password" id="current_password" placeholder="Current Password" />
                                    @error('current_password')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror

                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="password" class="col-sm-2 col-form-label">New Password <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="password" name="password" id="password" placeholder="New Password" />
                                    @error('password')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="password_confirmation" class="col-sm-2 col-form-label">Confirm Password <span class="text-danger">*</span></label>


                                <div class="col-sm-10">
                                    <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" />
                                    @error('password_confirmation')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->

                            <input type="submit" value="Change Password" class="btn btn-info waves-effect waves-light" />
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>

    </div>
</div>
@endsection
