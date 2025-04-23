<?php


$book = new Peminjaman($conn);
$riwayat_peminjaman = $book->dendaPinjaman($userId);

if (isset($_GET['id'])) {
    $peminjamanId = $_GET['id'];
    $result = $book->kembalikanBuku($peminjamanId);
    if ($result) {
        $_SESSION['success'] = "Buku berhasil dikembalikan.";
    } else {
        $_SESSION['error'] = "Gagal mengembalikan buku.";
    }
    echo "<script>window.location.href='?page=riwayat_peminjaman';</script>";
    exit;
}
if (isset($_GET['Bayarperid'])) {
    $peminjamanId = $_GET['Bayarperid'];
    $result = $book->bayarDenda($peminjamanId);
    if ($result) {
        $_SESSION['success'] = "Denda berhasil dibayar.";
    } else {
        $_SESSION['error'] = "Gagal membayar denda.";
    }
    echo "<script>window.location.href='?page=riwayat_peminjaman';</script>";
    exit;
}
?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $_SESSION['error']; ?>
            <?php unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>
    <div class="container mt-5">
        <h2 class="mb-4">Peminjaman Saya</h2>
        <!-- Notifikasi -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['success']; ?>
                <?php unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $_SESSION['error']; ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Status</th>
                        <th>Denda</th>
                        <th>Kembalikan Buku</th>
                        <th>Baca Buku</th>
                        <th>Bayar Denda</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($riwayat_peminjaman)): ?>
                        <?php foreach ($riwayat_peminjaman as $index => $row): ?>
                            <tr>
                                <td><?= $index + 1; ?></td>
                                <td><?= htmlspecialchars($row['judul_buku']); ?></td>
                                <td><?= date('d M Y', strtotime($row['tanggal_peminjaman'])); ?></td>
                                <td><?= date('d M Y', strtotime($row['tanggal_pengembalian'])); ?></td>
                                <td>
                                    <?php if ($row['status_peminjaman'] == 'Dikembalikan'): ?>
                                        <span class="badge bg-success">Dikembalikan</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning">Dipinjam</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php if ($row['status_pembayaran'] == 'Lunas'): ?>
                                        <s class="mx-1">Rp<?= number_format($row['total_denda'], 0, ',', '.'); ?></s>
                                        <span class="badge bg-success">Lunas</span>
                                    <?php elseif ($row['total_denda'] == 0): ?>
                                        Tidak Ada Denda
                                    <?php else: ?>
                                        Rp<?= number_format($row['total_denda'], 0, ',', '.'); ?>
                                        <span class="mx-1 badge bg-danger">Belum Lunas</span>
                                    <?php endif; ?>

                                </td>
                                <?php
                                if ($row['status_peminjaman'] == 'Dipinjam'): ?>
                                    <td>
                                        <a href="?page=riwayat_peminjaman&id=<?= $row['peminjamanId']; ?>" class="btn btn-danger btn-sm">Kembalikan</a>
                                    </td>
                                <?php else: ?>
                                    <td>-</td>
                                <?php endif;
                                ?>
                                <td>
                                    <?php
                                    if ($row['status_peminjaman'] == 'Dipinjam'): ?>
                                        <a href="modul/halaman/baca_buku.php?id=<?= $row['bukuId']; ?>" class="btn btn-primary btn-sm">Baca</a>
                                    <?php else: ?>
                                        <a href="#" class="btn btn-secondary btn-sm disabled">Tidak Tersedia</a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php
                                    if ($row['total_denda'] > 0 && $row['status_pembayaran'] == 'Belum Lunas'): ?>
                                        <a href="?page=riwayat_peminjaman&Bayarperid=<?= $row['peminjamanId']; ?>"
                                            class="btn btn-warning btn-sm">Bayar Denda</a>
                                    <?php else: ?>
                                        <a href="#" class="btn btn-secondary btn-sm disabled">Tidak Ada Denda</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center">Tidak ada riwayat peminjaman</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>


    </div>
    