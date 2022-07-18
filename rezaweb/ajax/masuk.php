<?php 
session_start();

if (!isset($_SESSION['admin'])) {
   echo "<script>
         window.location.replace('login.php');
       </script>";
  exit;
}

require '../functions.php';

  $barang_masuk = mysqli_query($conn, "SELECT * FROM barang_masuk");
  $barang_keluar = mysqli_query($conn, "SELECT * FROM barang_keluar");
  $stock = mysqli_query($conn, "SELECT barang_masuk.id as id_masuk, barang_masuk.nama_barang as nama_barang, barang_masuk.brand as brand, barang_masuk.jumlah as jumlah, barang_masuk.jumlah - barang_keluar.jumlah as sisa FROM barang_masuk LEFT JOIN barang_keluar ON barang_masuk.id = barang_keluar.id");

if (isset($_POST["masuk"])) {
  
  if (masuk($_POST) > 0 ) {
     echo "<script>
        alert('Data Berhasil Ditambahkan!');
        window.location.href='index.php';
      </script>";
  } else {
    echo mysqli_error($conn);
  }

} 


if (isset($_POST["keluar"])) {
  
  if (keluar($_POST) > 0 ) {
     echo "<script>
        alert('Data Berhasil Ditambahkan!');
        window.location.href='index.php';
      </script>";
  } else {
    echo mysqli_error($conn);
  }

} 

$keyword1 = $_GET["keyword1"];

$query = "SELECT * FROM barang_masuk
      WHERE
      id LIKE '%$keyword1%' OR
      nama_barang LIKE '%$keyword1%' OR
      brand LIKE '%$keyword1%'
        ";
$barang_masuk = query($query);

if (empty($barang_masuk)){
  $error = true;
} 
  
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/348c676099.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script>
         $(document).ready(function() {

         $("#form1").hide();

         $("#btn-hide1").click(function() {
           $("#form1").hide();
         })

         $("#btn-show1").click(function() {
           $("#form1").show();
         })

         $("#form2").hide();

         $("#btn-hide2").click(function() {
           $("#form2").hide();
         })

         $("#btn-show2").click(function() {
           $("#form2").show();
         })

       });
    </script>
    <title>Richeese Factory</title>
    <style>
        .btn {
            text-decoration: none;
            padding: 3px 10px;
            background-color: darkred;
        } 
        body {
          background-image: url("../images/bg.jpeg");
          background-size: contain;
        }
        th, td {
            padding: 10px 40px;
            text-align: justify;
        }
    </style>
</head>

<body>


            
<div id="masuk">
                       <table style="width:100%;">
                           <tr>
                               <th>Kode Barang</th>
                               <th>Nama Barang</th>
                               <th>Kode</th>
                               <th>Tanggal Masuk</th>
                               <th>Jumlah</th>
                               <th>Aksi</th>
                           </tr>
                           <?php if (isset($error)) : ?>
              <tr style="background-color: white !important;">
                  <td><small><span style="color:red;">*data tidak ditemukan</span></small></td>
                  <td><small><span style="color:red;">*data tidak ditemukan</span></small></td>
                  <td><small><span style="color:red;">*data tidak ditemukan</span></small></td>
                  <td><small><span style="color:red;">*data tidak ditemukan</span></small></td>
                  <td><small><span style="color:red;">*data tidak ditemukan</span></small></td>
                  <td><small><span style="color:red;">*data tidak ditemukan</span></small></td>
              </tr>
            <?php endif; ?>
                <?php foreach ($barang_masuk as $masuk) : ?>
                           <tr>
                               <td><?= $masuk["id"]; ?></td>
                               <td><span style="color: royalblue;cursor: pointer;"><?= $masuk["nama_barang"]; ?></span></td>
                               <td><?= $masuk["brand"]; ?></td>
                               <td><?= date("d F Y",strtotime($masuk["tanggal_masuk"])); ?></td>
                               <td><?= $masuk["jumlah"]; ?></td>
                               <td> 
                                <a href="hapus-masuk.php?id=<?= $masuk["id"]; ?>">Hapus</a>
                            </td>
                           </tr>
                 <?php endforeach; ?>
                       </table>
</div>

    <script src="js/masuk.js"></script>
</body>
</html>
