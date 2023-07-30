<?php
function contact()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['issue']) && isset($_POST['content'])) {
            $to = "aquinoacordero@aitorqc.es";
            $issue = $_POST['issue'];
            $content = $_POST['content'];
            $headers = "From: " . $_SESSION['email'] . "\r\n";
            $headers .= "Reply-To: " . $_SESSION['email'] . "\r\n";
            $headers .= "X-Mailer: PHP/" . phpversion();

            // Enviar el correo
            if (mail($to, $issue, $content, $headers)) {
                return "Email has been sent";
            } else {
                return "error";
            }
        }
    }
}
