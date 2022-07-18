// ambil elemen2 yang dibutuhkan
var keyword2 = document.getElementById('keyword2');
var keluar = document.getElementById('keluar');

// tambahkan event ketika keyword2 ditulis
keyword2.addEventListener('keyup', function() {
	// untuk select option gunakan 'change'

	// buat object ajax
	var xhr = new XMLHttpRequest();	

	// cek kesiapan ajax
	xhr.onreadystatechange = function() {
		if ( xhr.readyState == 4 && xhr.status == 200 ) {
			keluar.innerHTML = xhr.responseText;
		}
	}

	// eksekusi ajax
	xhr.open('GET', 'ajax/keluar.php?keyword2=' + keyword2.value, true);
	xhr.send();

});
