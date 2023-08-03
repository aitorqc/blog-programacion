var inactivityTimeout = 500000;
var logoutTimer;

function resetLogoutTimer(ev) {
    clearTimeout(logoutTimer);
    logoutTimer = setTimeout(logoutInactiveUser, inactivityTimeout);
}

document.addEventListener("click", resetLogoutTimer);
document.addEventListener("keydown", resetLogoutTimer);
document.addEventListener('scroll', resetLogoutTimer);

function logoutInactiveUser() {
    window.location.href = "/cms/functions/logout.php";
}