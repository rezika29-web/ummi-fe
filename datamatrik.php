<?php
include 'template/header.php';
include 'content/datamatrik.php';
include 'template/footer.php';
?>

<script>
    $(document).ready(function() {
        // Request data dari server
        $.ajax({
            url: 'http://localhost:1337/api/data-matriks?populate=*&sort=users_permissions_user.username:asc', // URL API Anda
            method: 'GET',
            dataType: 'json',
            headers: {
                Authorization: 'Bearer ' + localStorage.getItem('token'), // Tambahkan Bearer Token
            },
            success: function(response) {
                // Bersihkan daftar sebelumnya
                $('#datamatrikList').empty();
                $.each(response.data, function(index, item) {
                    // Tambahkan data ke tabel
                    $('#datamatrikList').append(
                        `<tr>
                        <td style="width: 20px; text-align: center;">${index + 1}</td>
                        <td style="text-align: center;">${item.attributes.users_permissions_user.data.attributes.username}</td>
                        <td style="text-align: center;">${item.attributes.penghasilan}</td>
                        <td style="text-align: center;">${item.attributes.kondisi_rumah}</td>
                        <td style="text-align: center;">${item.attributes.tanggungan}</td>
                        <td style="text-align: center;">${item.attributes.lansia}</td>
                        <td style="text-align: center;">${item.attributes.ibu_hamil}</td>
                        <td style="text-align: center;">${item.attributes.disabilitas}</td>
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
      url: `http://localhost:1337/api/data-matriks/${datauserId}`,
      method: 'DELETE',
      headers: {
        Authorization: 'Bearer ' + localStorage.getItem('token'),
      },
      success: function (data, textStatus, jqXHR) {
          // Cek status HTTP untuk memastikan respons berhasil
          if (jqXHR.status === 200 || jqXHR.status === 204) {
            alert('Data matrik berhasil dihapus!');
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