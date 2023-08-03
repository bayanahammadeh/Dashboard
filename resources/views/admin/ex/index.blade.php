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
                    <label for="headerr">Header<span style="color:red">*</span></label>
                    <input type="text" id="headerr" name="headerr" class="headerr form-control"
                        placeholder="enter the header" required>
                    <label for="detaill">Detail<span style="color:red">*</span></label>
                    <textarea id="descriptionn" name="descriptionn" class="descriptionn form-control" placeholder="enter the description"
                        required></textarea>
                    <label for="education">Experience<span style="color:red">*</span></label>
                    <select id="addexperienceselect" name="addexperienceselect"
                        class="addexperienceselect form-control"></select>
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
                    <label for="header">Header<span style="color:red">*</span></label>
                    <input type="text" id="header" name="header" class="header form-control"
                        placeholder="enter the header" required>
                    <label for="detail">Detail<span style="color:red">*</span></label>
                    <textarea id="description" name="description" class="description form-control" placeholder="enter the description"
                        required></textarea>
                    <label for="education">Experience<span style="color:red">*</span></label>
                    <select id="updatexperienceselect" name="updatexperienceselect"
                        class="updatexperienceselect form-control"></select>
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
                <h4>Detail<a href="#" class="btn btn-primary btn-sm float-end" id="add-social"
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
                                ID
                            </th>
                            <th style="text-align: center">
                                Education
                            </th>
                            <th style="text-align: center">
                                Name
                            </th>
                            <th style="text-align: center">
                                Detail
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
                url: `/` + url + `/fetch-ex`,
                dataType: 'json',
                success: function(response) {
                    $('tbody').html("");
                    $.each(response.exs, function(key, item) {
                        $('tbody').append(
                            '<tr>\
                                                                                                                                                                            <td style="text-align:center;vertical-align: middle;"">' +
                            item
                            .id +
                            '</td>\
                                                                            <td style="text-align:center;vertical-align: middle;"">' +
                            item
                            .experience.period +
                            '</td>\
                                                                            <td style="text-align:center;vertical-align: middle;"">' +
                            item
                            .job_header +
                            '</td>\
                                                                     <td style="text-align:center;vertical-align: middle;"">' +
                            item.description +
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
                    $('#addexperienceselect')
                        .empty()
                        .append('<option selected="selected" value="...">...</option>');
                    $('#updatexperienceselect')
                        .empty()
                        .append('<option selected="selected" value="...">...</option>');
                    $.each(response.experiences, function(key, item) {
                        $('#addexperienceselect')
                            .append($("<option name='experience' id='experience'></option>")
                                .attr("id", item.id)
                                .text(item.period));
                        $('#updatexperienceselect')
                            .append($("<option name='experience' id='experience'></option>")
                                .attr("id", item.id)
                                .text(item.period));
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
                    'header': $('.headerr').val(),
                    'description': $('.descriptionn').val(),
                    'experience': $("#addexperienceselect option:selected").attr("id"),
                }
                $.ajax({
                    type: 'POST',
                    url: `/` + url + `/add-ex`,
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
                $('#updateForm')[0].reset();
                var id = $(this).val();

                $('#EditModal').modal('show');
                $.ajax({
                    type: 'GET',
                    url: `/` + url + `/edit-ex` + '/' + id,
                    success: function(response) {
                        $('#edit_id').val(response.ex.id);
                        $('.header').val(response.ex.job_header);
                        $('.description').val(response.ex.description);
                        $("#updatexperienceselect").val(response.ex.experience.period);
                    }
                })
            });

            $('.update').click(function(e) {
                e.preventDefault();

                var data = {
                    'header': $('.header').val(),
                    'description': $('.description').val(),
                    'experience': $("#updatexperienceselect option:selected").attr("id"),
                }
                var id = $('#edit_id').val();
                $.ajax({
                    type: 'POST',
                    url: `/` + url + `/update-ex` + '/' + id,
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
                    url: `/` + url + `/delete-ex` + '/' + id,
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
