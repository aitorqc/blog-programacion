<?php
if (isset($_GET['u_id'])) {
    $the_user_id = $_GET['u_id'];
    $query = "SELECT * FROM users WHERE user_id={$the_user_id}";

    $select_user_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_user_query)) {
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
    }
}

$error = update_user($the_user_id);
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">User Name</label>
        <input type="text" class="form-control" name="username" id="username" value="<?php echo htmlspecialchars(stripslashes($username)); ?>">
    </div>

    <div class="form-group">
        <label for="user_password">User Password</label>
        <div class="input-group">
            <input type="password" class="form-control" name="user_password" id="user_password" value="<?php echo htmlspecialchars(stripslashes($user_password)); ?>">
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
        <input type="text" class="form-control" name="user_firstname" id="user_firstname" value="<?php echo htmlspecialchars(stripslashes($user_firstname)); ?>">
    </div>

    <div class="form-group">
        <label for="user_lastname">LastName</label>
        <input type="text" class="form-control" name="user_lastname" id="user_lastname" value="<?php echo htmlspecialchars(stripslashes($user_lastname)); ?>">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email" id="user_email" value="<?php echo htmlspecialchars(stripslashes($user_email)); ?>">
    </div>

    <div class="form-group">
        <label for="user_image">Post Image</label>
        <input type="file" name="user_image" id="user_image" value="<?php echo htmlspecialchars(stripslashes($user_image)); ?>">
    </div>

    <div class="form-group">
        <label for="user_role">User Role</label>
        <select name="user_role" id="user_role">
            <?php
            $query = "SELECT * FROM users";
            $select_users = mysqli_query($connection, $query);

            // Array para rastrear los roles ya agregados
            $added_roles = array();

            while ($row = mysqli_fetch_assoc($select_users)) {
                $user_id = $row['user_id'];
                $user_role = htmlspecialchars($row['user_role']); // Sanitize the user role

                if (!in_array($user_role, $added_roles)) {
                    if ($user_id == $the_user_id) {
                        echo "<option selected value='{$user_role}'>" . ucfirst($user_role) . "</option>";
                    } else {
                        echo "<option value='{$user_role}'>" . ucfirst($user_role) . "</option>";
                    }
                    // Agregar el rol al array de roles agregados
                    $added_roles[] = $user_role;
                }
            }
            ?>
        </select>
    </div>

    <?php if ($error) {
        echo "
        <div class='alert alert-danger' role='alert'>
            {$error}
        </div>";
    } ?>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_user" value="Create User">
        <input class="btn btn-danger" type="submit" name="cancel_update_user" value="Cancel">
    </div>
</form>