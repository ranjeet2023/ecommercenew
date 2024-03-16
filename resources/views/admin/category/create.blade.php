@extends('admin.layouts.appdashboard')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Category</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ url('admin/getCategory') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="container-fluid">
                <form action="javascript:void(0)" class="add_category" method="POST">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Name">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="slug">Slug</label>
                                        <input type="text" name="slug" @readonly(true) id="slug"
                                            class="form-control" placeholder="Slug">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="status">Status</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="">Select Option</option>
                                            <option value="1">Active</option>
                                            <option value="0">InActive</option>
                                        </select>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pb-5 pt-3">
                        <button class="btn btn-primary" type="submit" id="submitBtn">Create</button>
                        <a href="brands.html" class="btn btn-outline-dark ml-3">Cancel</a>
                    </div>
                </form>

            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('customJs')
    <script>
        $(document).ready(function() {
            // $('#add_category_form').submit(function(event) {
            $('.add_category').on('click', '#submitBtn', function(event) {
                event.preventDefault();
                // var formData = $(this).serialize();
                var name = $('#name').val();
                var slug = $('#slug').val();
                var status = $('#status').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $("button[type=submit]").prop('disabled', true);
                $.ajax({
                    type: "POST",
                    url: "/admin/create-category",
                    data: {
                        name: name,
                        slug: slug,
                        status: status
                    },
                    dataType: "json",
                    success: function(response) {
                        $("button[type=submit]").prop('disabled', false);
                        var errors = response['errors'];
                        console.log(errors);
                        if (response['status'] == false) {
                            if (errors['name']) {
                                $('#name').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback').html(errors['name']);
                            } else {
                                $('#name').removeClass('is-invalid').siblings('p')
                                    .removeClass(
                                        'invalid-feedback').html("");
                            }
                            if (errors['slug']) {
                                $('#slug').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback').html(errors['slug']);
                            } else {
                                $('#slug').removeClass('is-invalid').siblings('p')
                                    .removeClass(
                                        'invalid-feedback').html("");
                            }
                            if (errors['status']) {
                                $('#status').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback').html(errors['status']);
                            } else {
                                $('#status').removeClass('is-invalid').siblings('p')
                                    .removeClass(
                                        'invalid-feedback').html("");
                            }
                        } else {
                            window.location.href = `{{ url('admin/getCategory') }}`
                        }
                    }
                });

            });
            $('#name').change(function() {
                var name = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "/admin/getSlug",
                    data: {
                        name: name,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status == true) {
                            $('#slug').val(response.slug);
                        }
                    }
                })
            })
        });
    </script>
@endsection
