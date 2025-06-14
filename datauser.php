<?php
include 'template/header.php';
include 'content/datauser.php';
include 'template/footer.php';
?>

<script>
    $(document).ready(function() {
        // Request data dari server
        $.ajax({
            url: 'http://localhost:1337/api/users', // URL API Anda
            method: 'GET',
            dataType: 'json',
            headers: {
                Authorization: 'Bearer ' + localStorage.getItem('token'), // Tambahkan Bearer Token
            },
            success: function(response) {
                // Bersihkan daftar sebelumnya
                $('#datauserList').empty();
                $.each(response, function(index, item) {
                    // Tambahkan data ke tabel
                    if(item.status.toUpperCase() == "MASYARAKAT" ){
                        $('#datauserList').append(
                            `<tr>
                            <td style="width: 50px; text-align: center;">${index + 1}</td>
                            <td style="text-align: center;">${item.username}</td>
                            <td style="text-align: center;">${item.email}</td>
                            <td style="text-align: center;">
                                <a href="datauseredit.php?id=${item.id}" class="btn btn-warning btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm btn-delete" data-id="${item.id}">Hapus</button>
                            </td>
                        </tr>`
                        );
                    }
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
      url: `http://localhost:1337/api/users/${datauserId}`,
      method: 'DELETE',
      headers: {
        Authorization: 'Bearer ' + localStorage.getItem('token'),
      },
      success: function (data, textStatus, jqXHR) {
          // Cek status HTTP untuk memastikan respons berhasil
          if (jqXHR.status === 200 || jqXHR.status === 204) {
            alert('datauser berhasil dihapus!');
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