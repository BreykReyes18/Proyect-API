document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registroForm');
    const mensaje = document.getElementById('mensaje');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const Codigo = document.getElementById('Codigo').value;
        const Nombre = document.getElementById('Nombre').value;
        const Correo = document.getElementById('Correo').value;
        const Clave = document.getElementById('Clave').value;
        const IdRol = document.getElementById('IdRol').value;

        const data = new URLSearchParams();
        data.append('Codigo', Codigo);
        data.append('Nombre', Nombre);
        data.append('Correo', Correo);
        data.append('Clave', Clave);
        data.append('IdRol', IdRol);

        fetch('registro.php', {
            method: 'POST',
            body: data
        })
        .then(response => response.json())
        .then(data => {
            mensaje.textContent = data.mensaje;
        })
        .catch(error => {
            mensaje.textContent = 'Error al registrar usuario.';
        });
    });
});
