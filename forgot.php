<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<!-- Navigation -->

<?php include "includes/navigation.php"; ?>

<?php
if ($_SESSION['username']) {
    header("Location: /cms/");
    exit();
}

if (isset($_POST['recover_submit'])) {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $length = 50;
        $token = bin2hex(openssl_random_pseudo_bytes($length));
        echo $token;

        $query = "SELECT user_email FROM users WHERE user_email = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);

        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            $stmt = mysqli_prepare($connection, "UPDATE users SET token='{$token}' WHERE user_email = ?");
            mysqli_stmt_bind_param($stmt, "s", $email);

            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt); 
        } else {
            
        }
    }
}
?>


<!-- Page Content -->
<div class="container-fluid" style="height: 80vh;">
    <div class="row centered">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">

                        <h3><i class="fa fa-lock fa-4x"></i></h3>
                        <h2 class="text-center">Forgot Password?</h2>
                        <p>You can reset your password here.</p>
                        <div class="panel-body">

                            <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                        <input id="email" name="email" placeholder="email address" class="form-control" type="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input name="recover_submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                </div>

                                <input type="hidden" class="hide" name="token" id="token" value="">
                            </form>

                        </div>
                        <!-- Body-->
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- /.container -->

    <style>
        body {
            height: 100vh;
        }

        .centered {
            height: 100%;
            display: flex;
            align-items: center;
        }
    </style>

    <hr>

    <?php include "includes/footer.php"; ?>