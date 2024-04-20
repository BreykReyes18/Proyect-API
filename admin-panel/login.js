document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault();

    var formData = new FormData(this);

    fetch('login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById("mensaje").innerText = data.mensaje;
        if (data.redireccionar) {
            window.location.href = data.redireccionar;
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
