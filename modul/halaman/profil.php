<?php
if(isset($_POST['edit_profil'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];

    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, alamat = ? WHERE userId = ?");
    $stmt->execute([$username, $email, $alamat, $userId]);

    if($stmt){
        echo "<script>alert('Profil berhasil diperbarui'); location.href='?page=profil';</script>";
    }else{
        echo "<script>alert('Gagal memperbarui profil');</script>";
    }
}
?>



<style>
    body {
        background-color: #f5f7fa;
    }
    .profile-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 40px 30px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.05);
        transition: 0.3s;
    }
    .profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }
    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 20px;
        border: 4px solid #0d6efd;
    }
</style>

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="profile-card text-center">
                <img src="https://ui-avatars.com/api/?name=<?= $data['username'] ?>&background=0D6EFD&color=fff&size=120" class="profile-avatar" alt="Foto Profil">

                <div class="profile-info">
                    <h3><?= $data['username'] ?></h3>
                    <p><?= $data['email'] ?></p>
                </div>

                <hr>

                <div class="text-start mt-4">
                    <h6 class="text-uppercase text-muted mb-1">Alamat</h6>
                    <p><?= $data['alamat'] ?></p>
                </div>

                <button class="btn btn-primary w-100 mt-3" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profil</button>

            </div>

        </div>
    </div>
</main>

<!-- Modal Edit Profil -->
<div class="modal fade" id="editProfileModal" tabindex="-1">
  <div class="modal-dialog">
    <form action="" method="post" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Profil</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <input type="hidden" name="userId" value="<?= $userId ?>">

        <div class="mb-3">
          <label>Username</label>
          <input type="text" name="username" class="form-control" value="<?= $data['username'] ?>" required>
        </div>

        <div class="mb-3">
          <label>Email</label>
          <input type="email" name="email" class="form-control" value="<?= $data['email'] ?>" required>
        </div>

        <div class="mb-3">
          <label>Alamat</label>
          <textarea name="alamat" class="form-control" required><?= $data['alamat'] ?></textarea>
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" name="edit_profil">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>
