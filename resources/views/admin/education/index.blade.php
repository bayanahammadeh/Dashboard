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
                    <label for="education_name">Education Name<span style="color:red">*</span></label>
                    <input type="text" class="education_name form-control" id="education_name" name="education_name" placeholder="enter the education" required>
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
                    <input type="hidden" id="edit_id">
                    <div class="form-group mb-3">
                        <label for="education_namee">Education Name<span style="color:red">*</span></label>
                        <input type="text" id="education_namee" name="education_namee" class="education_namee form-control" />
                    </div>
                    <div class="form-group mb-3">
                        <label for="personalselect2">Personal<span style="color:red">*</span></label>
                        <select name="personalselect2" id="personalselect2"
                            class="personalselect2 form-control">
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
                <h4>Skill<a href="#" class="btn btn-primary btn-sm float-end" id="add-education" data-bs-toggle="modal"
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
        function fetch() {
            $('#AddModal form')[0].reset();
            $('#EditModal form')[0].reset();

            $.ajax({
                type: 'GET',
                url: "{{ url('/admin/fetch-education') }}",
                dataType: 'json',
                success: function(response) {
                    $('tbody').html("");
                    $.each(response.educations, function(key, item) {
                        $('tbody').append(
                            '<tr>\
                                                                                                                                                <td style="text-align:center">' +
                            item
                            .id +
                            '</td>\
                                                <td style="text-align:center;vertical-align: middle;"">' +
                            item
                            .education_name +
                            '</td>\
                                                <td style="text-align:center;vertical-align: middle;"">' +
                            item.personal.fname + " " + item.personal.lname +
                            '</td>\
                                                <td style="text-align:center;vertical-align: middle;""><button type="button" value="' +
                            item.id +
                            '"  class="edit btn btn-primary btn-sm">Edit</button></td>\
                                                <td style="text-align:center;vertical-align: middle;""><button type="button" value="' +
                            item
                            .id +
                            '" class="del btn btn-danger btn-sm">Delete</button></td>\
                                                                                                                                            </tr>'
                        );
                    });
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


        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            fetch();

            $('.add').click(function(e) {
                e.preventDefault();
                var data = {
                    'education_name': $('.education_name').val(),
                    'personal': $("#personalselect option:selected").attr("id"),
                }
                $.ajax({
                    type: 'POST',
                    url: "{{ url('/admin/add-education') }}",
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        $('#success_msg').show();
                        $('#success_msg').text(response.message);
                        $('#AddModal').modal('hide');
                        fetch();
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
                    url: "{{ url('/admin/edit-education') }}" + '/' + id,
                    success: function(response) {
                        $('#edit_id').val(response.education.id);
                        $('#education_namee').val(response.education.education_name);
                        $("#personalselect2").val(response.education.personal.fname+" "+response.education.personal.lname);
                    }
                })
            });

            $('.update').click(function(e) {
                e.preventDefault();

                var id = $('#edit_id').val();
                var data = {
                    'education_name': $('#education_namee').val(),
                    'personal': $("#personalselect2 option:selected").attr("id"),
                }

                $.ajax({
                    type: 'POST',
                    url: "{{ url('/admin/update-education') }}" + '/' + id,
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        $('#EditModal').modal('hide');
                        fetch();
                        $('#success_msg').show();
                        $('#success_msg').text(response.message);
                    }
                })
            });

            $(document).on('click', '.del', function(e) {
                e.preventDefault();

                var id = $(this).val();

                $.ajax({
                    type: 'DELETE',
                    url: "{{ url('/admin/delete-education') }}" + '/' + id,
                    dataType: 'json',
                    success: function(response) {
                        fetch();
                    }
                })
            });
        });
    </script>
@endsection
