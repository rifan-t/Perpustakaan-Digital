<?php


?>
<div class="container mt-5">

    <div class="card-header">
        <h3 class="mb-0">Profil Saya</h3>
    </div>

    <div class="mt-5 p-4">
    <h4>Username: <?= $data['username']?></h4>
        <h4>Email: <?= $data['email']?></h4>
        <h4> Alamat: <?= $data['alamat']?></h4>
     
    </div>
    <a href="?page=dashboard" class="btn btn-secondary me-2">Kembali</a>

</div>