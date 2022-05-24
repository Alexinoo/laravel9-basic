@extends('Admin.admin_master')

@section('content')

<style type="text/css">
    .bootstrap-tagsinput .tag {
        margin-right: 2px;
        color: #b70000;
        font-weight: 700px;
    }

</style>


<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Add Blog Details</h4>

                        <hr style="width: 100%;border:1px solid #ddd;">

                        <form action="{{ route('store.blog') }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            <div class="row mb-3">
                                <label for="blog_category_id" class="col-sm-2 col-form-label"> Blog Category</label>
                                <div class="col-sm-10">
                                    <select name="blog_category_id" id="blog_category_id" class="form-select">
                                        <option value="" selected="" disabled>--select category--</option>

                                        @foreach($blog_categories as $key => $category)
                                        <option value="{{$category->id}}">{{$category->category}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- end row -->


                            <div class="row mb-3">
                                <label for="blog_title" class="col-sm-2 col-form-label">Blog Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="blog_title" id="blog_title" />

                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="blog_tags" class="col-sm-2 col-form-label">Blog Tags</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="blog_tags" id="blog_tags" value="home , tech" data-role="tagsinput" />

                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="elm1" class="col-sm-2 col-form-label"> Blog Description</label>
                                <div class="col-sm-10">
                                    <textarea id="elm1" name="blog_description"></textarea>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="blog_image" class="col-sm-2 col-form-label">Blog Image</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="blog_image" id="blog_image" />

                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="show_image" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg" src="{{ asset('upload/no_image.jpg')}}" alt="Blog Image" id="show_image" />
                                </div>
                            </div>
                            <!-- end row -->

                            <input type="submit" value="Insert Blog Data" class="btn btn-info waves-effect waves-light" />
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>

    </div>
</div>
@endsection

@section('scripts')

<script type="text/javascript">
    $(document).ready(function() {

        $('#blog_image').change(function(e) {

            var reader = new FileReader()

            reader.onload = function(e) {
                $('#show_image').attr('src', e.target.result)

            }
            reader.readAsDataURL(e.target.files['0'])
        })


    })

</script>

@endsection
