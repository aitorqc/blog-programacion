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
                <a href="#">
                    <div class="panel-footer announcement-bottom">
                        <div class="row">
                            <div class="col-xs-6">
                                Expand
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
                            <p class="announcement-text"> Categories</p>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer announcement-bottom">
                        <div class="row">
                            <div class="col-xs-6">
                                Expand
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
                            <p class="announcement-text">Users</p>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer announcement-bottom">
                        <div class="row">
                            <div class="col-xs-6">
                                Expand
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
                            <p class="announcement-text"> Comments</p>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer announcement-bottom">
                        <div class="row">
                            <div class="col-xs-6">
                                Expand
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

    <div class="row">
        <div id="columnchart_material" style="width: 800px; height: 500px;"></div>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['bar']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Data', 'Count', 'Inactive'],
                    <?php
                    $post_count = num_of_posts();
                    $category_count = num_of_categories();
                    $user_count = num_of_users();
                    $count_comments = num_of_comments();

                    $element_text = ['Posts', 'Categories', 'Users', 'Comments'];
                    $data = [$post_count, $category_count, $user_count, $count_comments];
                    sort($data);
                    $element_count = $data;

                    for($i=0; $i<count($element_count); $i++){
                        echo "['{$element_text[$i]}'". "," . "'{$element_count[$i]}'". "," . "'{$element_count[$i]}'],";
                    }
                    ?>
                ]);

                var options = {
                    chart: {
                        title: 'Company Performance',
                        subtitle: 'Sales, Expenses, and Profit: 2014-2017',
                    }
                };

                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                chart.draw(data, google.charts.Bar.convertOptions(options));
            }
        </script>
    </div>
</div>