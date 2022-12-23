function changeInputType() {
    const password = document.getElementById('password');
    const passwordIndicator = document.getElementById('password-indicator');

    if (password.type === 'password') {
        password.type = 'text';
        passwordIndicator.innerHTML = 'visibility_off';
    } else {
        password.type = 'password';
        passwordIndicator.innerHTML = 'visibility';
    }
}
