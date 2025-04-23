<?php
session_start();
include_once 'lib/koneksi.php';
include_once 'modul/fungsi/Home.php';
include_once 'modul/fungsi/Peminjaman.php';


$userId = isset($_SESSION['user']) ? $_SESSION['user'] : null;
$data   = isset($_SESSION['data']) ? $_SESSION['data'] : [
  'userId'   => '-',
  'username' => '-',
    'email'    => '-',
    'alamat'   => '-'
];

include_once 'modul/component/header.php'; 
$page = isset($_GET['page'])?$_GET['page']:'';
if ($page) {
  if ($page =='home') {
        include "modul/halaman/home.php";
  }else{
    if($page=='koleksi') {
      include "modul/halaman/koleksi.php";
    }
    if($page=='kategori') {
      include "modul/halaman/kategori.php";
    }
    if($page=='profil') {
      include "modul/halaman/profil.php";
    }
    if($page=='riwayat_peminjaman') {
      include "modul/halaman/riwayat_peminjaman.php";
    }
    if($page=='pinjam_buku') {
      include "modul/halaman/pinjam_buku.php";
    }
    if($page=='detail_buku') {
        include "modul/halaman/detail_buku.php";
      }
    if($page=='kategoribyid') {
        include "modul/halaman/bukubykategori.php";
      }
      if($page=='baca_buku') {
        include "modul/halaman/baca_buku.php";
      }
    if($page=='buku_saya') {
        include "modul/halaman/buku_saya.php";
      }
    if($page=='logout') {
        include "modul/halaman/logout.php";
      }
      
  

  }    
}else{
  include "modul/halaman/home.php";
}

include_once 'modul/component/footer.php';

?>
