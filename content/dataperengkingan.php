<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

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

            <!-- Page Heading -->
            <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Data Perengkingan</h1>
                <a href="dataperengkinganadd.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-plus fa-sm text-white-50"></i> Tambah Data Perengkingan</a>
            </div> -->

            <!-- Content Row -->

            <div class="row">
                <div class="col-xl-12 col-lg-6">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Data Perengkingan</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <button id="cetakSemua" style="border-radius: 15px; background-color: greenyellow; font-family: bold;">Cetak PDF</button>

                                    <div style=" display: flex;
                                                justify-content: flex-end; /* Geser ke kanan */
                                                padding: 10px;">
                                        <input type="text" id="search" placeholder="Cari nama..." style="width:200px;">
                                    </div>
                                    
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="width: 50px; text-align: center;">No</th>
                                                <th style="text-align: center;">Nama</th>
                                                <th style="text-align: center;">Penghasilan</th>
                                                <th style="text-align: center;">Kondisi Rumah</th>
                                                <th style="text-align: center;">Tanggungan</th>
                                                <th style="text-align: center;">Lansia</th>
                                                <th style="text-align: center;">Ibu Hamil</th>
                                                <th style="text-align: center;">Disabilitas</th>
                                                <th style="text-align: center;">Nilai Akhir</th>
                                                <th style="text-align: center;">Status</th>
                                                <th style="text-align: center;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th style="width: 50px; text-align: center;">No</th>
                                                <th style="text-align: center;">Nama</th>
                                                <th style="text-align: center;">Penghasilan</th>
                                                <th style="text-align: center;">Kondisi Rumah</th>
                                                <th style="text-align: center;">Tanggungan</th>
                                                <th style="text-align: center;">Lansia</th>
                                                <th style="text-align: center;">Ibu Hamil</th>
                                                <th style="text-align: center;">Disabilitas</th>
                                                <th style="text-align: center;">Nilai Akhir</th>
                                                <th style="text-align: center;">Status</th>
                                                <th style="text-align: center;">Aksi</th>
                                            </tr>
                                        </tfoot>
                                        <tbody id="dataperengkinganList">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Your Website 2021</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->
</div>

<!-- End of Content Wrapper -->
 <script>
    $('#cetakSemua').on('click', function () {
      const urls = [
        'cetak.php?filter=tidak',
        'cetak.php?filter=layak',
        'cetak.php?filter=all'
      ];

       $.ajax({
            url: 'http://localhost:1337/api/data-perengkingans?populate=*&sort=data_masyarakat.nama:asc', 
            method: 'GET',
            dataType: 'json',
            headers: {
                Authorization: 'Bearer ' + localStorage.getItem('token'), 
            },
            success: function(response) {
                for (let i = 0; i < urls.length; i++) {
                    setTimeout(() => {
                        const json = JSON.stringify(response.data);
                        const form = $('<form>', {
                            method: 'POST',
                            action: urls[i],
                            target: '_blank' 
                        }).append($('<input>', {
                            type: 'hidden',
                            name: 'jsonData',
                            value: json
                        }));

                        form.appendTo('body').submit().remove();
                    }, i * 2000);
                }
            },
            error: function(error) {
                alert('Gagal memuat data!');
                console.error(error);
            }
        });
    });
  </script>
