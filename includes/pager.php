<!-- Pager -->
<ul class="pager">
    <?php
    $i = 1;

    if(isset($_GET['author'])){
        $params = "author={$author}";
    }else if(isset($_GET['category'])){
        $params = "category={$category_id}";
    }else if(isset($_GET['search_term'])){
        $params = "search_term={$search_term}";
    }else{
        $params = "";
    }
    for ($i; $i <= $pages; $i++) {
        echo "<li><a href='index.php?$params&page={$i}'>{$i}</a></li>";
    }
    ?>
</ul>