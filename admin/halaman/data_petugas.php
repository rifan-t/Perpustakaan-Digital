<?php

$sql = "SELECT * FROM users WHERE role_id = :role_id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(":role_id", 2, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Proses tambah petugas
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['petugas'])) {
    $username = $_POST['petugas'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash password
    $alamat = $_POST['alamat'];
    $role_id = 2; // Role ID untuk petugas

    $sqlInsert = "INSERT INTO users (username, password, email, alamat, role_id) VALUES (:username, :password, :email, :alamat, :role_id)";
    $stmtInsert = $conn->prepare($sqlInsert);
    $stmtInsert->bindValue(":username", $username);
    $stmtInsert->bindValue(":password", $password);
    $stmtInsert->bindValue(":email", $email);
    $stmtInsert->bindValue(":alamat", $alamat);
    $stmtInsert->bindValue(":role_id", $role_id, PDO::PARAM_INT);

    if ($stmtInsert->execute()) {
        echo "<script>alert('Petugas berhasil ditambahkan!'); location.href='?page=data_petugas';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan petugas!');</script>";
    }
}
?>

<div class="container mt-5">
    <div class="card-header text-dark">
        <h3 class="mb-0">Daftar Petugas</h3>
    </div>
    
    <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modalId">
        Tambah Petugas
    </button>

    <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="modalTitleId">Tambah Petugas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="tambah_petugas" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="petugas" class="form-label">Nama Petugas</label>
                        <input type="text" class="form-control" id="petugas" name="petugas" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <table id="tabel-buku" class="table table-striped table-bordered mt-3" style="width:100%">
        <thead>
            <tr>
                <th>ID User</th>
                <th>Username</th>
                <th>Email</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($result as $row) {
                echo "<tr>
                    <td>{$row['userId']}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['alamat']}</td>
                  </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
