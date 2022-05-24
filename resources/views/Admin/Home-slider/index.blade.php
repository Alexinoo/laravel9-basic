@extends('Admin.admin_master')

@section('content')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Home Slider Page</h4>

                        <form action="{{ route('update.slider',$model->id) }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="title" value="{{ $model->title }}">

                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="short_description" value="{{ $model->short_description }}">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Video URL</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="video_url" value="{{ $model->video_url }}">
                                </div>
                            </div>
                            <!-- end row -->


                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Slider Image</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="image" id="slider_image" />
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg" src="{{ !empty($model->image) ? asset('upload/Home_slide/'.$model->image) : asset('upload/no_image.jpg')}}" alt="Slider Image" id="show_image" />


                                </div>
                            </div>
                            <!-- end row -->

                            <input type="submit" value="Update Slider" class="btn btn-info waves-effect waves-light" />
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

        $('#slider_image').change(function(e) {

            var reader = new FileReader()

            reader.onload = function(e) {
                $('#show_image').attr('src', e.target.result)

            }
            reader.readAsDataURL(e.target.files['0'])
        })


    })

</script>

@endsection
