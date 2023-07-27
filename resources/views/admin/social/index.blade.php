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
                    <label for="namee">Name<span style="color:red">*</span></label>
                    <input type="text" id="namee" name="namee" class="namee form-control"
                        placeholder="enter the name" required>
                    <label for="urll">URL<span style="color:red">*</span></label>
                    <input type="text" id="urll" name="urll" class="urll form-control"
                        placeholder="enter the url" required>
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
                    <input type="hidden" id="edit_id">
                    <label for="name">Name<span style="color:red">*</span></label>
                    <input type="text" id="name" name="name" class="name form-control"
                        placeholder="enter the name" required>
                    <label for="url">URL<span style="color:red">*</span></label>
                    <input type="text" class="url form-control" id="url" name="url"
                        placeholder="enter the url" required>
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
                <h4>Social<a href="#" class="btn btn-primary btn-sm float-end" id="add-social" data-bs-toggle="modal"
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
                                URL
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
            $('#AddModal form')[0].reset();
            $('#EditModal form')[0].reset();

            var x;

            if (url == "user") {
                x = "none";
            }


            $.ajax({
                type: 'GET',
                //url: "{{ url('/admin/fetch-social') }}",
                url: `/` + url + `/fetch-social`,
                dataType: 'json',
                success: function(response) {
                    $('tbody').html("");
                    $.each(response.socials, function(key, item) {
                        $('tbody').append(
                            '<tr>\
                                                                                                                                                                    <td style="text-align:center;vertical-align: middle;"">' +
                            item
                            .id +
                            '</td>\
                                                                    <td style="text-align:center;vertical-align: middle;"">' +
                            item
                            .name +
                            '</td>\
                                                                    <td style="text-align:center;vertical-align: middle;"">' +
                            item
                            .url +
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

        $(document).ready(function(e) {
            var url = "{{ $role }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            fetch(url);

            $('.add').click(function(e) {
                e.preventDefault();
                var data = {
                    'name': $('.namee').val(),
                    'url': $('.urll').val(),
                    'personal': $("#addpersonalselect option:selected").attr("id"),
                }
                $.ajax({
                    type: 'POST',
                    //url: "{{ url('/admin/add-social') }}",
                    url: `/` + url + `/add-social`,
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        $('#success_msg').show();
                        $('#success_msg').text(response.message);
                        $('#AddModal').modal('hide');
                        fetch(url);
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
                    //url: "{{ url('/admin/edit-social') }}" + '/' + id,
                    url: `/` + url + `/edit-social` + '/' + id,
                    success: function(response) {
                        $('#edit_id').val(response.social.id);
                        $('.name').val(response.social.name);
                        $('.url').val(response.social.url);
                        $("#updatepersonalselect").val(response.social.personal.fname + " " +
                            response.social.personal.lname);
                    }
                })
            });

            $('.update').click(function(e) {
                e.preventDefault();

                var data = {
                    'name': $('.name').val(),
                    'url': $('.url').val(),
                    'personal': $("#updatepersonalselect option:selected").attr("id"),
                }
                var id = $('#edit_id').val();
                $.ajax({
                    type: 'POST',
                    //url: "{{ url('/admin/update-social') }}" + '/' + id,
                    url: `/` + url + `/update-social` + '/' + id,
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        $('#EditModal').modal('hide');
                        fetch(url);
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
                    //url: "{{ url('/admin/delete-social') }}" + '/' + id,
                    url: `/` + url + `/delete-social` + '/' + id,
                    dataType: 'json',
                    success: function(response) {
                        fetch(url);
                    }
                })
            });
        });
    </script>
@endsection
