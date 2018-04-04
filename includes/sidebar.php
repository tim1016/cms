<div class="col-md-4">

    <?php 

    ?>
    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>

        </form>
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <?php
            $query = "SELECT * FROM categories LIMIT 30";
            $query_select_all_categories = mysqli_query($connection, $query);        
        ?>

        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <?php
                        while($row = mysqli_fetch_assoc($query_select_all_categories)){
                            $cat_title = $row['cat_title'];
                            $cat_id = $row['cat_id'];
                            echo "<li><a href='category.php?cat_id={$cat_id}'>{$cat_title}</a></li>";
                        }
                    ?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <div class="well">
        <?php include "widget.php"?>
    </div>

</div>