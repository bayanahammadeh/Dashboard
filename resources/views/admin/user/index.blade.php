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
            <form id="addForm">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-danger" id="errormsg"></div>
                    <label for="namee">Name<span style="color:red">*</span></label>
                    <input type="text" id="namee" name="namee" class="namee form-control"
                        placeholder="enter the name" required>
                    <label for="emaill">Email<span style="color:red">*</span></label>
                    <input type="text" id="emaill" name="emaill" class="emaill form-control"
                        placeholder="enter the email" required>
                    <label for="pass">Password<span style="color:red">*</span></label>
                    <input type="password" id="pass" name="pass" class="pass form-control"
                        placeholder="enter the password" required>
                    <label for="cpass">Confirm Password<span style="color:red">*</span></label>
                    <input type="password" id="cpass" name="cpass" class="cpass form-control"
                        placeholder="confirm the password" required>
                    <label for="role">Role<span style="color:red">*</span></label>
                    <select id="addroleselectt" name="addroleselectt" class="addroleselectt form-control"></select>
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
            <form id="updateForm">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-danger" id="errormsg2"></div>
                    <input type="hidden" id="edit_id">
                    <label for="name">Name<span style="color:red">*</span></label>
                    <input type="text" id="name" name="name" class="name form-control"
                        placeholder="enter the name" required>
                    <label for="email">Email<span style="color:red">*</span></label>
                    <input type="text" id="email" name="email" class="email form-control"
                        placeholder="enter the email" required>
                    <label for="pass">Password<span style="color:red">*</span></label>
                    <input type="password" id="pas" name="pas" class="pas form-control"
                        placeholder="enter the password" required>
                    <label for="cpass">Confirm Password<span style="color:red">*</span></label>
                    <input type="password" id="cpas" name="cpas" class="cpas form-control"
                        placeholder="confirm the password" required>
                    <label for="role">Role<span style="color:red">*</span></label>
                    @if ($role == 'supper')
                        <select id="addroleselect" name="addroleselect" class="addroleselect form-control"></select>
                    @else
                        <select id="addroleselect" name="addroleselect" class="addroleselect form-control"
                            disabled></select>
                    @endif
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
                <h4>User<a href="#" class="btn btn-primary btn-sm float-end" id="add-user" data-bs-toggle="modal"
                        data-bs-target="#AddModal">Add</a>
                </h4>
            </div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert" id="status" name="status">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align: center">
                                Name
                            </th>
                            <th style="text-align: center">
                                Email
                            </th>
                            <th style="text-align: center">
                                is_Admin
                            </th>
                            <th style="text-align: center" colspan="2">
                                operation
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
            if (url == "admin") {
                x = "none";
            }

            $.ajax({
                type: 'GET',
                url: `/` + url + `/fetch-user`,
                dataType: 'json',
                success: function(response) {
                    $('tbody').html("");
                    $.each(response.users, function(key, item) {
                        if ((item.role_as == "1") || (item.role_as == "2"))
                            check =
                            '<input class="form-check-input" type="checkbox"  disabled checked>';
                        else
                            check =
                            '<input class="form-check-input" type="checkbox"  disabled>';

                        $('tbody').append(
                            '<tr>\
                                                                                        <td style="text-align:center;vertical-align: middle;"">' +
                            item
                            .name +
                            '</td>\
                                                                                        <td style="text-align:center;vertical-align: middle;"">' +
                            item
                            .email +
                            '</td>\
                                                                                 <td style="text-align:center;vertical-align: middle;"">' +
                            check +
                            '</td>\
                                                                                        <td style="text-align:center;vertical-align: middle;""><button type="button" value="' +
                            item.id +
                            '"  class="edit btn btn-primary btn-sm">Edit</button></td>\
                                                                                        <td style="text-align:center;vertical-align: middle;display:' +
                            x + '"><button type="button" value="' +
                            item
                            .id +
                            '" class="del btn btn-danger btn-sm">Delete</button></td>\
                                                                                                                                                                                    </tr>'
                        );
                    });
                    $('#addroleselectt')
                        .empty()
                        .append('<option selected="selected" value="...">...</option>');
                    $('#addroleselect')
                        .empty()
                        .append('<option selected="selected" value="...">...</option>');
                    $.each(response.roles, function(key, item) {
                        $('#addroleselectt')
                            .append($("<option name='role' id='role'></option>")
                                .attr("id", item.id)
                                .text(item.role_name));
                        $('#addroleselect')
                            .append($("<option name='role' id='role'></option>")
                                .attr("id", item.id)
                                .text(item.role_name));
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

        $(document).ready(function(e) {
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

            $('.add').click(function(e) {
                e.preventDefault();
                if ($('#pass').val() == $('#cpass').val()) {
                    var data = {
                        'name': $('.namee').val(),
                        'role_as': $("#addroleselectt option:selected").attr("id"),
                        'email': $('.emaill').val(),
                        'password': $('.pass').val(),
                    }
                    $.ajax({
                        type: 'POST',
                        url: `/` + url + `/store-user`,
                        data: data,
                        dataType: 'json',
                        success: function(response) {
                            $('#success_msg').show();
                            $('#success_msg').text(response.message);
                            $('#AddModal').modal('hide');
                            fetch(url);
                        },
                        error: function(response) {
                            $("#errormsg").show();
                            var errors = response.responseJSON;
                            var errorsHtml = '';
                            $.each(errors.errors, function(key, value) {
                                errorsHtml += value[0] + '<br>';
                            });
                            $('#errormsg').html(errorsHtml);
                        }
                    });
                } else {
                    $('#success_msg').show();
                    $('#success_msg').text('Password Not Matching');
                    $('#AddModal').modal('hide');
                }
            });

            $(document).on('click', '.edit', function(e) {
                e.preventDefault();
                $('#updateForm')[0].reset();
                var id = $(this).val();

                $('#EditModal').modal('show');
                $.ajax({
                    type: 'GET',
                    url: `/` + url + `/edit-user` + '/' + id,
                    success: function(response) {
                        $('#edit_id').val(response.user.id);
                        $('.name').val(response.user.name);
                        $('.email').val(response.user.email);
                        $("#addroleselect").val(response.user.role.role_name);
                    }
                })
            });

            $('.update').click(function(e) {
                e.preventDefault();
                if ($('#pas').val() == $('#cpas').val()) {
                    var data = {
                        'name': $('.name').val(),
                        'role_as': $("#addroleselect option:selected").attr("id"),
                        'email': $('.email').val(),
                        'password': $('.pas').val(),
                    }
                    var id = $('#edit_id').val();
                    $.ajax({
                        type: 'POST',
                        url: `/` + url + `/update-user` + '/' + id,
                        data: data,
                        dataType: 'json',
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
                } else {
                    $('#success_msg').show();
                    $('#success_msg').text('Password Not Matching');
                    $('#EditModal').modal('hide');
                }
            });

            $(document).on('click', '.del', function(e) {
                e.preventDefault();

                var id = $(this).val();

                $.ajax({
                    type: 'DELETE',
                    url: `/` + url + `/delete-user` + '/' + id,
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
