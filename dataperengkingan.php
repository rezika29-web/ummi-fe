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
      url: 'http://localhost:1337/api/data-perengkingans?populate=*&sort=perengkingan:desc', // URL API Anda
      method: 'GET',
      dataType: 'json',
      headers: {
        Authorization: 'Bearer ' + localStorage.getItem('token'), // Tambahkan Bearer Token
      },
      success: function(response) {
        // Bersihkan daftar sebelumnya
        $('#dataperengkinganList').empty();
        resData = response.data
        resData.sort((a, b) => {
          let nilaiA = a.attributes.perengkingan;
          let nilaiB = b.attributes.perengkingan;
          if (nilaiA === nilaiB) {
            return b.attributes.penghasilan - a.attributes.penghasilan;
          }
          return nilaiB - nilaiA;
        });

        render(resData);
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

    // Sorting terlebih dahulu
    dataToRender.sort((a, b) => {
      const nilaiA = a.attributes.perengkingan;
      const nilaiB = b.attributes.perengkingan;

      if (nilaiA === nilaiB) {
        return b.attributes.penghasilan - a.attributes.penghasilan; // lebih tinggi penghasilan = lebih bagus
      }

      return nilaiB - nilaiA; // nilai lebih besar = lebih tinggi
    });

    // Hitung ranking dengan dense method
    let lastScore = null;
    let lastIncome = null;
    let currentRank = 1;

    for (let i = 0; i < dataToRender.length; i++) {
      const item = dataToRender[i];
      const score = item.attributes.perengkingan;
      const income = item.attributes.penghasilan;

      if (i === 0) {
        // data pertama
        currentRank = 1;
      } else {
        const prev = dataToRender[i - 1];
        const prevScore = prev.attributes.perengkingan;
        const prevIncome = prev.attributes.penghasilan;

        if (score !== prevScore || income !== prevIncome) {
          currentRank++; // naik 1 peringkat saja (dense ranking)
        }
      }

      $('#dataperengkinganList').append(
        `<tr>
                <td style="width: 20px; text-align: center;">${i + 1}</td>
                <td style="text-align: center;">${item.attributes.data_masyarakat.data.attributes.nama}</td>
                <td style="text-align: center;">${item.attributes.penghasilan}</td>
                <td style="text-align: center;">${item.attributes.kondisi_rumah}</td>
                <td style="text-align: center;">${item.attributes.tanggungan}</td>
                <td style="text-align: center;">${item.attributes.lansia}</td>
                <td style="text-align: center;">${item.attributes.ibu_hamil}</td>
                <td style="text-align: center;">${item.attributes.disabilitas}</td>
                <td style="text-align: center;">${item.attributes.perengkingan}</td>
                <td style="text-align: center;">${item.attributes.status}</td>
                <td style="text-align: center;">${currentRank}</td>
                <td style="text-align: center;">
                    <button class="btn btn-danger btn-sm btn-delete" data-id="${item.id}">Hapus</button>
                </td>
            </tr>`
      );
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
  $(document).on('click', '.btn-delete', function() {
    const datauserId = $(this).data('id');


    if (confirm('Apakah Anda yakin ingin menghapus data user ini?')) {
      $.ajax({
        url: `http://localhost:1337/api/data-perengkingans/${datauserId}`,
        method: 'DELETE',
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('token'),
        },
        success: function(data, textStatus, jqXHR) {
          // Cek status HTTP untuk memastikan respons berhasil
          if (jqXHR.status === 200 || jqXHR.status === 204) {
            alert('Data perengkingan berhasil dihapus!');
            location.reload(); // Refresh halaman setelah hapus
          } else {
            alert('Proses berhasil tetapi respons tidak terduga.');
          }
          location.reload(); // Refresh halaman setelah hapus
        },
        error: function(error) {
          console.error(error);
          alert('Gagal menghapus datauser!');
        },
      });
    }
  });
</script>