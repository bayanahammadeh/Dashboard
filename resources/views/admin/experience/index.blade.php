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
                    <label for="period">Period<span style="color:red">*</span></label>
                    <input type="text" id="periodd" name="periodd" class="periodd form-control"
                        placeholder="enter the period" required>
                    <label for="personal">Personal<span style="color:red">*</span></label>
                    <select id="addpersonalselect" name="addpersonalselect"
                        class="addpersonalselect form-control"></select>
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
                    <label for="period">Period<span style="color:red">*</span></label>
                    <input type="text" class="period form-control" id="period" name="period"
                        placeholder="enter the  name" required>
                    <label for="personal">Personal<span style="color:red">*</span></label>
                    <select id="updatepersonalselect" name="updatepersonalselect"
                        class="updatepersonalselect  form-control"></select>
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
                <h4>Experience<a href="#" class="btn btn-primary btn-sm float-end" id="add-period"
                        data-bs-toggle="modal" data-bs-target="#AddModal">Add</a>
                </h4>
            </div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align: center">
                                Period
                            </th>
                            <th style="text-align: center">
                                personal
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
            if (url == "user") {
                x = "none";
            }

            $.ajax({
                type: 'GET',
                url: `/` + url + `/fetch-experience`,
                dataType: 'json',
                success: function(response) {
                    $('tbody').html("");
                    $.each(response.experiences, function(key, item) {
                        $('tbody').append(
                            '<tr>\
                                                                        <td style="text-align:center;vertical-align: middle;"">' +
                            item
                            .period +
                            '</td>\
                                                                 <td style="text-align:center;vertical-align: middle;"">' +
                            item.personal.fname + " " + item.personal.lname +
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
                    $('#addpersonalselect')
                        .empty()
                        .append('<option selected="selected" value="...">...</option>');
                    $('#updatepersonalselect')
                        .empty()
                        .append('<option selected="selected" value="...">...</option>');
                    $.each(response.personals, function(key, item) {
                        $('#addpersonalselect')
                            .append($("<option name='personal' id='personal'></option>")
                                .attr("id", item.id)
                                .text(item.fname + " " + item.lname));
                        $('#updatepersonalselect')
                            .append($("<option name='personal' id='personal'></option>")
                                .attr("id", item.id)
                                .text(item.fname + " " + item.lname));
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
                var data = {
                    'period': $('.periodd').val(),
                    'personal': $("#addpersonalselect option:selected").attr("id"),
                }
                $.ajax({
                    type: 'POST',
                    url: `/` + url + `/add-experience`,
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
            });

            $(document).on('click', '.edit', function(e) {
                e.preventDefault();
                var url = "{{ $role }}";
                $('#updateForm')[0].reset();
                var id = $(this).val();

                $('#EditModal').modal('show');
                $.ajax({
                    type: 'GET',
                    url: `/` + url + `/edit-experience` + '/' + id,
                    success: function(response) {
                        $('#edit_id').val(response.experience.id);
                        $('.period').val(response.experience.period);
                        $("#updatepersonalselect").val(response.experience.personal.fname +
                            " " +
                            response.experience.personal.lname);
                    }
                })
            });

            $('.update').click(function(e) {
                e.preventDefault();

                var data = {
                    'period': $('.period').val(),
                    'personal': $("#updatepersonalselect option:selected").attr("id"),
                }
                var id = $('#edit_id').val();
                $.ajax({
                    type: 'POST',
                    url: `/` + url + `/update-experience` + '/' + id,
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
                })
            });

            $(document).on('click', '.del', function(e) {
                e.preventDefault();

                var id = $(this).val();

                $.ajax({
                    type: 'DELETE',
                    url: `/` + url + `/delete-experience` + '/' + id,
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
