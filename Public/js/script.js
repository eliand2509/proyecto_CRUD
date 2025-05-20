document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('login-form');

    loginForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        const usuario = document.getElementById('usuario').value;
        const contrasena = document.getElementById('contrasena').value;

        console.log('Usuario:', usuario);
        console.log('Contraseña:', contrasena);
        alert('Inicio de sesión exitoso'); 
    });
});    