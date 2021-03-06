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

                        <form action="{{ route('store.category') }}" method="POST" id="myForm">

                            @csrf
                            <div class="row mb-3">
                                <label for="category" class="col-sm-2 col-form-label"> Blog Category</label>
                                <div class=" form-group col-sm-10">
                                    <input class="form-control" type="text" name="category" />
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

{{-- Validate Input Fields --}}

@section('scripts')
<script>
    $(document).ready(function() {

        $('#myForm').validate({
            rules: {
                category: {
                    required: true
                } // Multiple fields use comma
            }
            , messages: {
                category: {
                    required: 'Please Enter Blog Category'
                }
            },

            errorElement: 'span'
            , errorPlacement: function(error, element) {
                error.addClass('invalid-feedback')
                element.closest('.form-group').append(error)

            },

            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid')
            }
            , unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid')
            },

        })
    })

</script>

@endsection
