
<!doctype html>
<html lang="en">

<head>
    <title>Teman Baca</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" href="assets/img/logo.png" type="image/png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        
        .card {
            transition: transform 0.3s;
            height: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .card-img-top {
            height: 250px;
            object-fit: cover;
        }

        .btn-action {
            transition: all 0.3s;
        }

        .btn-action:hover {
            transform: scale(1.05);
        }

        .bg-library {
            background-color: #f8f9fa;
            background-image: linear-gradient(120deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            height: 90px;
            padding-left: 70px;
        }
        .navbar-brands {
            font-weight: bold;
            color: #0d6efd !important;
        }
        .navbar-brands img{
            width: 200px;
            height: auto;
            left: 660px;
            position: absolute;
            top: -13px;
        }


        .navbar-brand {
            font-weight: bold;
            color: #0d6efd !important;
        }
        .navbar-brand img{
            width: 200px;
            height: auto;
            position: absolute;
            top: -13px;
            left: -10px;
        }

        .page-header {
            background: #0d6efd;
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            border-radius: 0 0 20px 20px;
        }

        footer {
            border-top: 1px solid #dee2e6;
        }
    </style>
</head>

<body>
    <header>
        <?php if(empty($_SESSION['user'])):?>
        <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
            <div class="container">
                
                <a class="navbar-brands" href="#">
                    <!-- logo -->
                    <center> <img src="assets/img/logo.png" width="200" height="" alt="">
                    </center></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                       
                    </ul>
                    <div class="d-flex">
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="userDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-1"></i>
                                <?php echo isset($data['username']) ? $data['username'] : 'Pengguna'; ?>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="login.php"><i
                                            class="fas fa-user me-1"></i> Login</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                <li><a class="dropdown-item" href="registrasi.php"><i
                                            class="fas fa-user-plus me-1"></i> Buat Akun</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
                <?php else: ?>
                    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
            <div class="container">
               
                <a class="navbar-brand" href="#">
                <img src="assets/img/logo.png" width="100" height="" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link active" href="?page=home"><i
                                    class="fas fa-home me-1"></i> Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="?page=koleksi"><i
                                    class="fas fa-book me-1"></i> Koleksi Buku</a></li>
                        <li class="nav-item"><a class="nav-link" href="?page=kategori"><i
                                    class="fas fa-tags me-1"></i> Kategori</a></li>
                                    <li class="nav-item"><a class="nav-link" href="?page=riwayat_peminjaman"><i
                                            class="fas fa-user me-1"></i>Peminjaman Saya</a></li>
                                <li><a class="nav-link" href="?page=buku_saya"><i
                                class="fas fa-book-open me-1"></i>Buku Saya</a></li>
                    </ul>
                    <div class="d-flex">
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="userDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-1"></i>
                                <?php echo isset($data['username']) ? $data['username'] : 'Pengguna'; ?>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="?page=profil"><i
                                            class="fas fa-user me-1"></i> Profil</a></li>
                                <li><a class="dropdown-item" href="?page=riwayat_peminjaman"><i
                                            class="fas fa-user me-1"></i> Riwayat Peminjaman</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="?page=logout"><i
                                            class="fas fa-sign-out-alt me-1"></i> Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
<?php endif; ?>

        <div class="page-header text-center">
            <div class="container">
                <h1 class="display-4 fw-bold">TemanBaca</h1>
                <p class="lead">Temukan ribuan buku digital untuk menambah wawasan Anda agar bisa ngobrol segala macem sama doi</p>
                <div class="mt-4">

                </div>
            </div>
        </div>
    </header>