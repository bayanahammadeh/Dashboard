@extends('layouts.master')

@section('title', ' Dashboard | BAYAN CV')


<!-- Add Modal -->
<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-danger" id="errormsg"></div>
                    <label for="fname">First Name<span style="color:red">*</span></label>
                    <input type="text" class="fname form-control" name="fname" placeholder="enter the first name"
                        required>
                    <label for="lname">Last Name<span style="color:red">*</span></label>
                    <input type="text" class="lname form-control" name="lname" placeholder="enter the last name"
                        required>
                    <label for="title">Title<span style="color:red">*</span></label>
                    <input type="text" class="title form-control" name="title" placeholder="enter the title"
                        required>
                    <label for="description">Description<span style="color:red">*</span></label>
                    <input type="text" class="description form-control" name="description"
                        placeholder="enter the description" required>
                    <label for="email">Email<span style="color:red">*</span></label>
                    <input type="text" class="email form-control" name="email" placeholder="enter the email"
                        required>
                    <label for="mobile">Mobile<span style="color:red">*</span></label>
                    <input type="text" class="mobile form-control" name="mobile" placeholder="enter the mobile"
                        required>
                    <label for="phone">Phone<span style="color:red">*</span></label>
                    <input type="text" class="phone form-control" name="phone" placeholder="enter the phone"
                        required>
                    <label for="address">Address<span style="color:red">*</span></label>
                    <input type="text" class="address form-control" name="address" placeholder="enter the address"
                        required>
                    <label for="file">CV<span style="color:red">*</span></label>
                    <input type="file" class="file form-control" name="file" placeholder="enter the cv pdf"
                        required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="add btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="updateForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-danger" id="errormsg2"></div>
                    <input type="hidden" name="id" id="id">
                    <label for="fname">First Name<span style="color:red">*</span></label>
                    <input type="text" class="fname form-control" name="fname"
                        placeholder="enter the first name" required>
                    <label for="lname">Last Name<span style="color:red">*</span></label>
                    <input type="text" class="lname form-control" name="lname"
                        placeholder="enter the last name" required>
                    <label for="title">Title<span style="color:red">*</span></label>
                    <input type="text" class="title form-control" name="title" placeholder="enter the title"
                        required>
                    <label for="description">Description<span style="color:red">*</span></label>
                    <input type="text" class="description form-control" name="description"
                        placeholder="enter the description" required>
                    <label for="email">Email<span style="color:red">*</span></label>
                    <input type="text" class="email form-control" name="email" placeholder="enter the email"
                        required>
                    <label for="mobile">Mobile<span style="color:red">*</span></label>
                    <input type="text" class="mobile form-control" name="mobile" placeholder="enter the mobile"
                        required>
                    <label for="phone">Phone<span style="color:red">*</span></label>
                    <input type="text" class="phone form-control" name="phone" placeholder="enter the phone"
                        required>
                    <label for="address">Address<span style="color:red">*</span></label>
                    <input type="text" class="address form-control" name="address"
                        placeholder="enter the address" required>
                    <label for="file">CV<span style="color:red">*</span></label>
                    <input type="file" class="file form-control" name="file" placeholder="enter the cv pdf"
                        required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary update">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="alert alert-success" id="success_msg" style="display:none"></div>
            <div class="card-header">
                <h4>Personal<a href="#" id="AddModal" class="btn btn-primary btn-sm float-end"
                        data-bs-toggle="modal" data-bs-target="#AddModal">Add</a></h4>
            </div>
            <br />
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align: center">
                                Name
                            </th>
                            <th style="text-align: center">
                                Title
                            </th>
                            <th style="text-align: center">
                                Description
                            </th>
                            <th style="text-align: center">
                                Email
                            </th>
                            <th style="text-align: center">
                                Mobile
                            </th>
                            <th style="text-align: center">
                                CV
                            </th>
                            <th style="text-align: center">
                                Address
                            </th>
                            <th colspan="2" style="text-align: center">
                                Operation
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        function fetch(url) {
            resetFields();
            var x;
            if (url === "user") {
                x = "none";
            }
            $.ajax({
                type: "GET",
                url: `/` + url + `/fetch-personal`,
                data: "data",
                dataType: "json",
                success: function(response) {
                    $('tbody').html("");
                    $.each(response.data, function(key, item) {
                        $('tbody').append(
                            '<tr>\
                                                                                     <td style="text-align:center;vertical-align: middle;"">' +
                            item
                            .fname + " " +
                            item
                            .lname +
                            '</td>\
                                                                                     <td style="text-align:center;vertical-align: middle;"">' +
                            item
                            .title +
                            '</td>\
                                                                                     <td style="text-align:center;vertical-align: middle;"">' +
                            item
                            .description +
                            '</td>\
                                                                                     <td style="text-align:center;vertical-align: middle;"">' +
                            item
                            .email +
                            '</td>\
                                                                                     <td style="text-align:center;vertical-align: middle;"">' +
                            item
                            .mobile +
                            '</td>\
                                                                                     <td style="text-align:center;vertical-align: middle;""><a href="{{ asset(url('assets/pdf/')) }}/' +
                            item
                            .pdf +
                            '" target="_blank">cv.pdf</a></td>\
                                                                                     <td style="text-align:center;vertical-align: middle;"">' +
                            item
                            .address +
                            '</td>\
                                                                                     <td style="text-align:center;vertical-align: middle;""><button type="button" value="' +
                            item
                            .id +
                            '" class="edit btn btn-success">Edit</button></td>\
                                                                                     <td style="text-align:center;vertical-align: middle;display:' +
                            x +
                            '"><button type="button" value="' +
                            item
                            .id +
                            '" class="del btn btn-danger">Delete</button></td>\
                                                                                                                                     </tr>'
                        );
                    });
                }
            });
        }

        function resetFields() {
            $('#AddModal form')[0].reset();
            $('#EditModal form')[0].reset();
            $("#errormsg").html("");
            $("#errormsg").hide();
            $("#errormsg2").html("");
            $("#errormsg2").hide();
        }

        $(document).ready(function() {
            var url = "{{ $role }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            fetch(url);

            $("#AddModal").on("hidden.bs.modal", function() {
                resetFields();
            });
            $("#EditModal").on("hidden.bs.modal", function() {
                resetFields();
            });

            $('#addForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: `/` + url + `/store-personal`,
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#AddModal').modal('hide');
                        fetch(url);
                        $('#success_msg').show();
                        $('#success_msg').text(response.message);
                    },
                    error: function(response) {
                        var errors = response.responseJSON;
                        var errorsHtml = '';
                        $.each(errors.errors, function(key, value) {
                            errorsHtml += value[0] + '<br>';
                        });
                        $("#errormsg").show();
                        $('#errormsg').html(errorsHtml);
                    }
                });
            });

            $(document).on('click', '.edit', function(e) {
                e.preventDefault();
                $('#updateForm')[0].reset();
                var id = $(this).val();
                $('#EditModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: `/` + url + `/edit-personal` + '/' + id,
                    success: function(response) {
                        $('#id').val(response.personal.id);
                        $('.fname').val(response.personal.fname);
                        $('.lname').val(response.personal.lname);
                        $('.title').val(response.personal.title);
                        $('.email').val(response.personal.email);
                        $('.description').val(response.personal.description);
                        $('.mobile').val(response.personal.mobile);
                        $('.phone').val(response.personal.phone);
                        $('.address').val(response.personal.address);
                    }
                });
            });

            $('#updateForm').on('submit', function(e) {
                e.preventDefault();
                var id = $('#id').val();
                $.ajax({
                    type: 'POST',
                    url: `/` + url + `/update-personal` + '/' + id,
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#EditModal').modal('hide');
                        fetch(url);
                        $('#success_msg').show();
                        $('#success_msg').text(response.message);
                    },
                    error: function(response) {
                        $("#errormsg2").show();
                        var errors = response.responseJSON;
                        var errorsHtml = '';
                        $.each(errors.errors, function(key, value) {
                            errorsHtml += value[0] + '<br>';
                        });
                        $('#errormsg2').html(errorsHtml);
                    }
                });
            });

            $(document).on('click', '.del', function(e) {
                e.preventDefault();
                var id = $(this).val();

                $.ajax({
                    type: 'DELETE',
                    url: `/` + url + `/delete-personal` + '/' + id,
                    dataType: 'json',
                    success: function(response) {
                        fetch(url);
                        $('#success_msg').show();
                        $('#success_msg').text(response.message);
                    }
                })
            });
        });
    </script>
@endsection
