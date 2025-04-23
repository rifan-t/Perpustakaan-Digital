<?php 

$bukuId = $_POST['bukuId'];
$pinjam = new Peminjaman($conn);
$pinjam->tambahPeminjaman($userId, $bukuId);


?>
