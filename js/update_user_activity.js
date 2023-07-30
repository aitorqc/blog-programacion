function updateLastActivity() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                // La solicitud se completó correctamente
                console.log("Respuesta del servidor:");
                console.log(this.responseText); // Mostrar la respuesta en la consola para depurar
            } else {
                // Si el estado no es 200, hubo un error en la solicitud
                console.log("Error en la solicitud AJAX. Estado: " + this.status);
            }
        }
    };
    xhttp.open("GET", "./admin/functions/update_last_activity.php", true);
    xhttp.send();
}

document.addEventListener('DOMContentLoaded', function () {
    // Adjuntar el evento de clic a la función updateLastActivity
    document.addEventListener('click', updateLastActivity);
});