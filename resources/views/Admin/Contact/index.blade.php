@extends('Admin.admin_master')

@section('content')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-3">All messages</h4>
                        <hr style="width: 100%;border:1px solid #ddd;margin-bottom:15px;">

                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Phone</th>
                                    <th>Message</th>
                                    <th>Date Sent</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach($model as $key => $value)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->email}}</td>
                                    <td>{{$value->subject}}</td>
                                    <td>{{$value->phone}}</td>
                                    <td>{{$value->message}}</td>
                                    <td>{{ date('d M Y',strtotime($value->created_at)) }}</td>
                                    <td>
                                        <div class="text-center">

                                            <a href="{{ route('delete.message',$value->id) }}" class="btn btn-danger btn-rounded btn-sm ml-5" title="Delete Image" id="delete"><i class="fas fa-trash"></i></a>


                                        </div>

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
