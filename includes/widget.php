<?php include './functions/contact.php'; ?>
<?php
$msg = contact();
?>
<div class="well">
    <h2 style="margin-bottom: 2.5rem;">Contactar</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="issue">Asunto:</label>
            <input type="text" class="form-control" id="issue" name="issue" required>
        </div>
        <div class="form-group">
            <label for="content">Mensaje:</label>
            <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
        </div>
        <?php
        if ($msg === 'error') {
            echo "
            <div class='alert alert-danger' role='alert'>
                Something gone wrong
            </div>";
        } else if($msg) {
            echo "
            <div class='alert alert-success' role='alert'>
                {$msg}
            </div>";
        }
        ?>
        <button type="submit" class="btn btn-primary">Enviar Correo</button>
    </form>
</div>