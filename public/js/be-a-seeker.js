const fileInput = document.getElementById('file-input');
const dropzone = document.getElementById('dropzone');
const uploadTrigger = document.getElementById('upload-trigger');
const preview = document.getElementById('image-preview');
const placeholder = document.getElementById('upload-placeholder');

// 1. Klik area box atau tombol upload untuk buka file manager
dropzone.addEventListener('click', () => fileInput.click());
uploadTrigger.addEventListener('click', () => {
    if(fileInput.files.length === 0) {
        fileInput.click();
    } else {
        alert('File siap diunggah ke server!');
        // Di sini kamu bisa tambahkan logika upload ke database
    }
});

// 2. Logika untuk menampilkan gambar setelah dipilih
fileInput.addEventListener('change', function() {
  const file = this.files[0];
  if (file) {
    const reader = new FileReader();
    
    reader.onload = function(e) {
      preview.src = e.target.result;
      preview.style.display = 'block';      // Tampilkan preview
      placeholder.style.display = 'none';   // Sembunyikan ikon upload
      dropzone.style.borderStyle = 'solid'; // Ubah border jadi solid
    }
    
    reader.readAsDataURL(file);
  }
});