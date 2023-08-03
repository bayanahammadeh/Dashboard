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
            <form id="addform">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-danger" id="errormsg"></div>
                    <label for="skill_name">Skill Name<span style="color:red">*</span></label>
                    <input type="text" class="name form-control" placeholder="enter the skill name" required>
                    <label for="percentage">Percentage<span style="color:red">*</span></label>
                    <input type="number" class="percentage form-control" placeholder="enter the percentage"
                        min="0" max="100" required>
                    <label for="personal">Personal<span style="color:red">*</span></label>
                    <select name="personalselect" id="personalselect" class="personalselect form-control"></select>
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
            <form id="editform">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-danger" id="errormsg2"></div>
                    <input type="hidden" id="edit_id">
                    <div class="form-group mb-3">
                        <label for="name">Skill Name<span style="color:red">*</span></label>
                        <input type="text"id="name" class="name form-control" required />
                    </div>
                    <div class="form-group mb-3">
                        <label for="percentage">Percentage<span style="color:red">*</span></label>
                        <input type="number" id="percentage" min="0" max="100" required
                            class="percentage form-control" />
                    </div>
                    <div class="form-group mb-3">
                        <label for="personalselect2">Personal<span style="color:red">*</span></label>
                        <select name="personalselect2" id="personalselect2" class="personalselect2 form-control">
                        </select>
                    </div>
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
                <h4>Skill<a href="#" class="btn btn-primary btn-sm float-end" id="add-skill" data-bs-toggle="modal"
                        data-bs-target="#AddModal">Add</a>
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
                                Name
                            </th>
                            <th style="text-align: center">
                                percentage
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
        function fetch(url, links) {
            resetFields();
            var x;
            if (url == "user") {
                x = "none";
            }

            $.ajax({
                type: 'GET',
                url: `/` + url + `/fetch-skill`,
                dataType: 'json',
                success: function(response) {
                    $('tbody').html("");
                    $.each(response.skills, function(key, item) {
                        $('tbody').append(
                            '<tr>\
                                                                                                                                                        <td style="text-align:center">' +
                            item
                            .id +
                            '</td>\
                                                        <td style="text-align:center;vertical-align: middle;"">' +
                            item
                            .skill_name +
                            '</td>\
                                                        <td style="text-align:center;vertical-align: middle;"">' +
                            item
                            .percentage +
                            '</td>\
                                                        <td style="text-align:center;vertical-align: middle;"">' +
                            item.personal.fname + " " + item.personal.lname +
                            '</td>\
                                                        <td style="text-align:center;vertical-align: middle;""><button type="button" value="' +
                            item.id +
                            '"  class="edit btn btn-primary btn-sm">Edit</button></td>\
                                                        <td style="text-align:center;vertical-align: middle;display:' + x +
                            '"><button type="button" value="' +
                            item
                            .id +
                            '" class="del btn btn-danger btn-sm">Delete</button></td>\
                                                                                                                                                    </tr>'
                        );
                    });
                    $('#personalselect')
                        .empty()
                        .append('<option selected="selected" value="...">...</option>');
                    $('#personalselect2')
                        .empty()
                        .append('<option selected="selected" value="...">...</option>');
                    $.each(response.personals, function(key, item) {
                        $('#personalselect')
                            .append($("<option></option>")
                                .attr("id", item.id)
                                .text(item.fname + " " + item.lname));
                        $('#personalselect2')
                            .append($("<option></option>")
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
                    'name': $('.name').val(),
                    'percentage': $('.percentage').val(),
                    'personal': $("#personalselect option:selected").attr("id"),
                }
                $.ajax({
                    type: 'POST',
                    url: `/` + url + `/add-skill`,
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
                $('#editform')[0].reset();
                var id = $(this).val();

                $('#EditModal').modal('show');
                $.ajax({
                    type: 'GET',
                    url: `/` + url + `/edit-skill` + '/' + id,
                    success: function(response) {
                        $('#edit_id').val(response.skill.id);
                        $('.name').val(response.skill.skill_name);
                        $('.percentage').val(response.skill.percentage);
                        $("#personalselect2").val(response.skill.personal.fname + " " + response
                            .skill.personal.lname);
                    }
                })
            });

            $('.update').click(function(e) {
                e.preventDefault();

                var id = $('#edit_id').val();
                var data = {
                    'name': $('#name').val(),
                    'percentage': $('#percentage').val(),
                    'personal': $("#personalselect2 option:selected").attr("id"),
                }

                $.ajax({
                    type: 'POST',
                    url: `/` + url + `/update-skill` + '/' + id,
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
                    url: `/` + url + `/delete-skill` + '/' + id,
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
