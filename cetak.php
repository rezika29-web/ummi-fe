<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;

$json = $_POST['jsonData'] ?? '[]';
$data = json_decode($json, true);

$filter = $_GET['filter'] ?? 'all';
$filteredData = array_filter($data, function($item) use ($filter) {
  if ($filter == 'layak') return strtolower($item['attributes']['status']) == 'layak';
  if ($filter == 'tidak') return strtolower($item['attributes']['status']) == 'tidak layak';
  return true;
});
ob_start();
?>

<style>
  body { font-family: Courier, monospace; font-size: 12px; }
  table { border-collapse: collapse; width: 100%; }
  td, th { border: 1px solid #aaa; padding: 4px; }
  .red { color: red; }
</style>

<p>SISTEM INFORMASI PENERIMAAN BANTUAN PKH<br>
Nagari Tarung-Tarung, Kec. Rao Selatan, Kab. Pasaman</p>

<p>--------------------------------------------------------</p>

<table>
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Lengkap</th>
      <th>NIK</th>
      <th>Status</th>
      <th>Keterangan</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1; foreach($filteredData as $row): ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $row['attributes']['data_masyarakat']['data']['attributes']['nama']; ?></td>
        <td><?= $row['attributes']['data_masyarakat']['data']['attributes']['nik'] ?></td>
        <td class="<?= strtolower($row['attributes']['status']) == 'tidak layak' ? 'red' : '' ?>"><?= $row['attributes']['status'] ?></td>
        <td class="<?= strtolower($row['attributes']['status']) == 'tidak layak' ? 'red' : '' ?>"><?= strtolower($row['attributes']['status']) == 'tidak layak' ? 'Mohon maaf, Anda belum memenuhi kriteria.' : 'Selamat! Anda layak menerima bantuan PKH.'; ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<br>
<p>Dicetak oleh: Admin PKH | Tanggal Cetak: <?= date('d F Y') ?></p>

<?php
$html = ob_get_clean();
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

$filename = "laporan_pkh_" . $filter . ".pdf";
$dompdf->stream($filename, ["Attachment" => false]);
?>
