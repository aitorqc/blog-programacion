<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre de Usuario</th>
            <th>Contraseña</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Avatar</th>
            <th>Role</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <!-- LLamada a la funcion que carga todos los usuarios -->
        <?php show_users(); ?>
        <?php pre_delete_user(); ?>
        <?php delete_user(); ?>
    </tbody>
</table>
