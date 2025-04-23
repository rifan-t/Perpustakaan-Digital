<?php
    $sql = "SELECT * FROM users WHERE role_id = :role_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(":role_id", 3, PDO::PARAM_INT); // Ganti bindParam dengan bindValue
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>

<div class="container mt-5">
    <div class="card-header text-dark">
        <h3 class="mb-0">Daftar User</h3>
    </div>
    
<table id="tabel-buku" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>IDUSER</th>
                    <th>Username</th>
                    <th>email </th>
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