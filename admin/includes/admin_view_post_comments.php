<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Content</th>
            <th>Email</th>
            <th>Approved</th>
            <th>Date</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <!-- LLamada a la funcion que carga todos los posts -->
        <?php show_post_comments(); ?>
        <?php pre_delete_comment(); ?>
        <?php delete_comment(); ?>
        <?php approve_comment(); ?>
    </tbody>
</table>