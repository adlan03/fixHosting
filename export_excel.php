<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/helpers.php';

require_login();

$type = $_GET['type'] ?? 'summary';
$setting = fetch_settings();
$harga  = setting_value($setting, 'harga');
$berasV = setting_value($setting, 'beras');
$jagungV = setting_value($setting, 'jagung');

$filename = "export_{$type}_" . date('Ymd_His') . ".xls";
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=\"$filename\"");
echo "\xEF\xBB\xBF"; // BOM untuk UTF-8

// =====================
// CSS LANGSUNG DI HTML
// =====================
echo <<<CSS
<style>
table {
  border-collapse: collapse;
  width: 100%;
  font-family: Arial, sans-serif;
}
th {
  background: #fdd835;
  color: #176b41;
  font-weight: bold;
  border: 1px solid #999;
  padding: 8px;
  text-align: center;
}
td {
  border: 1px solid #999;
  padding: 8px;
  text-align: center;
}
tr:nth-child(even) { background: #f5f5f5; }
tr:hover { background: #e8f5e9; }
h2 {
  color: #176b41;
}
</style>
CSS;

// =====================
// MODE RINGKAS
// =====================
if ($type === 'summary') {
    echo "<h2>Data Ringkas Infaq & Zakat</h2>";
    echo "<table><thead><tr>
        <th>No</th><th>Kepala Keluarga</th><th>Jumlah Anggota</th>
        <th>Uang (Rp)</th><th>Beras (kg)</th><th>Jagung (kg)</th><th>Infaq (Rp)</th>
    </tr></thead><tbody>";

    echo "<tr><td colspan='7'>Data tidak tersedia karena database dinonaktifkan.</td></tr>";
    echo "<tr style='font-weight:bold;background:#fff59d;'>
        <td colspan='3'>TOTAL</td>
        <td>" . format_rupiah(0.0) . "</td>
        <td>0</td>
        <td>0</td>
        <td>" . format_rupiah(0.0) . "</td>
    </tr>";

    echo "</tbody></table>";
    exit;
}

// ====== MODE DETAIL (tanpa kolom ID, dengan total akhir) ======
if ($type === 'detail') {
    echo "<h2>Data Detail Anggota</h2>";
    echo "<table><thead><tr>
        <th>No</th>
        <th>Kepala</th>
        <th>Nama Anggota</th>
        <th>JK</th>
        <th>Pilihan</th>
        <th>Uang (Rp)</th>
        <th>Beras (kg)</th>
        <th>Jagung (kg)</th>
        <th>Infaq (Rp)</th>
    </tr></thead><tbody>";

    echo "<tr><td colspan='9'>Data tidak tersedia karena database dinonaktifkan.</td></tr>";
    echo "<tr style='font-weight:bold; background:#fff59d;'>
        <td colspan='5' style='text-align:right;'>TOTAL KESELURUHAN</td>
        <td>Rp 0</td>
        <td>0</td>
        <td>0</td>
        <td>Rp 0</td>
    </tr>";

    echo "</tbody></table>";
    exit;
}
