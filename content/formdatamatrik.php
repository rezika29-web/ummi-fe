
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
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Data Matrik</h6>
                </div>
                <div style=" margin: 20px;">
                    <form id="formSearchData">
                    <div class="mb-3">
                        <label class="form-label" for="username">Select Data User</label>
                        <select class="form-control" id="username">
                        </select>
                    </div>
                       <button type="submit">Hitung</button>
                    </form>

                    <form id="formContent">
                    <input type="text" class="form-control" id="iduser" placeholder="iduser" hidden>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="namauser" placeholder="nama" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Penghasilan</label>
                        <input type="text" class="form-control" id="c1" placeholder="c1" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Kondisi Rumah</label>
                        <input type="text" class="form-control" id="c2" placeholder="c2" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Tanggungan</label>
                        <input type="text" class="form-control" id="c3" placeholder="c3" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Lansia</label>
                        <input type="text" class="form-control" id="c4" placeholder="c4" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Ibu Hamil</label>
                        <input type="text" class="form-control" id="c5" placeholder="c5" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Disabilitas</label>
                        <input type="text" class="form-control" id="c6" placeholder="c6" readonly>
                    </div>
                       <button type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->

<script>
    $(document).ready(function () {
        document.getElementById('formContent').addEventListener('submit', async function(e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData();

        // Ambil data dari form
        let iduser = form.iduser.value
        let c1 = form.c1.value
        let c2 = form.c2.value
        let c3 = form.c3.value
        let c4 = form.c4.value
        let c5 = form.c5.value
        let c6 = form.c6.value
        formData.append('data', JSON.stringify({ "users_permissions_user" : iduser, "penghasilan": c1, "kondisi_rumah": c2, "tanggungan": c3, "lansia": c4, "ibu_hamil": c5, "disabilitas": c6 }));
        try {
            let res = await fetch('http://localhost:1337/api/data-matriks', {
            method: 'POST',
            headers: {
                Authorization: 'Bearer ' + localStorage.getItem('token'),
            },
            body: formData
            });

            let result = await res.json();
            alert('Data matrik berhasil ditambahkan!');
            window.location.href = "http://localhost/Project/ummi/ummi-fe/datamatrik.php";
        } catch (err) {
            alert('Data matrik gagal ditambahkan!');
        }
        });
    });
</script>
    
<script>
    $(document).ready(function () {
        document.getElementById('formSearchData').addEventListener('submit', async function(e) {
        e.preventDefault();
        const form = e.target;
        let username = form.username.value

            $.ajax({
                url: `http://localhost:1337/api/data-masyarakats/${username}?populate=*`,
                method: 'GET',
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token'),
                },
                success: function(response) {
                    console.log('====================================');
                    console.log(response.data?.attributes);
                    console.log('====================================');
                    let c1 = response.data?.attributes.kriteria_penghasilan.data == null ? 0 : response.data?.attributes.kriteria_penghasilan.data.attributes.nilai;
                    let c2 = response.data?.attributes.kriteria_rumah.data == null ? 0 : response.data?.attributes.kriteria_rumah.data.attributes.nilai;
                    let c3 = response.data?.attributes.kriteria_tanggungan.data == null ? 0 : response.data?.attributes.kriteria_tanggungan.data.attributes.nilai;
                    let c4 = response.data?.attributes.kriteria_lansia.data == null ? 0 : response.data?.attributes.kriteria_lansia.data.attributes.nilai;
                    let c5 = response.data?.attributes.kriteria_ibu_hamil.data == null ? 0 : response.data?.attributes.kriteria_ibu_hamil.data.attributes.nilai;
                    let c6 = response.data?.attributes.kriteria_disability.data == null ? 0 : response.data?.attributes.kriteria_disability.data.attributes.nilai;
                    
                    c1 = c1 / 4;
                    c2 = c2 / 4;
                    c3 = c3 / 4;
                    c4 = c4 / 2;
                    c5 = c5 / 2;
                    c6 = c6 / 2;

                    $('#iduser').val(response.data.attributes.users_permissions_user.data.id);
                    $('#namauser').val(response.data.attributes.nama);
                    $('#c1').val(c1);
                    $('#c2').val(c2);
                    $('#c3').val(c3);
                    $('#c4').val(c4);
                    $('#c5').val(c5);
                    $('#c6').val(c6);
                },
                error: function(error) {
                    alert('Gagal mengambil data user!');
                    console.error(error);
                },
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

         // Request data dari server
        $.ajax({
            url: 'http://localhost:1337/api/users', // Ganti dengan URL server Anda
            method: 'GET',
            headers: {
                Authorization: 'Bearer ' + localStorage.getItem('token'), // Tambahkan Bearer Token
            },
            dataType: 'json',
            success: function(data) {
                let resData = data;
                console.log('====================================');
                console.log(resData);
                console.log('====================================');
                $('#username').append(
                    `<option value="">Select Username...</option>`
                    ); 
                $.each(resData, function(i, dt) {
                // Looping data dan tambahkan ke elemen HTML
                    $('#username').append(
                    `<option value="` + dt.id + `">` + dt.username + `</option>`
                    ); 
                })                   
            },
            error: function(error) {
                alert('Gagal memuat data!');
                console.error(error);
            }
        });
    });
</script>