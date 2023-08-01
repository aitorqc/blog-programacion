var inactivityTimeout = 900000;
var logoutTimer;

function resetLogoutTimer(ev) {
    clearTimeout(logoutTimer);
    logoutTimer = setTimeout(logoutInactiveUser, inactivityTimeout);
}

document.addEventListener("click", resetLogoutTimer);
document.addEventListener("keydown", resetLogoutTimer);
document.addEventListener('scroll', resetLogoutTimer);

function logoutInactiveUser() {
    window.location.href = "./functions/logout.php";
}