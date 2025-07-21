<?php
include 'template/header.php';
include 'content/dataperengkingan.php';
include 'template/footer.php';
?>

<script>
  let resData;
    $(document).ready(function() {
        // Request data dari server
        $.ajax({
            url: 'http://localhost:1337/api/data-perengkingans?populate=*&sort=data_masyarakat.nama:asc', // URL API Anda
            method: 'GET',
            dataType: 'json',
            headers: {
                Authorization: 'Bearer ' + localStorage.getItem('token'), // Tambahkan Bearer Token
            },
            success: function(response) {
                // Bersihkan daftar sebelumnya
                $('#dataperengkinganList').empty();
                resData = response.data
                $.each(response.data, function(index, item) {
                    // Tambahkan data ke tabel
                    $('#dataperengkinganList').append(
                      `<tr>
                      <td style="width: 20px; text-align: center;">${index + 1}</td>
                      <td style="text-align: center;">${item.attributes.data_masyarakat.data.attributes.nama}</td>
                      <td style="text-align: center;">${item.attributes.penghasilan}</td>
                      <td style="text-align: center;">${item.attributes.kondisi_rumah}</td>
                      <td style="text-align: center;">${item.attributes.tanggungan}</td>
                      <td style="text-align: center;">${item.attributes.lansia}</td>
                      <td style="text-align: center;">${item.attributes.ibu_hamil}</td>
                      <td style="text-align: center;">${item.attributes.disabilitas}</td>
                      <td style="text-align: center;">${item.attributes.perengkingan}</td>
                        <td style="text-align: center;">${item.attributes.status}</td>
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

    
  // Fungsi render data ke <ul>
  function render(dataToRender) {
    $('#dataperengkinganList').empty();
    for (let i = 0; i < dataToRender.length; i++) {
      // Tambahkan data ke tabel
      $('#dataperengkinganList').append(
        `<tr>
        <td style="width: 20px; text-align: center;">${i + 1}</td>
        <td style="text-align: center;">${dataToRender[i].attributes.data_masyarakat.data.attributes.nama}</td>
        <td style="text-align: center;">${dataToRender[i].attributes.penghasilan}</td>
        <td style="text-align: center;">${dataToRender[i].attributes.kondisi_rumah}</td>
        <td style="text-align: center;">${dataToRender[i].attributes.tanggungan}</td>
        <td style="text-align: center;">${dataToRender[i].attributes.lansia}</td>
        <td style="text-align: center;">${dataToRender[i].attributes.ibu_hamil}</td>
        <td style="text-align: center;">${dataToRender[i].attributes.disabilitas}</td>
        <td style="text-align: center;">${dataToRender[i].attributes.perengkingan}</td>
          <td style="text-align: center;">${dataToRender[i].attributes.status}</td>
          <td style="text-align: center;">
              <button class="btn btn-danger btn-sm btn-delete" data-id="${dataToRender[i].id}">Hapus</button>
          </td>
      </tr>`);      
    }
  }
  
  $('#search').on('input', function() {
    let search = $('#search').val();
     let keyword = search.toLowerCase();
      let filtered = resData.filter(item =>
        item.attributes.data_masyarakat.data.attributes.nama.toLowerCase().includes(keyword) || item.attributes.status.toLowerCase().includes(keyword)
      );
      render(filtered);

  });

</script>
<script>
    $(document).on('click', '.btn-delete', function () {
  const datauserId = $(this).data('id');
  

  if (confirm('Apakah Anda yakin ingin menghapus data user ini?')) {
    $.ajax({
      url: `http://localhost:1337/api/data-perengkingans/${datauserId}`,
      method: 'DELETE',
      headers: {
        Authorization: 'Bearer ' + localStorage.getItem('token'),
      },
      success: function (data, textStatus, jqXHR) {
          // Cek status HTTP untuk memastikan respons berhasil
          if (jqXHR.status === 200 || jqXHR.status === 204) {
            alert('Data perengkingan berhasil dihapus!');
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