<?php
    if (isset($_SESSION['user_id'])) {
        $dataMasyarakartId = $_SESSION['user_id'];
        $dataMasyarakartStatus = $_SESSION['status'];
        $dataMasyarakartUsername = $_SESSION['username'];
    } else {
        echo "ID tidak ditemukan!";
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
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Data Masyarakat</h6>
                </div>
                <div style=" margin: 20px;">
                    <form id="formContent">
                    <div class="mb-3">
                        <label class="form-label" for="username">Username</label>
                        <select class="form-control" id="username">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" placeholder="Nama">
                    </div>
                    <div class="mb-3">
                        <label for="nik" class="form-label">Nik</label>
                        <input type="text" class="form-control" id="nik" placeholder="Nik">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="penghasilan">Penghasilan</label>
                        <select class="form-control" id="penghasilan">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="rumah">Rumah</label>
                        <select class="form-control" id="rumah">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="tanggungan">Tanggungan</label>
                        <select class="form-control" id="tanggungan">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="lansia">Lansia</label>
                        <select class="form-control" id="lansia">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="ibuhamil">Ibu Hamil</label>
                        <select class="form-control" id="ibuhamil">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="disability">Disability</label>
                        <select class="form-control" id="disability">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image1" class="form-label">Foto Tampak Depan</label>
                        <input class="form-control" type="file" id="image1" name="image1" accept="image/*">
                        <img id="previewimage1" class="img-thumbnail" src="#" alt="Preview Gambar" style="display: none;">
                    </div>
                    <div class="mb-3">
                        <label for="image2" class="form-label">Foto Tampak Belakang</label>
                        <input class="form-control" type="file" id="image2" name="image2" accept="image/*">
                        <img id="previewimage2" class="img-thumbnail" src="#" alt="Preview Gambar" style="display: none;">
                    </div>
                    <div class="mb-3">
                        <label for="kk" class="form-label">Foto KK</label>
                        <input class="form-control" type="file" id="kk" accept="image/*" name="kk">
                        <img id="preview" class="img-thumbnail" src="#" alt="Preview Gambar" style="display: none;">
                    </div>
                     <div class="mb-3">
                        <label for="kk" class="form-label">Foto Surat Keterangan Tidak Mampu</label>
                        <input class="form-control" type="file" id="sktm" accept="image/*" name="sktm">
                        <img id="previewsktm" class="img-thumbnail" src="#" alt="Preview Gambar" style="display: none;">
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
        $(document).ready(function() {
            function renderImage(file, params) {
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $(`#${params}`).attr('src', e.target.result).show();
                    };
                    return reader.readAsDataURL(file);
                }
            }

            $('#kk').change(function() {
                const file = this.files[0];
                renderImage(file, 'preview')
            });

            $('#image2').change(function() {
                const file = this.files[0];
                renderImage(file, 'previewimage2')
            });

            $('#image1').change(function() {
                const file = this.files[0];
                renderImage(file, 'previewimage1')
            });

            $('#sktm').change(function() {
                const file = this.files[0];
                renderImage(file, 'previewsktm')
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            
            document.getElementById('formContent').addEventListener('submit', async function(e) {
                e.preventDefault();
            
            const dataMasyarakartStatus = <?= json_encode($dataMasyarakartStatus); ?>;
            const form = e.target;
            const formData = new FormData();

            // Ambil data dari form
            let nama = form.nama.value
            let nik = form.nik.value
            let penghasilan = form.penghasilan.value
            let rumah = form.rumah.value
            let tanggungan = form.tanggungan.value
            let lansia = form.lansia.value
            let ibuhamil = form.ibuhamil.value
            let username = form.username.value
            let disability = form.disability.value
            let image1 = form.image1.files[0]
            let image2 = form.image2.files[0]
            let kk = form.kk.files[0]
            let sktm = form.sktm.files[0]

            var idUser = <?= $_SESSION['user_id']; ?>;
            // Tambahkan data ke FormData
            formData.append('data', JSON.stringify({ "users_permissions_user" : username, "nik": nik, "nama": nama, "kriteria_penghasilan": penghasilan, "kriteria_rumah": rumah, "kriteria_tanggungan": tanggungan, "kriteria_lansia": lansia, "kriteria_ibu_hamil": ibuhamil, "kriteria_disability": disability }));
            formData.append('files.foto_tampak_depan', image1);
            formData.append('files.foto_tampak_belakang', image2);
            formData.append('files.kk', kk);
            formData.append('files.sktm', sktm);
            try {
                let res = await fetch('http://localhost:1337/api/data-masyarakats', {
                method: 'POST',
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token'),
                },
                body: formData
                });

                let result = await res.json();
                alert('Data Masyarakat berhasil ditambahkan!');
                if(dataMasyarakartStatus == "Masyarakat"){
                    window.location.href = "http://localhost/Project/ummi/ummi-fe/dashboard.php";
                }else{
                    window.location.href = "http://localhost/Project/ummi/ummi-fe/datamasyarakat.php";
                }            
            } catch (err) {
                alert('Data Masyarakat gagal ditambahkan!');
            }
            });
        });
    </script>

    
<script>
    $(document).ready(function() {
        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }
        const dataMasyarakartId = <?= json_encode($dataMasyarakartId); ?>;
        const dataMasyarakartStatus = <?= json_encode($dataMasyarakartStatus); ?>;
        const dataMasyarakartUsername = <?= json_encode($dataMasyarakartUsername); ?>;

        if(dataMasyarakartStatus == "Masyarakat"){
            $('#username').append(
                `<option value="` + dataMasyarakartId + `">` + dataMasyarakartUsername + `</option>`
            );
        }else{
            $.ajax({
                url: 'http://localhost:1337/api/users', // Ganti dengan URL server Anda
                method: 'GET',
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token'), // Tambahkan Bearer Token
                },
                dataType: 'json',
                success: function(data) {
                    let resData = data;
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
        }

        // Request data dari server
        $.ajax({
            url: 'http://localhost:1337/api/kriteria-lansias', // Ganti dengan URL server Anda
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                let resData = data.data;
                $('#lansia').append(
                    `<option value="">Select Kriteria Lansia...</option>`
                    ); 
                $.each(resData, function(i, dt) {
                // Looping data dan tambahkan ke elemen HTML
                    $('#lansia').append(
                    `<option value="` + dt.id + `">` + dt.attributes.kriteria_lansia + `</option>`
                    ); 
                })                   
            },
            error: function(error) {
                alert('Gagal memuat data!');
                console.error(error);
            }
        });

         $.ajax({
            url: 'http://localhost:1337/api/kriteria-penghasilans', // Ganti dengan URL server Anda
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                let resData = data.data;
                $('#penghasilan').append(
                    `<option value="">Select Kriteria Penghasilan...</option>`
                    ); 
                $.each(resData, function(i, dt) {
                // Looping data dan tambahkan ke elemen HTML
                    $('#penghasilan').append(
                    `<option value="` + dt.id + `">` + dt.attributes.kriteria + `</option>`
                    ); 
                })                   
            },
            error: function(error) {
                alert('Gagal memuat data!');
                console.error(error);
            }
        });

         $.ajax({
            url: 'http://localhost:1337/api/kriteria-rumahs', // Ganti dengan URL server Anda
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                let resData = data.data;
                $('#rumah').append(
                    `<option value="">Select Kriteria Rumah...</option>`
                    ); 
                $.each(resData, function(i, dt) {
                // Looping data dan tambahkan ke elemen HTML
                    $('#rumah').append(
                    `<option value="` + dt.id + `">` + dt.attributes.kondisi_rumah + `</option>`
                    ); 
                })                   
            },
            error: function(error) {
                alert('Gagal memuat data!');
                console.error(error);
            }
        });

         $.ajax({
            url: 'http://localhost:1337/api/kriteria-tanggungans', // Ganti dengan URL server Anda
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                let resData = data.data;
                $('#tanggungan').append(
                    `<option value="">Select Kriteria Tanggungan...</option>`
                    ); 
                $.each(resData, function(i, dt) {
                // Looping data dan tambahkan ke elemen HTML
                    $('#tanggungan').append(
                    `<option value="` + dt.id + `">` + dt.attributes.kriteria_tanggungan + `</option>`
                    ); 
                })                   
            },
            error: function(error) {
                alert('Gagal memuat data!');
                console.error(error);
            }
        });

         $.ajax({
            url: 'http://localhost:1337/api/kriteria-ibu-hamils', // Ganti dengan URL server Anda
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                let resData = data.data;
                $('#ibuhamil').append(
                    `<option value="">Select Kriteria Ibu Hamil...</option>`
                    ); 
                $.each(resData, function(i, dt) {
                // Looping data dan tambahkan ke elemen HTML
                    $('#ibuhamil').append(
                    `<option value="` + dt.id + `">` + dt.attributes.kriteria_ibu_hamil + `</option>`
                    ); 
                })                   
            },
            error: function(error) {
                alert('Gagal memuat data!');
                console.error(error);
            }
        });

         $.ajax({
            url: 'http://localhost:1337/api/kriteria-disabilities', // Ganti dengan URL server Anda
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                let resData = data.data;
                $('#disability').append(
                    `<option value="">Select Kriteria Disability...</option>`
                    ); 
                $.each(resData, function(i, dt) {
                // Looping data dan tambahkan ke elemen HTML
                    $('#disability').append(
                    `<option value="` + dt.id + `">` + dt.attributes.disabilitas + `</option>`
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