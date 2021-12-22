<main role="main">
    <div class="container">
        <div class="row">
            <h1 style="margin: auto;text-align: center">All News</h1>
            <?php
            if (count($data['News']) == 0) {
                echo "<div class='alert alert-danger'>there is no News added yet</div>";
            } else {
                 foreach ($data['News'] as $key => $newsItem) {
                    ?>
                    <!-- Example row of columns -->
                    <div class="col-md-12 border" style="padding: 5px;margin: 5px">
                        <h2><?php echo $newsItem->getTitle() ?></h2>
                        <h3><?php echo $newsItem->getAuthor() ?></h3>
                        <h5><?php echo $newsItem->getCreatedAt() ?></h5>
                        <p><?php echo substr($newsItem->getDescription(), 0, 1000) ?> ....</p>
                        <p><a class="btn btn-secondary" href="<?php echo $newsItem->getId() ?>" role="button">View details</a></p>
                    </div>
                    <hr>

                <?php }
            } ?>
        </div>

        <hr>

    </div> <!-- /container -->

</main>
