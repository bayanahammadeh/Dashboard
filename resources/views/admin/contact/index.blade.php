@extends('layouts.master')

@section('title', ' Dashboard | BAYAN CV')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="alert alert-success" id="success_msg" style="display:none"></div>
            <div class="card-header">
                <h4>Contact</h4>
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
                                Contact
                            </th>
                            <th style="text-align: center">
                                Subject
                            </th>
                            <th style="text-align: center">
                                Email
                            </th>
                            <th style="text-align: center">
                                Message
                            </th>
                            <th style="text-align: center">
                                Status
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
            var x;

            $.ajax({
                type: 'GET',
                url: `/` +url + `/fetch-contact`,
                dataType: 'json',
                success: function(response) {
                    $('tbody').html("");
                    $.each(response.contacts, function(key, item) {
                        if (item.status == "1")
                            check =
                            '<div class="form-check form-switch"><input class="form-check-input" type="checkbox" role="switch"  id="flexSwitchCheckChecked" checked disabled></div>';
                        else
                            check =
                            '<div class="form-check form-switch"><input class="edit form-check-input" type="checkbox" value="' +
                            item.id +
                            '" role="switch" id="flexSwitchCheckChecked"></div>';
                        $('tbody').append(
                            '<tr>\
                                                                                                                                                                            <td style="text-align:center;vertical-align: middle;"">' +
                            item
                            .id +
                            '</td>\
                                                                            <td style="text-align:center;vertical-align: middle;"">' +
                            item
                            .recuriname +
                            '</td>\
                                                                            <td style="text-align:center;vertical-align: middle;"">' +
                            item
                            .subject +
                            '</td>\
                                                                     <td style="text-align:center;vertical-align: middle;"">' +
                            item.email +
                            '</td>\
                                                                     <td style="text-align:center;vertical-align: middle;"">' +
                            item.msg +
                            '</td>\
                                                                     <td style="text-align:center;vertical-align: middle;"">' +
                            check +
                            '</td>\
                                                                                                                                                                        </tr>'
                        );
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

            $(document).on('click', '.edit', function(e) {
                var id = $(this).val();
                //alert(id);

                $.ajax({
                    type: 'POST',
                    url: `/` +url + `/update-contact` + '/' + id,
                    dataType: 'json',
                    success: function(response) {
                        fetch(url);
                        $('#flexSwitchCheckChecked').attr('checked', 'checked');
                        $('#flexSwitchCheckChecked').prop('disabled', true);
                        window.location.reload();
                    }
                })
            });
        });
    </script>
@endsection
