@extends('Admin.admin_master')

@section('content')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Portfolio Page</h4>

                        <hr style="width: 100%;border:1px solid #ddd;">

                        <form action="{{ route('store.portfolio') }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label"> Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="name" />
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->


                            <div class="row mb-3">
                                <label for="title" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="title" />
                                    @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                            <!-- end row -->


                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label"> Description</label>
                                <div class="col-sm-10">
                                    <textarea id="elm1" name="description"></textarea>
                                    @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                            <!-- end row -->



                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Portfolio Image</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="portfolio_image" id="portfolio_image" />
                                    @error('portfolio_image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg" src="{{ asset('upload/no_image.jpg')}}" alt="Portfolio Image" id="show_image" />
                                </div>
                            </div>
                            <!-- end row -->

                            <input type="submit" value="Insert Portfolio Data" class="btn btn-info waves-effect waves-light" />
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

        $('#portfolio_image').change(function(e) {

            var reader = new FileReader()

            reader.onload = function(e) {
                $('#show_image').attr('src', e.target.result)

            }
            reader.readAsDataURL(e.target.files['0'])
        })


    })

</script>

@endsection
