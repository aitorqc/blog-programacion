<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Autor</th>
            <th>Contenido</th>
            <th>Email</th>
            <th>En respuesta a</th>
            <th>Aprobado</th>
            <th>Fecha</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <!-- LLamada a la funcion que carga todos los posts -->
        <?php show_comments(); ?>
        <?php pre_delete_comment(); ?>
        <?php delete_comment(); ?>
        <?php approve_comment(); ?>
    </tbody>
</table>
