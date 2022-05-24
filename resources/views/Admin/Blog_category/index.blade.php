@extends('Admin.admin_master')

@section('content')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-3">Blog Categories</h4>
                        <hr style="width: 100%;border:1px solid #ddd;margin-bottom:15px;">

                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach($model as $key => $value)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$value->category}}</td>
                                    <td>
                                        <div class="text-center">
                                            <a href="{{ route('edit.category',$value->id) }}" class="btn btn-info btn-rounded btn-sm"><i class="fa fa-pencil-alt" title="Edit Image"></i></a>


                                            <a href="{{ route('delete.category',$value->id) }}" class="btn btn-danger btn-rounded btn-sm ml-5" title="Delete Image" id="delete"><i class="fas fa-trash"></i></a>


                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->


    </div>
</div>
@endsection
