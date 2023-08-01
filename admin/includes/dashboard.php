<?php include './functions/dashboard_functions.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <span class="glyphicon glyphicon-list-alt" aria-hidden="true" style="font-size: 5rem;"></span>
                        </div>
                        <div class="col-xs-6 text-right">
                            <p class="announcement-heading"><?php echo num_of_posts(); ?></p>
                            <p class="announcement-text">Posts</p>
                        </div>
                    </div>
                </div>
                <a href="./posts.php">
                    <div class="panel-footer announcement-bottom">
                        <div class="row">
                            <div class="col-xs-6">
                                Ver
                            </div>
                            <div class="col-xs-6 text-right">
                                <i class="fa fa-arrow-circle-right"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <span class="glyphicon glyphicon-list" aria-hidden="true" style="font-size: 5rem;"></span>
                        </div>
                        <div class="col-xs-6 text-right">
                            <p class="announcement-heading"><?php echo num_of_categories(); ?></p>
                            <p class="announcement-text"> Categorías</p>
                        </div>
                    </div>
                </div>
                <a href="./categories.php">
                    <div class="panel-footer announcement-bottom">
                        <div class="row">
                            <div class="col-xs-6">
                                Ver
                            </div>
                            <div class="col-xs-6 text-right">
                                <i class="fa fa-arrow-circle-right"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <span class="glyphicon glyphicon-user" aria-hidden="true" style="font-size: 5rem;"></span>
                        </div>
                        <div class="col-xs-6 text-right">
                            <p class="announcement-heading"><?php echo num_of_users(); ?></p>
                            <p class="announcement-text">Usuarios</p>
                        </div>
                    </div>
                </div>
                <a href="./users.php">
                    <div class="panel-footer announcement-bottom">
                        <div class="row">
                            <div class="col-xs-6">
                                Ver
                            </div>
                            <div class="col-xs-6 text-right">
                                <i class="fa fa-arrow-circle-right"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <span class="glyphicon glyphicon-comment" aria-hidden="true" style="font-size: 5rem;"></span>
                        </div>
                        <div class="col-xs-6 text-right">
                            <p class="announcement-heading"><?php echo num_of_comments(); ?></p>
                            <p class="announcement-text"> Comentarios</p>
                        </div>
                    </div>
                </div>
                <a href="./comments.php">
                    <div class="panel-footer announcement-bottom">
                        <div class="row">
                            <div class="col-xs-6">
                                Ver
                            </div>
                            <div class="col-xs-6 text-right">
                                <i class="fa fa-arrow-circle-right"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-xs-6">
                <div id="columnchart_material" style="width: auto; height: 500px;"></div>
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Datos', 'Cantidad'],

                            <?php
                            $post_count = num_of_posts();
                            $category_count = num_of_categories();
                            $count_comments = num_of_comments();
                            $total_views = num_of_views();

                            $element_text = ['Posts' => $post_count, 'Categorías' => $category_count, 'Comentarios' => $count_comments, 'Visitas' => $total_views];

                            foreach ($element_text as $key => $value) {
                                echo "['{$key}'" . "," . "{$value}," . "],";
                            }
                            ?>
                        ]);

                        var options = {
                            chart: {
                                title: 'Blog Statics',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
            </div>
            <div class="col-xs-6">
                <div id="piechart" style="width: auto; height: 500px;"></div>
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['corechart']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        let users_online = <?php echo check_users_online(); ?>;
                        let users = <?php echo num_of_users(); ?>;

                        var data = google.visualization.arrayToDataTable([
                            ['Usuarios', 'Total'],
                            ['Online', users_online],
                            ['Total', users]
                        ]);

                        var options = {
                            title: 'Usuarios'
                        };

                        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                        chart.draw(data, options);
                    }
                </script>
            </div>
        </div>
    </div>
</div>