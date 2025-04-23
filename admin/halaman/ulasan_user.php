<?php
    $sql = "SELECT * FROM ulasanbuku 
    JOIN buku ON ulasanbuku.bukuId = buku.bukuId
    JOIN users ON ulasanbuku.userId = users.userId
    ORDER BY ulasanbuku.ulasanId DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if(isset($_GET['setujuid'])) {
    $ulasanId = $_GET['setujuid'];
    $stmt = $conn->prepare("UPDATE ulasanbuku SET status = 'disetujui' WHERE ulasanId = ?");
    $stmt->execute([$ulasanId]);
    echo "<script>alert('Ulasan telah disetujui');</script>";
    echo "<script>window.location.href='?page=ulasan_user';</script>";
}
if(isset($_GET['tolakid'])) {
    $ulasanId = $_GET['tolakid'];
    $stmt = $conn->prepare("UPDATE ulasanbuku SET status = 'ditolak' WHERE ulasanId = ?");
    $stmt->execute([$ulasanId]);

    echo "<script>alert('Ulasan telah dtolak');</script>";
    echo "<script>window.location.href='?page=ulasan_user';</script>";}

?>

<div class="container mt-5">
    <div class="card-header text-dark">
        <h3 class="mb-0">Daftar User</h3>
    </div>
    
<table id="tabel-buku" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Ulasan Di Buku </th>
                    <th>isi Ulasan </th>
                    <th>status</th>
                    <th>Ubah</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($result as $row) {
                    echo "<tr>
                    <td>{$row['username']}</td>
                    <td>{$row['judul_buku']}</td>
                    <td>{$row['ulasan']}</td>
                    <td>{$row['status']}</td>
                    <td>
                        <div class='btn-group' role='group'>
                            <a href='?page=ulasan_user&setujuid={$row['ulasanId']}' class='btn btn-sm btn-info'>Setujui</a>
                            <a href='?page=ulasan_user&tolakid={$row['ulasanId']}' class='btn btn-sm btn-danger'>Tolak</a>
                        </div>
                    </td>
                  </tr>";
                
                }
                ?>
            </tbody>
        </table>
</div>