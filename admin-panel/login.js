document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Evitar el envío predeterminado del formulario
    
    // Obtener los valores de usuario y contraseña del formulario
    var username = document.getElementById("Cedula").value;
    var password = document.getElementById("Clave").value;

    // Realizar la solicitud POST al servidor para validar las credenciales
    fetch('login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ username: username, password: password })
    })
    .then(response => response.json())
    .then(data => {
        // Mostrar el mensaje de respuesta del servidor en el elemento con ID "mensaje"
        document.getElementById("mensaje").innerText = data.mensaje;
        
        // Redirigir a la página de inicio si el inicio de sesión es exitoso
        if (data.redireccionar) {
            window.location.href = data.redireccionar;
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
