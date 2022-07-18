<?php 
session_start();

if (!isset($_SESSION['admin'])) {
   echo "<script>
         window.location.replace('login.php');
       </script>";
  exit;
}

require 'functions.php';

  $barang_keluar = mysqli_query($conn, "SELECT * FROM barang_keluar");

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
    <title>Gudang Jaya Bersama</title>
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
    
    
<div id="keluar">
    <center><h3>Laporan Barang Keluar</h3></center>
    <hr>
                       <table style="width:100%;">
                           <tr>
                               <th>Kode Barang</th>
                               <th>Nama Barang</th>
                               <th>Brand</th>
                               <th>Tanggal Keluar</th>
                               <th>Jumlah</th>
                           </tr>
                <?php foreach ($barang_keluar as $keluar) : ?>
                           <tr>
                               <td><?= $keluar["id"]; ?></td>
                               <td><?= $keluar["nama_barang"]; ?></td>
                               <td><?= $keluar["brand"]; ?></td>
                               <td><?= date("d F Y",strtotime($keluar["tanggal_keluar"])); ?></td>
                               <td><?= $keluar["jumlah"]; ?></td>
                           </tr>
                 <?php endforeach; ?>
                       </table>
</div>
                    

    <script src="js/keluar.js"></script>
    <script src="js/keluar.js"></script>

    <script>
        window.print();
    </script>
</body>
</html>