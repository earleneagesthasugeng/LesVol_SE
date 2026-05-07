function toggleDropdown() {
    document.getElementById('my-dropdown').classList.toggle('open');
}
document.addEventListener('click', function (e) {
    if (!e.target.closest('.dropdown-wrapper')) {
        document.getElementById('my-dropdown').classList.remove('open');
    }
});


function confirmDelete(id) {
    if (confirm('Are you sure you want to delete this activity?')) {
        window.location.href = '/delete-activity/' + id;
    }
}

function markAsDone(id) {
    if (confirm('Are you sure you want to mark this activity as done?')) {
        window.location.href = '/mark-done-activity/' + id;
    }
}
