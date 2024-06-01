// Mengambil referensi tombol btn-icons
    var btnIcons = document.querySelector('.btn-icons');

    // Mengambil referensi section tambah-buku
    var tambahSubkategoriSection = document.getElementById('tambah-subkategori');

    // Menambahkan event listener untuk tombol btn-icons
    btnIcons.addEventListener('click', function() {
        // Toggle (menyembunyikan/menampilkan) class tambah-buku
        if (tambahSubkategoriSection.style.display === 'none') {
            tambahSubkategoriSection.style.display = 'block';
        } else {
            tambahSubkategoriSection.style.display = 'none';
        }
    });