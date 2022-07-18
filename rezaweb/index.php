<?php 
session_start();

if (!isset($_SESSION['admin'])) {
   echo "<script>
         window.location.replace('login.php');
       </script>";
  exit;
}

require 'functions.php';

  $barang = mysqli_query($conn, "SELECT * FROM barang");
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

if (isset($_POST["add"])) {
  
  if (add($_POST) > 0 ) {
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


         $("#form3").hide();

         $("#btn-hide3").click(function() {
           $("#form3").hide();
         })

         $("#btn-show3").click(function() {
           $("#form3").show();
         })
         $("#btn-hide4").click(function() {
           $("#form3").hide();
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
     <header>
        <nav>
            <ul>
                <li><a href="logout.php" class="btn" style="border-bottom: none;">Logout <i class="fas fa-power-off fa-1x"></i></a></li>
            </ul>
        </nav>
        <div class="jumbotron">

        <div class="container fadeIn first d-flex wrapper">
            <div class="row content m-auto">
                <div class="col-md-6 m-auto">
                    <img width=100 height=100 src="../phprezaa/logo.jpg" class="img-fluid animated">
        </div>
        
            <h3>Richeese Factory <i class="fab fa-accusoft"></i></h3>
        </div>
    </header>

    <main>
         <article class="card">
                <center><h3 style="color:royalblue;">Data Barang Masuk dan Keluar</h3></center>
        </article>

        <div id="content">

            <div class="flex">


                <article class="card" id="form3">
                <form action="" method="post">
                <h1>Form Data Barang</h1>
                    <div class="jarak">
                         <label for="nama">Nama Barang</label>
                         <input type="text" id="nama" name="nama" required>
                    </div>
                    <div class="jarak">
                         <label for="brand">Kode</label>
                         <input type="text" id="brand" name="brand" required>
                    </div>
                    <button type="submit" name="add" class="btn" style="width: 100%;padding:10px;background-color: royalblue;">Tambah</button>
                    <br><br>
                    <a href="#" id="btn-hide4" class="btn-a">Batal</a>
                </form>
            </article>

            <div class="card">
                    <center>
                        <h3 style="color:green;">Data Barang</h3>
                        <br><br>
                        <hr>
                       <table style="width:100%;">
                           <tr>
                               <th>Nama Barang</th>
                               <th>Kode</th>
                               <th colspan="2">Aksi</th>
                           </tr>
                <?php foreach ($barang as $b) : ?>
                           <tr>
                               <td><span style="color: royalblue;cursor: pointer;"><?= $b["nama"]; ?></span></td>
                               <td><?= $b["brand"]; ?></td>
                               <td> 
                                <a href="hapus.php?id=<?= $b["id"]; ?>">Hapus</a>
                               </td>
                           </tr>
                 <?php endforeach; ?>
                       </table>
                    </center>
               </div>


            <article class="card" id="form1">
                <form action="" method="post">
                <h1>Form Data Barang Masuk</h1>
                    <div class="jarak">
                         <label for="nama_barang">Nama Barang</label>
                         <select name="nama_barang" id="nama_barang" required>
                                <option value="" hidden>Pilih Nama Barang</option>
                            <?php foreach ($barang as $m) : ?>
                                <option value="<?= $m['nama']; ?>"><?= $m['nama']; ?></option>
                            <?php endforeach; ?>
                         </select>
                    </div>
                    <div class="jarak">
                         <label for="brand">Kode</label>
                         <select name="brand" id="brand" required>
                                <option value="" hidden>Pilih Kode</option>
                            <?php foreach ($barang as $b) : ?>
                                <option value="<?= $b['brand']; ?>"><?= $b['brand']; ?></option>
                            <?php endforeach; ?>
                         </select>
                    </div>
                    <div class="jarak">
                         <label for="tanggal_masuk">Tanggal Masuk</label>
                         <input type="date" id="tanggal_masuk" name="tanggal_masuk" required>
                    </div>
                    <div class="jarak">
                         <label for="jumlah">Jumlah</label>
                         <input type="number" id="jumlah" name="jumlah" placeholder="Masukkan Jumlah Barang Masuk" required>
                    </div>
                    <button type="submit" name="masuk" class="btn" style="width: 100%;padding:10px;background-color: royalblue;">Tambah</button>
                    <br><br>
                    <a href="#" id="btn-hide1" class="btn-a">Batal</a>
                </form>
            </article>

                <div class="card">
                    <center>
                        <h3 style="color:green;">Barang Masuk</h3>
                        <small><a target="_blank" href="cetak-masuk.php" class="btn" style="background-color:royalblue;">Cetak Data</a></small>
                        <br><br>
                        <hr>
                        <form action="" method="post">
                           <input type="search" name="keyword1" id="keyword1" placeholder="Cari Barang Berdasarkan Kode / Nama / Brand" style="margin-bottom:20px;">
                        </form>
<div id="masuk">
                       <table style="width:100%;">
                           <tr>
                               <th>Kode Barang</th>
                               <th>Nama Barang</th>
                               <th>Kode</th>
                               <th>Tanggal Masuk</th>
                               <th>Jumlah</th>
                               <th colspan="2" style="text-align: center;">Aksi</th>
                           </tr>
                <?php foreach ($barang_masuk as $masuk) : ?>
                           <tr>
                               <td><?= $masuk["id"]; ?></td>
                               <td><span style="color: royalblue;cursor: pointer;"><?= $masuk["nama_barang"]; ?></span></td>
                               <td><?= $masuk["brand"]; ?></td>
                               <td><?= date("d F Y",strtotime($masuk["tanggal_masuk"])); ?></td>
                               <td><?= $masuk["jumlah"]; ?></td>
                               <td> 
                                <a href="edit-masuk.php?id=<?= $masuk["id"]; ?>">Edit</a>
                               </td>
                               <td> 
                                <a href="hapus-masuk.php?id=<?= $masuk["id"]; ?>">Hapus</a>
                               </td>
                           </tr>
                 <?php endforeach; ?>
                       </table>
</div>
                    </center>
               </div>

               <article class="card" id="form2">
                <form action="" method="post">
                <h1>Form Data Barang Keluar</h1>
                    <div class="jarak">
                         <label for="id">Kode Barang</label>
                         <select name="id" id="id">
                             <option value="" hidden>Pilih Kode Barang</option>
                             <?php foreach ($barang_masuk as $masuk) : ?>
                             <option value="<?= $masuk["id"]; ?>"><?= $masuk["id"]; ?></option>
                             <?php endforeach; ?>
                         </select>
                    </div>
                    <div class="jarak">
                         <label for="nama_barang">Nama Barang</label>
                         <select name="nama_barang" id="nama_barang" required>
                                <option value="" hidden>Pilih Nama Barang</option>
                            <?php foreach ($barang as $m) : ?>
                                <option value="<?= $m['nama']; ?>"><?= $m['nama']; ?></option>
                            <?php endforeach; ?>
                         </select>
                    </div>
                    <div class="jarak">
                         <label for="brand">Kode</label>
                         <select name="brand" id="brand" required>
                                <option value="" hidden>Pilih Kode</option>
                            <?php foreach ($barang as $b) : ?>
                                <option value="<?= $b['brand']; ?>"><?= $b['brand']; ?></option>
                            <?php endforeach; ?>
                         </select>
                    </div>
                    <div class="jarak">
                         <label for="tanggal_keluar">Tanggal keluar</label>
                         <input type="date" id="tanggal_keluar" name="tanggal_keluar" required>
                    </div>
                    <div class="jarak">
                         <label for="jumlah">Jumlah</label>
                         <input type="number" id="jumlah" name="jumlah" placeholder="keluarkan Jumlah Barang keluar" required>
                    </div>
                    <button type="submit" name="keluar" class="btn" style="width: 100%;padding:10px;background-color: royalblue;">Tambah</button>
                    <br><br>
                    <a href="#" id="btn-hide2" class="btn-a">Batal</a>
                </form>
            </article>

               <div class="card">
                    <center>
                        <h3 style="color:red;">Barang Keluar</h3>
                        <small><a target="_blank" href="cetak-keluar.php" class="btn" style="background-color:royalblue;">Cetak Data</a></small>
                        <br><br>
                        <hr>
                        <form action="" method="post">
                           <input type="search" name="keyword2" id="keyword2" placeholder="Cari Barang Berdasarkan Kode / Nama / Brand" style="margin-bottom:20px;">
                        </form>
<div id="keluar">
                       <table style="width:100%;">
                           <tr>
                               <th>Kode Barang</th>
                               <th>Nama Barang</th>
                               <th>Kode</th>
                               <th>Tanggal Keluar</th>
                               <th>Jumlah</th>
                               <th colspan="2" style="text-align: center;">Aksi</th>
                           </tr>
                <?php foreach ($barang_keluar as $keluar) : ?>
                           <tr>
                               <td><?= $keluar["id"]; ?></td>
                               <td><span style="color: royalblue;cursor: pointer;"><?= $keluar["nama_barang"]; ?></span></td>
                               <td><?= $keluar["brand"]; ?></td>
                               <td><?= date("d F Y",strtotime($keluar["tanggal_keluar"])); ?></td>
                               <td><?= $keluar["jumlah"]; ?></td>
                               <td> 
                                <a href="edit-keluar.php?id_keluar=<?= $keluar["id_keluar"]; ?>">Edit</a>
                               </td>
                               <td> 
                                <a href="hapus-keluar.php?id=<?= $keluar["id_keluar"]; ?>">Hapus</a>
                               </td>
                           </tr>
                 <?php endforeach; ?>
                       </table>
</div>
                    </center>
               </div>

               <div class="card">
                   <center><h3>Stock Barang</h3>
                   <small><a target="_blank" href="cetak-stock.php" class="btn" style="background-color:royalblue;">Cetak Data</a></small>
                        <br><br></center>
                   <hr>
                   <table style="width:100%;">
                           <tr>
                               <th>Kode Barang</th>
                               <th>Nama Barang</th>
                               <th>Kode</th>
                               <th>Jumlah</th>
                           </tr>
                <?php foreach ($stock as $s) : ?>
                           <tr>
                               <td><?= $s["id_masuk"]; ?></td>
                               <td><span style="color: royalblue;cursor: pointer;"><?= $s["nama_barang"]; ?></span></td>
                               <td><?= $s["brand"]; ?></td>
                               <?php if (empty($s["sisa"])) : ?>
                               <td><?= $s["jumlah"]; ?></td>
                               <?php else: ?>
                               <td><?= $s["sisa"]; ?></td>
                               <?php endif; ?>
                           </tr>
                 <?php endforeach; ?>
                       </table>
               </div>


            </div>

        </div>

        <aside>
            <a href="#form3" id="btn-show3" style="text-decoration: none;"><div class="card">
                <center><p>Tambah Barang</p></center>
            </div></a>

            <a href="#form1" id="btn-show1" style="text-decoration: none;"><div class="card">
                <center><p>Barang Masuk</p></center>
            </div></a>

            <a href="#form2" id="btn-show2" style="text-decoration: none;"><div class="card">
                <center><p>Barang Keluar</p></center>
            </div></a>
        </aside>

    </main>

   <footer>
        <p>&#169 Richeese Factory <i class="fab fa-accusoft"></i> 2022</p>
    </footer>

    <script src="js/masuk.js"></script>
    <script src="js/keluar.js"></script>
</body>
</html>