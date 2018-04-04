<?php include "includes/db.php"; ?>
<!--header -->
<?php include "includes/header.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <?php if(isset($_GET['cat_id'])) 
            $the_cat_id=$_GET['cat_id'];
            $query = "SELECT * FROM categories where cat_id = $the_cat_id";
            $query_category = mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($query_category);
            $cat_title = $row['cat_title'];
        ?>

        <!-- Blog Entries Column -->
        <h1 class="page-header">
            Posts in <?php echo $cat_title?> category
            <small>Secondary Text</small>
        </h1>

        <div class="col-md-8">

            <?php 
                if(isset($_GET['cat_id'])){

                    $query = "SELECT * FROM posts where post_category_id = $the_cat_id";
                    $query_select_all_posts = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($query_select_all_posts)){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'], 0, 200);
                        $post_author = $row['post_author'];
            ?>        
    <!-- First Blog Post -->
                        <h2> <a href="post.php?p_id=<?php echo $post_id?>"><?php echo $post_title;?></a> </h2>
                        <!-- <h2> <a href="#"><?php echo $post_title;?></a> </h2> -->
                        <p class="lead">
                            by <a href="index.php"><?php echo  $post_author;?></a>
                        </p>
                        <p>
                            <span class="glyphicon glyphicon-time"></span> Posted on <?php echo  $post_date;?>
                        </p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                        <hr>
                        <p> <?php echo  $post_content;?> </p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>
            <?php
                    }
                } 
            ?>



            

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"?>

    </div>
    <!-- /.row -->

    <hr>
    <?php include "includes/footer.php"; ?>