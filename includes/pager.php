<!-- Pager -->
<ul class="pager">
    <?php
    $i = 1;

    if (isset($_GET['author'])) {
        $params = "author";
    } else if (isset($_GET['category'])) {
        $params = "category";
    } else if (isset($_GET['search_term'])) {
        $params = "tag";
    } else {
        $params = "";
    }

    for ($i; $i <= $pages; $i++) {
        echo "<li><a href='/cms";
        switch ($params) {
            case 'author':
                $url = "/author/{$_GET['author']}";
                break;
            case 'category':
                $url = "/category/{$_GET['category']}";
                break;
            case 'tag':
                $url = "/tag/{$_GET['search_term']}";
                break;
            default:
                $url = "";
                break;
        }
        echo "$url/page/$i'>{$i}</a></li>";
    }
    ?>
</ul>