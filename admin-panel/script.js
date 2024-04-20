document.getElementById("registroForm").addEventListener("submit", function(event) {
    event.preventDefault();

    var formData = new FormData(this);

    fetch('registrar_usuario.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById("mensaje").innerText = data.mensaje;
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
