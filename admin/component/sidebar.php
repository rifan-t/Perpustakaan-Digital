<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Dashboard</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                    </div>
                    
                </div>
                <div class="navbar-nav w-100 mt-2">
                    <a href="?page=dashboard" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Data Buku</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="?page=data_buku" class="dropdown-item">Data Buku</a>
                            <a href="?page=data_ebook" class="dropdown-item">Data E-book</a>
                            <a href="?page=kategori_buku" class="dropdown-item">Kategori Buku</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Data Peminjaman</a>
                        <div class="dropdown-menu bg-transparent border-0">
                        <a href="?page=data_peminjaman" class="dropdown-item"><i class="fa fa-th me-2"></i>Data Peminjaman</a>
                        </div>
                    </div>
                    <a href="?page=data_user" class="nav-item nav-link"><i class="far fa-angry me-2"></i>Data User</a>                    
<?php 
if($_SESSION['data']['role_id'] == 1){
?>
                    <a href="?page=data_petugas" class="nav-item nav-link"><i class="fas fa-baby me-2"></i>Data Petugas</a> 
<?php } 
?>                
                    <a href="?page=ulasan_user" class="nav-item nav-link"><i class="far fa-angry me-2"></i>Ulasan USer</a>                    
                    </div>
                
            </nav>
        </div>
        <!-- Sidebar End -->


  