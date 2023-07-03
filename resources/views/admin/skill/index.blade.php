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
            <div class="modal-body">
                <label for="skill_name">Skill Name<span style="color:red">*</span></label>
                <input type="text" class="name form-control" placeholder="enter the skill name" required>
                <label for="percentage">Percentage<span style="color:red">*</span></label>
                <input type="text" class="percentage form-control" placeholder="enter the percentage" required>
                <label for="personal">Personal<span style="color:red">*</span></label>
                <input type="text" class="personal form-control" placeholder="enter the personal" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="add btn btn-primary">Save</button>
            </div>
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
            <div class="modal-body">
                <input type="hidden" id="edit_id">
                <div class="form-group mb-3">
                    <label for="name">Skill Name<span style="color:red">*</span></label>
                    <input type="text" class="name form-control" />
                </div>
                <div class="form-group mb-3">
                    <label for="email">Percentage<span style="color:red">*</span></label>
                    <input type="text" class="percentage form-control" />
                </div>
                <div class="form-group mb-3">
                    <label for="phone">Personal<span style="color:red">*</span></label>
                    <input type="text" class="personal form-control" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary update">Update</button>
            </div>
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
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            fetch();

            function fetch() {
                $.ajax({
                    type: 'GET',
                    url: '{{ url('/admin/fetch-skill') }}',
                    dataType: 'json',
                    success: function(response) {
                        //console.log(response.skills);
                        $('tbody').html("");
                        $.each(response.skills, function(key, item) {
                            $('tbody').append('<tr>\
                                                                                                    <td>' + item.id + '</td>\
                                                                                                    <td>' + item
                                .skill_name + '</td>\
                                                                                                    <td>' + item
                                .percentage + '</td>\
                                                                                                    <td>' + item
                                .personal.fname +
                                '</td>\
                                                                                                    <td><button type="button" value="' +
                                item.id +
                                '"  class="edit btn btn-primary btn-sm">Edit</button></td>\
                                                                                                    <td><button type="button" value="' +
                                item
                                .id + '" class="del btn btn-danger btn-sm">Delete</button></td>\
                                                                                                </tr>');
                        });
                    }
                });
            }

            $('.add').click(function(e) {
                e.preventDefault();
                var data = {
                    'name': $('.name').val(),
                    'percentage': $('.percentage').val(),
                    'personal': $('.personal').val(),
                }
                $.ajax({
                    type: 'POST',
                    url: '{{ url('/admin/add-skill') }}',
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 400) {
                            alert('Be Sure from the entered data');
                        } else {
                            $('#success_msg').show();
                            $('#success_msg').text(response.message);
                            $('#AddModal').modal('hide');
                            $('#AddModal').find('input').val("");
                            fetch();
                        }
                    }
                });
            });

            $(document).on('click', '.edit', function(e) {
                e.preventDefault();
                var id = $(this).val();
                $('#EditModal').modal('show');
                $.ajax({
                    type: 'GET',
                    url: "{{url('/admin/edit-skill')}}"+'/'+id,
                    success: function(response) {
                        if (response.status == 404) {
                            $('#success_msg').show();
                            $('#success_msg').text(response.message);
                        } else {
                            $('#edit_id').val(response.skill.id);
                            $('.name').val(response.skill.skill_name);
                            $('.percentage').val(response.skill.percentage);
                            $('.personal').val(response.skill.personal_id);
                        }
                    }
                })
            });

            $('.update').click(function(e) {
                e.preventDefault();

                var id = $('#edit_id').val();
                var data = {
                    'name': $('.name').val(),
                    'percentage': $('.percentage').val(),
                    'personal': $('.personal').val(),
                }

                $.ajax({
                    type: 'PUT',
                    url: "{{url('/admin/update-skill')}}"+'/'+id,
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 404) {
                            alert('Be Sure from the entered data');
                        } else {
                            $('#EditModal').modal('hide');
                            $('#EditModal').find('input').val("");
                            fetch();
                            $('#success_msg').show();
                            $('#success_msg').text(response.message);
                        }
                    }
                })
            });

            $(document).on('click', '.del', function(e) {
                e.preventDefault();

                var id = $(this).val();

                $.ajax({
                    type: 'DELETE',
                    url: "{{url('/admin/delete-skill')}}"+'/'+id,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 404) {
                            alert('Be Sure from the entered data');
                        } else {
                            fetch();
                        }
                    }
                })
            });
        });
    </script>

@endsection
