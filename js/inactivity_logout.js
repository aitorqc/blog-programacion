var inactivityTimeout = 200000;
var logoutTimer;

function resetLogoutTimer(ev) {
    console.log(ev);
    clearTimeout(logoutTimer);
    logoutTimer = setTimeout(logoutInactiveUser, inactivityTimeout);
}

document.addEventListener("click", resetLogoutTimer);
document.addEventListener("keydown", resetLogoutTimer);
document.addEventListener('scroll', resetLogoutTimer);

function logoutInactiveUser() {
    window.location.href = "/cms/functions/logout.php";
}