<!-- Edit Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">Profile</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="alert alert-success" id="profile_msg" style="display:none"></div>
            <form id="profileForm">
                @csrf
                <div class="modal-body">
                    <label for="name">Name<span style="color:red">*</span></label>
                    <input type="text" id="namepro" name="namepro" class="namepro form-control"
                        placeholder="enter the name" required disabled>
                    <label for="email">Email<span style="color:red">*</span></label>
                    <input type="text" id="emailpro" name="emailpro" class="emailpro form-control"
                        placeholder="enter the email" required disabled>
                    <label for="pass">Password<span style="color:red">*</span></label>
                    <input type="password" id="paspro" name="paspro" class="paspro form-control"
                        placeholder="enter the password" required>
                    <label for="cpass">Confirm Password<span style="color:red">*</span></label>
                    <input type="password" id="cpaspro" name="cpaspro" class="cpaspro form-control"
                        placeholder="confirm the password" required>
                    <label for="role">Role<span style="color:red">*</span></label>
                    <input type="text" id="role" name="rolepro" class="rolepro form-control" disabled>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary updatepro">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="#"> Dashboard | BAYAN CV</a>

    <ul class="navbar-nav d-none d-md-inline-block form-inline ms-auto me-0    my-2 my-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" id="profile" data-bs-toggle="modal"
                        data-bs-target="#profileModal">Profile</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
            </ul>
        </li>
    </ul>
    <a href="{{ url($role.'/contact') }}" class="notification me-md-3">
        <span class="fa fa-bell">Inbox</span>
        <span class="badge" id="msgcount"></span>
    </a>
</nav>


<script>
    function notiy(value) {
        $("#msgcount").text(value);
      }

    $(document).ready(function(e) {
        var idpro = "{{ $id }}";
        var urlpro = "{{ $role }}";
        var permpro = "{{ $perm }}";
        var notification = "{{ $count }}";

        notiy(notification);


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#profile').click(function(e) {

            e.preventDefault();

            $('#profileForm')[0].reset();
            $('#profileModal').modal('show');
            $.ajax({
                type: 'GET',
                url: `/` + urlpro + `/profile` + '/' + idpro,
                success: function(response) {
                    $('.namepro').val(response.user.name);
                    $('.emailpro').val(response.user.email);
                    $(".rolepro").val(response.user.role.role_name);
                }
            })
        });


        $('.updatepro').click(function(e) {
            e.preventDefault();
            if ($('#paspro').val() == $('#cpaspro').val()) {
                var data = {
                    'name': $('.namepro').val(),
                    'email': $('.emailpro').val(),
                    'password': $('.paspro').val(),
                    'role_as': permpro,
                }

                $.ajax({
                    type: 'POST',
                    url: `/` + urlpro + `/update-profile` + '/' + idpro,
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        $('#profile_msg').show();
                        $('#profile_msg').text(response.message);
                    }
                });
            } else {
                $('#profile_msg').show();
                $('#profile_msg').text('Password Not Matching');
            }
        });
    });
</script>
