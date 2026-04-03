const grid = document.getElementById('home-grid');

function doLogin() {
    const email = document.getElementById('email').value;
    const pass = document.getElementById('password').value;
    if (!email || !pass) {
    document.getElementById('error-msg').style.display = 'block';
    return;
    }
    window.location.href = '/home';
}