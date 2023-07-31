function updateLastActivity() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
            } else {
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