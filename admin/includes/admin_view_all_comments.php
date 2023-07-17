<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Content</th>
            <th>Email</th>
            <th>In Response To</th>
            <th>Approved</th>
            <th>Date</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <!-- LLamada a la funcion que carga todos los posts -->
        <?php show_comments(); ?>
        <?php approve_comment(); ?>
    </tbody>
</table>
