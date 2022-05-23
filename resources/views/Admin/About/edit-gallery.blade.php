@extends('Admin.admin_master')

@section('content')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-5">Update Image</h4>

                        <form action="{{ route('update.gallery', $gallery->id) }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Select Images</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="images" id="multi_images" multiple />
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg" src="{{ asset('upload/multiple_images/'.$gallery->images)}}" alt="About Image" id="show_image" />
                                </div>
                            </div>
                            <!-- end row -->

                            <input type="submit" value="Update Image" class="btn btn-info waves-effect waves-light" />
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

        $('#multi_images').change(function(e) {


            var reader = new FileReader()

            reader.onload = function(e) {
                $('#show_image').attr('src', e.target.result)

            }
            reader.readAsDataURL(e.target.files['0'])
        })


    })

</script>

@endsection
