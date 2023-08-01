 <!-- Footer -->
 <footer>
     <div class="row">
         <div class="col-lg-12">
             <p class="text-center">Copyright &copy; <?php echo date("Y"); ?></p>
         </div>
         <!-- /.col-lg-12 -->
     </div>
     <!-- /.row -->
 </footer>

 <?php session_write_close(); ?>

 <!-- jQuery -->
 <script src="/cms/js/jquery.js"></script>

 <!-- Bootstrap Core JavaScript -->
 <script src="/cms/js/bootstrap.min.js"></script>
 <script src="/cms/js/update_user_activity.js"></script>
 <?php
    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'user') {
        echo '<script src="/cms/js/inactivity_logout.js"></script>';
    }
    ?>

 </body>

 </html>