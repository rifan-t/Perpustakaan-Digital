<!DOCTYPE html>
<html>
<head>
	<title>Export Data Ke Excel </title>
</head>
<body>
	<?php
    include '../../lib/koneksi.php';
    $sql = "SELECT p.*, b.judul_buku, u.username 
    FROM peminjaman p
    JOIN buku b ON p.bukuId = b.bukuId
    JOIN users u ON p.userId = u.userId";

$stmt = $conn->prepare($sql);
$stmt->execute();

$data_p = $stmt->fetchAll(PDO::FETCH_ASSOC);
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data Pinjaman.xls");
	?>
<table id="tabel-buku" class="table table-striped table-bordered" style="width:100%">
        <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peminjam</th>
                    <th>Buku</th>
                    <th>Tanggal Dipinjam</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Tanggal Kembali</th>
                    <th>Status Peminjaman</th>
                    <th>Denda</th>
                </tr>
            </thead>
            <tbody>
                <?php

                foreach ($data_p as $index => $data) {
                    echo '<tr>';
                    echo '<td>' . ($index + 1) . '</td>';
                    echo '<td>' . $data['username'] . '</td>';
                    echo '<td>' . $data['judul_buku'] . '</td>';
                    echo '<td>' .  date('l, F j, Y', strtotime(datetime: $data['tanggal_peminjaman'])) .'</td>';
                    echo '<td>' .  date('l, F j, Y', strtotime(datetime: $data['tanggal_pengembalian'])) .'</td>';
                    echo '<td>' . ($data['tanggal_kembali'] == null ? 'Buku Belum Dikembalikan' : date('l, F j, Y', strtotime($data['tanggal_kembali']))) . '</td>';
                    echo '<td>' . $data['status_peminjaman'] . '</td>';
                    echo '<td>' . "Rp. " . number_format($data['total_denda'], 0, ',', '.' ) . '</td>';
                  
                }
                ?>
            </tbody>
        </table>
        </body>
</html>