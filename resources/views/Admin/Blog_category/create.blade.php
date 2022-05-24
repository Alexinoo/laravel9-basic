@extends('Admin.admin_master')

@section('content')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Add Blog Category</h4>

                        <hr style="width: 100%;border:1px solid #ddd;"><br><br>

                        <form action="{{ route('store.category') }}" method="POST">

                            @csrf
                            <div class="row mb-3">
                                <label for="category" class="col-sm-2 col-form-label"> Blog Category</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="category" />
                                    @error('category')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->

                            <input type="submit" value="Add Category" class="btn btn-info waves-effect waves-light" />
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>

    </div>
</div>
@endsection
