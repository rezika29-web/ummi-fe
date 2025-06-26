<?php
include 'template/header.php';
include 'content/datanormalisasi.php';
include 'template/footer.php';
?>

<script>
    $(document).ready(function() {
        // Request data dari server
        $.ajax({
            url: 'http://localhost:1337/api/data-normalisasis?populate=*', // URL API Anda
            method: 'GET',
            dataType: 'json',
            headers: {
                Authorization: 'Bearer ' + localStorage.getItem('token'), // Tambahkan Bearer Token
            },
            success: function(response) {
                // Bersihkan daftar sebelumnya
                $('#datanormalisasiList').empty();
                $.each(response.data, function(index, item) {
                    // Tambahkan data ke tabel
                    
                    $('#datanormalisasiList').append(
                        `<tr>
                        <td style="width: 20px; text-align: center;">${index + 1}</td>
                        <td style="text-align: center;">${item.attributes.data_masyarakat.data.attributes.nama}</td>
                        <td style="text-align: center;">${item.attributes.C1}</td>
                        <td style="text-align: center;">${item.attributes.C2}</td>
                        <td style="text-align: center;">${item.attributes.C3}</td>
                        <td style="text-align: center;">${item.attributes.C4}</td>
                        <td style="text-align: center;">${item.attributes.C5}</td>
                        <td style="text-align: center;">${item.attributes.C6}</td>
                        <td style="text-align: center;">
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
      url: `http://localhost:1337/api/data-normalisasis/${datauserId}`,
      method: 'DELETE',
      headers: {
        Authorization: 'Bearer ' + localStorage.getItem('token'),
      },
      success: function (data, textStatus, jqXHR) {
          // Cek status HTTP untuk memastikan respons berhasil
          if (jqXHR.status === 200 || jqXHR.status === 204) {
            alert('Data normalisasi berhasil dihapus!');
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