<?php 
session_start();

if (!isset($_SESSION['admin'])) {
   echo "<script>
         window.location.replace('login.php');
       </script>";
  exit;
}



require 'functions.php';

function ubah($data) {
    global $conn;
     
    $id_keluar = $_GET["id_keluar"];
    $nama_barang = $data["nama_barang"];
    $brand = $data["brand"];
    $tanggal_keluar = $data["tanggal_keluar"];
    $jumlah = $data["jumlah"];

    $query = "UPDATE barang_keluar SET 
                nama_barang = '$nama_barang',
                brand = '$brand',
                tanggal_keluar = '$tanggal_keluar',
                jumlah = '$jumlah'
              WHERE id_keluar = $id_keluar
            ";
            
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

$id_keluar = $_GET["id_keluar"];
$barang_keluar = query("SELECT * FROM barang_keluar WHERE id_keluar = $id_keluar")[0];

if (isset($_POST["edit"])) {
  
  if (ubah($_POST) > 0 ) {
     echo "<script>
        alert('Data Berhasil Diubah!');
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
     <header>
        <nav>
            <ul>
                <li><a href="logout.php" class="btn" style="border-bottom: none;">Logout <i class="fas fa-power-off fa-1x"></i></a></li>
            </ul>
        </nav>
        <div class="jumbotron">
            <h3>Gudang Jaya Bersama <i class="fab fa-accusoft"></i></h3>
        </div>
    </header>

    <main>
         <article class="card">
                <center><h3 style="color:royalblue;">Edit Barang Keluar</h3></center>
        </article>

        <div id="content" style="width: 100%;">

            <div class="flex">

            <article class="card" id="form1">
                <form action="" method="post">
                    <div class="jarak">
                         <label for="nama_barang">Nama Barang</label>
                         <input type="text" id="nama_barang" name="nama_barang" value="<?= $barang_keluar["nama_barang"]; ?>" placeholder="Masukkan Nama Barang" required>
                    </div>
                    <div class="jarak">
                         <label for="brand">Brand</label>
                         <input type="text" id="brand" name="brand" value="<?= $barang_keluar["brand"]; ?>" placeholder="Masukkan Brand" required>
                    </div>
                    <div class="jarak">
                         <label for="tanggal_keluar">Tanggal Keluar</label>
                         <input type="date" id="tanggal_keluar" value="<?= $barang_keluar["tanggal_keluar"]; ?>" name="tanggal_keluar" required>
                    </div>
                    <div class="jarak">
                         <label for="jumlah">Jumlah</label>
                         <input type="number" id="jumlah" value="<?= $barang_keluar["jumlah"]; ?>" name="jumlah" placeholder="Masukkan Jumlah Barang Masuk" required>
                    </div>
                    <button type="submit" name="edit" class="btn" style="width: 100%;padding:10px;background-color: royalblue;">Edit</button>
                    <br><br>
                    <a href="index.php" id="btn-hide1" class="btn-a">Batal</a>
                </form>
            </article>

            </div>
        </div>
           
    </main>

   <footer>
        <p>&#169 Gudang Jaya Bersama <i class="fab fa-accusoft"></i> 2021</p>
    </footer>

    <script src="js/masuk.js"></script>
    <script src="js/keluar.js"></script>
</body>
</html>