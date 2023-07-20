<?php
$error = add_user();
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">User Name</label>
        <input type="text" class="form-control" name="username" id="username">
    </div>

    <div class="form-group">
        <label for="user_password">User Password</label>
        <div class="input-group">
            <input type="password" class="form-control" name="user_password" id="user_password">
            <span class="input-group-addon" onclick="checkPassword()">
                <span id="password_icon" class="glyphicon glyphicon-eye-open"></span>
            </span>
            <script>
                function checkPassword() {
                    let x = document.getElementById("user_password");
                    let icon = document.getElementById("password_icon");

                    if (x.type === "password") {
                        x.type = "text";
                        icon.classList.remove("glyphicon-eye-open");
                        icon.classList.add("glyphicon-eye-close");
                    } else {
                        x.type = "password";
                        icon.classList.remove("glyphicon-eye-close");
                        icon.classList.add("glyphicon-eye-open");
                    }
                }
            </script>
        </div>
    </div>

    <div class="form-group">
        <label for="user_firstname">FirstName</label>
        <input type="text" class="form-control" name="user_firstname" id="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">LastName</label>
        <input type="text" class="form-control" name="user_lastname" id="user_lastname">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email" id="user_email">
    </div>

    <div class="form-group">
        <label for="user_image">Post Image</label>
        <input type="file" name="user_image" id="user_image">
    </div>

    <div class="form-group">
        <label for="user_role">User Role</label>
        <select name="user_role" id="user_role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
    </div>

    <?php if ($error) {
        echo "
        <div class='alert alert-danger' role='alert'>
            {$error}
        </div>";
    } ?>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Publish Post">
    </div>
</form>