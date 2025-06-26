<?php
include 'template/header.php';
include 'content/datamasyarakat.php';
include 'template/footer.php';
?>

<script>
    $(document).ready(function() {
        // Request data dari server
        $.ajax({
            url: 'http://localhost:1337/api/data-masyarakats?populate=*&pagination[limit]=100', // URL API Anda
            method: 'GET',
            dataType: 'json',
            headers: {
                Authorization: 'Bearer ' + localStorage.getItem('token'), // Tambahkan Bearer Token
            },
            success: function(response) {
                // Bersihkan daftar sebelumnya
                $('#datamasyarakatList').empty();
                $.each(response.data, function(index, item) {
                    // Tambahkan data ke tabel
                    $('#datamasyarakatList').append(
                        `<tr>
                        <td style="width: 20px; text-align: center;">${index + 1}</td>
                        <td style="text-align: center;">${item.attributes.nama}</td>
                        <td style="text-align: center;">${item.attributes.nik}</td>
                        <td style="text-align: center;">${item.attributes.kriteria_penghasilan.data.attributes.kriteria}</td>
                        <td style="text-align: center;">${item.attributes.kriteria_rumah.data.attributes.kondisi_rumah}</td>
                        <td style="text-align: center;">
                            <a href="datamasyarakatedit.php?id=${item.id}" class="btn btn-warning btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm btn-delete" data-id="${item.id}">Hapus</button>
                        </td>
                    </tr>`
                    );
                });
            },
            error: function(error) {
                alert('Gagal memuat data!');
                console.error(error);
            }
        });
    });
</script>
<script>
    $(document).on('click', '.btn-delete', function () {
  const datauserId = $(this).data('id');
  

  if (confirm('Apakah Anda yakin ingin menghapus data user ini?')) {
    $.ajax({
      url: `http://localhost:1337/api/data-masyarakats/${datauserId}`,
      method: 'DELETE',
      headers: {
        Authorization: 'Bearer ' + localStorage.getItem('token'),
      },
      success: function (data, textStatus, jqXHR) {
          // Cek status HTTP untuk memastikan respons berhasil
          if (jqXHR.status === 200 || jqXHR.status === 204) {
            alert('Data Masyarakat berhasil dihapus!');
            location.reload(); // Refresh halaman setelah hapus
          } else {
            alert('Proses berhasil tetapi respons tidak terduga.');
          }
        location.reload(); // Refresh halaman setelah hapus
      },
      error: function (error) {
        console.error(error);
        alert('Gagal menghapus datauser!');
      },
    });
  }
});
</script>