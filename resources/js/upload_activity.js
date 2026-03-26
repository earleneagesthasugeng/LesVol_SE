function toggleDropdown() {
    document.getElementById('my-dropdown').classList.toggle('open');
}
document.addEventListener('click', function(e) {
    if (!e.target.closest('.dropdown-wrapper')) {
    document.getElementById('my-dropdown').classList.remove('open');
    }
});


function openModal(id) { document.getElementById(id).classList.add('open'); }
  function closeModal(id) { document.getElementById(id).classList.remove('open'); }
  document.querySelectorAll('.modal-overlay').forEach(el => {
    el.addEventListener('click', e => { if (e.target === el) el.classList.remove('open'); });
  });
  function previewImage(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(ev) {
      const box = document.querySelector('.upload-img-box');
      let img = box.querySelector('img');
      if (!img) {
          img = document.createElement('img');
          img.style.width = '100%';
          img.style.height = '100%';
          img.style.objectFit = 'cover';
          img.style.borderRadius = '14px';
          const span = box.querySelector('span');
          if (span) span.style.display = 'none';
          box.appendChild(img);
      }
      img.src = ev.target.result;
    };
    reader.readAsDataURL(file);
  }
  function handleProposal(e) {
    const file = e.target.files[0];
    if (file) {
      closeModal('modal-upload-proposal');
      alert(`Proposal "${file.name}" berhasil dipilih!`);
    }
  }



