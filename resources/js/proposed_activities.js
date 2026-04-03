function toggleDropdown() {
    document.getElementById('my-dropdown').classList.toggle('open');
}
document.addEventListener('click', function (e) {
    if (!e.target.closest('.dropdown-wrapper')) {
        document.getElementById('my-dropdown').classList.remove('open');
    }
});


function confirmDelete($id) {
    if (confirm('Are you sure you want to delete this activity?')) {
        window.location.href = 'http://127.0.0.1:8000/delete-activity/'+id;
    }
}
