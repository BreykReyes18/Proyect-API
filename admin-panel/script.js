document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registroForm');
    const mensaje = document.getElementById('mensaje');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const Cedula = document.getElementById('Cedula').value;
        const NombreCompleto = document.getElementById('NombreCompleto').value;
        const Correo = document.getElementById('Correo').value;
        const Clave = document.getElementById('Clave').value;
        const IdRol = document.getElementById('IdRol').value;
        const Estado = document.getElementById('Estado').value;

        const data = new URLSearchParams();
        data.append('Cedula', Cedula);
        data.append('NombreCompleto', NombreCompleto);
        data.append('Correo', Correo);
        data.append('Clave', Clave);
        data.append('IdRol', IdRol);
        data.append('Estado', Estado);

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
