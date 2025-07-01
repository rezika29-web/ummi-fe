
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
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Data Normalisasi</h6>
                </div>
                <div style=" margin: 20px;">
                    <form id="formSearchData">
                    <div class="mb-3">
                        <label class="form-label" for="username">Select Data User</label>
                        <select class="form-control" id="username">
                        </select>
                    </div>
                       <button type="submit">Search</button>
                    </form>

                    <form id="formContent">
                    <input type="text" class="form-control" id="idmasyarakat" placeholder="idmasyarakat" hidden>
                    <input type="text" class="form-control" id="iduser" placeholder="iduser" hidden>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="namauser" placeholder="nama" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">C1</label>
                        <input type="text" class="form-control" id="c1" placeholder="c1" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">C2</label>
                        <input type="text" class="form-control" id="c2" placeholder="c2" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">C3</label>
                        <input type="text" class="form-control" id="c3" placeholder="c3" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">C4</label>
                        <input type="text" class="form-control" id="c4" placeholder="c4" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">C5</label>
                        <input type="text" class="form-control" id="c5" placeholder="c5" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">C6</label>
                        <input type="text" class="form-control" id="c6" placeholder="c6" readonly>
                    </div>
                    <input type="text" class="form-control" id="bobotc1" placeholder="bobotc1" hidden>
                    <input type="text" class="form-control" id="bobotc2" placeholder="bobotc2" hidden>
                    <input type="text" class="form-control" id="bobotc3" placeholder="bobotc3" hidden>
                    <input type="text" class="form-control" id="bobotc4" placeholder="bobotc4" hidden>
                    <input type="text" class="form-control" id="bobotc5" placeholder="bobotc5" hidden>
                    <input type="text" class="form-control" id="bobotc6" placeholder="bobotc6" hidden>

                    <input type="text" class="form-control" id="minPenghasilan" placeholder="minPenghasilan" hidden>
                    <input type="text" class="form-control" id="minRumah" placeholder="minRumah" hidden>
                    <input type="text" class="form-control" id="maxTanggungan" placeholder="maxTanggungan" hidden>
                    <input type="text" class="form-control" id="maxLansia" placeholder="maxLansia" hidden>
                    <input type="text" class="form-control" id="maxIbuHamil" placeholder="maxIbuHamil" hidden>
                    <input type="text" class="form-control" id="maxDisabilitas" placeholder="maxDisabilitas" hidden>
                    <input type="text" class="form-control" id="nilaiminimum" placeholder="nilaiminimum" hidden>
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
        let idmasyarakat = form.idmasyarakat.value
        let c1 = form.c1.value
        let c2 = form.c2.value
        let c3 = form.c3.value
        let c4 = form.c4.value
        let c5 = form.c5.value
        let c6 = form.c6.value
        let bobotc1 = form.bobotc1.value
        let bobotc2 = form.bobotc2.value
        let bobotc3 = form.bobotc3.value
        let bobotc4 = form.bobotc4.value
        let bobotc5 = form.bobotc5.value
        let bobotc6 = form.bobotc6.value
        let minPenghasilan = form.minPenghasilan.value
        let minRumah = form.minRumah.value
        let maxTanggungan = form.maxTanggungan.value
        let maxLansia = form.maxLansia.value
        let maxIbuHamil = form.maxIbuHamil.value
        let maxDisabilitas = form.maxDisabilitas.value
        let nilaiminimum = form.nilaiminimum.value

        formData.append('data', JSON.stringify({ "data_masyarakat" : idmasyarakat, "C1": c1, "C2": c2, "C3": c3, "C4": c4, "C5": c5, "C6": c6 }));
        try {
            let res = await fetch('http://localhost:1337/api/data-normalisasis', {
            method: 'POST',
            headers: {
                Authorization: 'Bearer ' + localStorage.getItem('token'),
            },
            body: formData
            });

            let result = await res.json();
            const formDataMatrik = new FormData();
            c1 = minPenghasilan / c1;
            c2 = minRumah / c2;
            c3 = c3 / maxTanggungan;
            c4 = c4 / maxLansia;
            c5 = c5 / maxIbuHamil;
            c6 = c6 / maxDisabilitas;
            formDataMatrik.append('data', JSON.stringify({ "users_permissions_user" : iduser, "penghasilan": c1, "kondisi_rumah": c2, "tanggungan": c3, "lansia": c4, "ibu_hamil": c5, "disabilitas": c6 }));
            try {
                let res = await fetch('http://localhost:1337/api/data-matriks', {
                method: 'POST',
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token'),
                },
                body: formDataMatrik
                });

                const formDataperengkingan = new FormData();
                c1 = c1 * bobotc1;
                c2 = c2 * bobotc2;
                c3 = c3 * bobotc3;
                c4 = c4 * bobotc4;
                c5 = c5 * bobotc5;
                c6 = c6 * bobotc6;
                let perengkingan = c1 + c2 + c3 + c4 + c5 + c6;
                let status = perengkingan > nilaiminimum ? "layak" : "tidak layak";
                formDataperengkingan.append('data', JSON.stringify({ "data_masyarakat" : idmasyarakat, "penghasilan": c1, "kondisi_rumah": c2, "tanggungan": c3, "lansia": c4, "ibu_hamil": c5, "disabilitas": c6, "perengkingan": perengkingan, "status": status }));
                try {
                    let res = await fetch('http://localhost:1337/api/data-perengkingans', {
                    method: 'POST',
                    headers: {
                        Authorization: 'Bearer ' + localStorage.getItem('token'),
                    },
                    body: formDataperengkingan
                    });

                    alert('Data Normalisasi berhasil ditambahkan!');
                    window.location.href = "http://localhost/ummi/fe/datanormalisasi.php";

                } catch (err) {
                    alert('Data matrik gagal ditambahkan!');
                }   
                    
            } catch (err) {
                alert('Data matrik gagal ditambahkan!');
            }          
        } catch (err) {
            alert('Data Normalisasi gagal ditambahkan!');
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
                    let c1 = response.data?.attributes.kriteria_penghasilan.data == null ? 0 : response.data?.attributes.kriteria_penghasilan.data.attributes.nilai;
                    let c2 = response.data?.attributes.kriteria_rumah.data == null ? 0 : response.data?.attributes.kriteria_rumah.data.attributes.nilai;
                    let c3 = response.data?.attributes.kriteria_tanggungan.data == null ? 0 : response.data?.attributes.kriteria_tanggungan.data.attributes.nilai;
                    let c4 = response.data?.attributes.kriteria_lansia.data == null ? 0 : response.data?.attributes.kriteria_lansia.data.attributes.nilai;
                    let c5 = response.data?.attributes.kriteria_ibu_hamil.data == null ? 0 : response.data?.attributes.kriteria_ibu_hamil.data.attributes.nilai;
                    let c6 = response.data?.attributes.kriteria_disability.data == null ? 0 : response.data?.attributes.kriteria_disability.data.attributes.nilai;
                    $('#iduser').val(response.data.attributes.users_permissions_user.data.id);
                    $('#idmasyarakat').val(response.data.id);
                    
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
            url: 'http://localhost:1337/api/data-masyarakats?pagination[limit]=100', // Ganti dengan URL server Anda
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
                $.each(resData.data, function(i, dt) {
                // Looping data dan tambahkan ke elemen HTML
                    $('#username').append(
                    `<option value="` + dt.id + `">` + dt.attributes.nama + " - " + dt.attributes.nama +`</option>`
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

<script>
    $(document).ready(function() {
        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

         // Request data dari server
        $.ajax({
            url: 'http://localhost:1337/api/nilai-minimum', // Ganti dengan URL server Anda
            method: 'GET',
            headers: {
                Authorization: 'Bearer ' + localStorage.getItem('token'), // Tambahkan Bearer Token
            },
            dataType: 'json',
            success: function(data) {
                let resData = data; 
                $('#nilaiminimum').val(resData.data.attributes.nilai);
            },
            error: function(error) {
                alert('Gagal memuat data!');
                console.error(error);
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

         // Request data dari server
        $.ajax({
            url: 'http://localhost:1337/api/data-kriterias', // Ganti dengan URL server Anda
            method: 'GET',
            headers: {
                Authorization: 'Bearer ' + localStorage.getItem('token'), // Tambahkan Bearer Token
            },
            dataType: 'json',
            success: function(data) {
                let resData = data; 
                $('#bobotc1').val(resData.data[0].attributes.bobot);
                $('#bobotc2').val(resData.data[1].attributes.bobot);
                $('#bobotc3').val(resData.data[2].attributes.bobot);
                $('#bobotc4').val(resData.data[3].attributes.bobot);
                $('#bobotc5').val(resData.data[4].attributes.bobot);
                $('#bobotc6').val(resData.data[5].attributes.bobot);
            },
            error: function(error) {
                alert('Gagal memuat data!');
                console.error(error);
            }
        });
    });
</script>

<script>
fetch("http://localhost:1337/api/data-masyarakats?populate=*&pagination[limit]=100", {
  headers: {
        Authorization: 'Bearer ' + localStorage.getItem('token'), // Tambahkan Bearer Token
  }
})
  .then(response => response.json())
  .then(json => {
    const data = json.data;

    // Ambil semua nilai yang valid
    const values = data.map(item => {
      const attr = item.attributes;
      return {
        penghasilan: attr.kriteria_penghasilan?.data?.attributes?.nilai ?? null,
        rumah: attr.kriteria_rumah?.data?.attributes?.nilai ?? null,
        tanggungan: attr.kriteria_tanggungan?.data?.attributes?.nilai ?? null,
        lansia: attr.kriteria_lansia?.data?.attributes?.nilai ?? null,
        ibuHamil: attr.kriteria_ibu_hamil?.data?.attributes?.nilai ?? null,
        disabilitas: attr.kriteria_disability?.data?.attributes?.nilai ?? null,
      };
    });

    // Fungsi bantu
    const getMin = (key) => Math.min(...values.map(v => v[key]).filter(v => v !== null));
    const getMax = (key) => Math.max(...values.map(v => v[key]).filter(v => v !== null));

    // Hitung nilai sesuai kebutuhan
    const minPenghasilan = getMin("penghasilan");
    const minRumah = getMin("rumah");
    const maxTanggungan = getMax("tanggungan");
    const maxLansia = getMax("lansia");
    const maxIbuHamil = getMax("ibuHamil");
    const maxDisabilitas = getMax("disabilitas");
    $('#minPenghasilan').val(minPenghasilan);
    $('#minRumah').val(minRumah);
    $('#maxTanggungan').val(maxTanggungan);
    $('#maxLansia').val(maxLansia);
    $('#maxIbuHamil').val(maxIbuHamil);
    $('#maxDisabilitas').val(maxDisabilitas);
  })
  .catch(error => {
    console.error("Terjadi kesalahan:", error);
});
</script>
