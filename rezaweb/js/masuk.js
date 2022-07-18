// ambil elemen2 yang dibutuhkan
var keyword1 = document.getElementById('keyword1');
var masuk = document.getElementById('masuk');

// tambahkan event ketika keyword1 ditulis
keyword1.addEventListener('keyup', function() {
	// untuk select option gunakan 'change'

	// buat object ajax
	var xhr = new XMLHttpRequest();	

	// cek kesiapan ajax
	xhr.onreadystatechange = function() {
		if ( xhr.readyState == 4 && xhr.status == 200 ) {
			masuk.innerHTML = xhr.responseText;
		}
	}

	// eksekusi ajax
	xhr.open('GET', 'ajax/masuk.php?keyword1=' + keyword1.value, true);
	xhr.send();

});
