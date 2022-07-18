<?php 
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "gudang");

function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	};
	return $rows;
};

function registrasi($data) {
	global $conn;

	$username = mysqli_real_escape_string($conn, $data["username"]);
	$password_sebelum = mysqli_real_escape_string($conn, $data["password"]);
	$nama = mysqli_real_escape_string($conn, $data["nama"]);

	// cek username admin sudah ada atau belum

	$cekusernameadmin = "SELECT * FROM admin where username='$username'";
	$prosescek= mysqli_query($conn, $cekusernameadmin);

	if (mysqli_num_rows($prosescek)>0) { 
	    echo "<script>alert('Username Sudah Digunakan!');history.go(-1) </script>";
	    exit;
	}


	// enkripsi password
	$password = password_hash($password_sebelum, PASSWORD_DEFAULT);

	// Masukkan Data ke Database
	mysqli_query($conn, "INSERT INTO admin VALUES('', '$username', '$password', '$nama')");
	return mysqli_affected_rows($conn);
}


function masuk($data) {
	global $conn;

	// htmlspecialchars berfungsi untuk tidak menjalankan script
	$nama_barang = htmlspecialchars($data["nama_barang"]);
	$brand = htmlspecialchars($data["brand"]);
	$tanggal_masuk = htmlspecialchars($data["tanggal_masuk"]);
	$jumlah = htmlspecialchars($data["jumlah"]);

		// tambahkan ke database
		// NULL digunakan karena jika dikosongkan maka akan terjadi error di database yang sudah online
		// sedangkan jika masih di localhost, bisa memakai ''
	mysqli_query($conn, "INSERT INTO barang_masuk VALUES(NULL, '$nama_barang', '$brand', '$tanggal_masuk', '$jumlah')");
	return mysqli_affected_rows($conn);
}

function keluar($data) {
	global $conn;

	// htmlspecialchars berfungsi untuk tidak menjalankan script
	$id = htmlspecialchars($data["id"]);
	$nama_barang = htmlspecialchars($data["nama_barang"]);
	$brand = htmlspecialchars($data["brand"]);
	$tanggal_keluar = htmlspecialchars($data["tanggal_keluar"]);
	$jumlah = htmlspecialchars($data["jumlah"]);

		// tambahkan ke database
		// NULL digunakan karena jika dikosongkan maka akan terjadi error di database yang sudah online
		// sedangkan jika masih di localhost, bisa memakai ''
	mysqli_query($conn, "INSERT INTO barang_keluar VALUES(NULL, '$id', '$nama_barang', '$brand', '$tanggal_keluar', '$jumlah')");
	return mysqli_affected_rows($conn);
}

function add($data) {
	global $conn;

	// htmlspecialchars berfungsi untuk tidak menjalankan script
	$nama = htmlspecialchars($data["nama"]);
	$brand = htmlspecialchars($data["brand"]);

	
	$cekbarang = "SELECT * FROM barang where nama = '$nama'";
	$prosescek= mysqli_query($conn, $cekbarang);

	if (mysqli_num_rows($prosescek)>0) { 
	    echo "<script>alert('Nama Barang Sudah Digunakan!');history.go(-1) </script>";
	    exit;
	}



	mysqli_query($conn, "INSERT INTO barang VALUES(NULL, '$nama', '$brand')");
	return mysqli_affected_rows($conn);
}


function hapusmasuk($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM barang_masuk WHERE id = $id");

	return mysqli_affected_rows($conn);
}

function hapuskeluar($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM barang_keluar WHERE id = $id");

	return mysqli_affected_rows($conn);
}

function hapus($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM barang WHERE id = $id");

	return mysqli_affected_rows($conn);
}