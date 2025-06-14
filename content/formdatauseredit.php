<?php
if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    // Gunakan $userId untuk melakukan query atau mengirim request ke API
} else {
    echo "ID user tidak ditemukan!";
}
?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <div class="topbar-divider d-none d-sm-block"></div>
                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['username']; ?></span>
                        <img class="img-profile rounded-circle"
                            src="img/undraw_profile.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="profile.php">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3" style=" display:flex; align-items: center; justify-content: space-between;">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Data User</h6>
                </div>
                <div style=" margin: 20px;" id="formContent">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="username">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" placeholder="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="text" class="form-control" id="newpassword" placeholder="new password">
                    </div>
                    <button type="submit" id="submitBtn">Save</button>

                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
    <script>
        const userId = <?= json_encode($userId); ?>;

        // Ambil data user berdasarkan ID
        $.ajax({
            url: `http://localhost:1337/api/users/${userId}`,
            method: 'GET',
            headers: {
                Authorization: 'Bearer ' + localStorage.getItem('token'),
            },
            success: function(response) {
                // Isi form dengan data user
                $('#username').val(response.username);
                $('#email').val(response.email);
                $('#newpassword').val("");
            },
            error: function(error) {
                alert('Gagal mengambil data user!');
                console.error(error);
            },
        });
    </script>


    <script>
        $(document).ready(function() {
            $('#submitBtn').click(function() {
                var username = $('#username').val();
                var email = $('#email').val();
                var newpassword = $('#newpassword').val();
                let reqBody ;
                if(newpassword != ""){
                    reqBody = {
                            "username": username,
                            "email": email,
                            "password": newpassword
                    }
                }else{
                    reqBody = {
                        "username": username,
                        "email": email
                    }
                }
                if (userId) {
                    // PUT request untuk update user
                    $.ajax({
                        url: `http://localhost:1337/api/users/${userId}`,
                        method: 'PUT',
                        headers: {
                            Authorization: 'Bearer ' + localStorage.getItem('token'),
                            'Content-Type': 'application/json',
                        },
                        data: JSON.stringify(reqBody),
                        success: function(result) {
                            alert("Data berhasil diperbarui!");
                            window.location.href = "http://127.0.0.1/ummi/fe/datauser.php";
                        },
                        error: function(xhr, status, error) {
                            alert("Gagal memperbarui data!");
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    alert("user ID tidak ditemukan, tidak dapat memperbarui data!");
                }
            });

        });
    </script>
