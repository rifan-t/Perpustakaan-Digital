
<?php

session_start();
include_once '../lib/koneksi.php';
include_once 'fungsi/Buku.php';

include_once 'fungsi/ebook.php';
include_once 'fungsi/Peminjaman.php';

include_once 'component/header.php';
include_once 'component/sidebar.php';
include_once 'component/topbar.php';
$data = $_SESSION['data'];
if ($data['role_id'] == 3 || !isset($_SESSION['user'])) {
    echo "<script>alert('Anda tidak memiliki akses ke halaman ini'); location.href='../login.php';</script>";
    exit();
}

$page = isset($_GET['page'])?$_GET['page']:'';
if ($page) {
  if ($page =='dashboard') {
        include "halaman/dashboard.php";
  }else{
    if($page=='data_buku') {
      include "halaman/data_buku.php";
    }
    if($page=='data_ebook') {
      include "halaman/data_ebook.php";
    }
    if($page=='my_profile') {
      include "halaman/my_profile.php";
    }
    if($page=='kategori_buku') {
      include "halaman/kategori_buku.php";
    }
    if($page=='data_peminjaman') {
      include "halaman/data_peminjaman.php";
    }
    if($page=='ubah_status_peminjaman') {
      include "halaman/ubah_status_peminjaman.php";
    }
    if($page=='edit_buku') {
      include "halaman/edit_buku.php";
    }
    if($page=='detail_buku') {
      include "halaman/detail_buku.php";
    }
    if($page=='data_user') {
      include "halaman/data_user.php";
    }
    if($page=='data_petugas') {
      include "halaman/data_petugas.php";
    }
    if($page=='logout') {
        include "halaman/logout.php";
      }
      if($page=='ulasan_user') {
        include "halaman/ulasan_user.php";
      }
  }    
}else{
  include "halaman/dashboard.php";
}

include_once 'component/footer.php';    
?>