@extends('Admin.admin_master')

@section('content')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-3">Footer Section</h4>
                        <hr style="width: 100%;border:1px solid #ddd;margin-bottom:15px;">


                        <form action="{{ route('update.footer',$model->id) }}" method="POST">

                            @csrf
                            <div class="row mb-3">
                                <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="phone" value="{{ $model->phone }}">


                                </div>
                            </div>
                            <!-- end row -->


                            <div class="row mb-3">
                                <label for="short_description" class="col-sm-2 col-form-label">Short Description</label>
                                <div class="col-sm-10">
                                    <textarea required="" class="form-control" rows="5" name="short_description">{{ $model->short_description }}</textarea>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="address" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="address" value="{{ $model->address }}">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="email" value="{{ $model->email }}">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="facebook" class="col-sm-2 col-form-label">Facebook Link</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="facebook" value="{{ $model->facebook }}">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="twitter" class="col-sm-2 col-form-label">Twitter</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="twitter" value="{{ $model->twitter }}">

                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="copyright" class="col-sm-2 col-form-label">Copyright</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="copyright" value="{{ $model->copyright }}">
                                </div>
                            </div>
                            <!-- end row -->

                            <input type="submit" value="Update Footer Content" class="btn btn-info waves-effect waves-light" />
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>

    </div>
</div>
@endsection
