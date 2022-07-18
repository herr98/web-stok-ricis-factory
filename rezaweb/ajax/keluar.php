<?php 
session_start();

if (!isset($_SESSION['admin'])) {
   echo "<script>
         window.location.replace('login.php');
       </script>";
  exit;
}

require '../functions.php';

  $barang_keluar = mysqli_query($conn, "SELECT * FROM barang_keluar");

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

$keyword2 = $_GET["keyword2"];

$query = "SELECT * FROM barang_keluar
      WHERE
      id LIKE '%$keyword2%' OR
      nama_barang LIKE '%$keyword2%' OR
      brand LIKE '%$keyword2%'
        ";
$barang_keluar = query($query);

if (empty($barang_keluar)){
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


            
<div id="keluar">
                       <table style="width:100%;">
                           <tr>
                               <th>Kode Barang</th>
                               <th>Nama Barang</th>
                               <th>Kode</th>
                               <th>Tanggal Keluar</th>
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
                <?php foreach ($barang_keluar as $keluar) : ?>
                           <tr>
                               <td><?= $keluar["id"]; ?></td>
                               <td><span style="color: royalblue;cursor: pointer;"><?= $keluar["nama_barang"]; ?></span></td>
                               <td><?= $keluar["brand"]; ?></td>
                               <td><?= date("d F Y",strtotime($keluar["tanggal_keluar"])); ?></td>
                               <td><?= $keluar["jumlah"]; ?></td>
                               <td> 
                                <a href="hapus-keluar.php?id=<?= $keluar["id"]; ?>">Hapus</a>
                            </td>
                           </tr>
                 <?php endforeach; ?>
                       </table>
</div>

    <script src="js/keluar.js"></script>
</body>
</html>
