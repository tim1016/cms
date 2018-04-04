<?php 
    if(isset($_GET['p_id'])){
        $the_post_id = $_GET['p_id'];
        $row = findPost_id($the_post_id);
    }   


    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_author = $row['post_author'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_content = $row['post_content'];
    $post_date = $row['post_date'];
    $post_comment_count = $row['post_comment_count'];


    if(isset($_POST['update_post'])){
        updatePost($the_post_id);
    }

?>

<form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="title">title</label>
        <input id="title" type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>">
    </div>

    <div class="form-group">
        <label for="post_category_id">post_category_id</label>

        <select class="form-control" name="post_category_id"  id="post_category_id">
        <?php 
            $query = "SELECT * FROM categories LIMIT 30";
            $query_select_all_categories = mysqli_query($connection, $query); 
            confirm($query_select_all_categories);
            while($row = mysqli_fetch_assoc($query_select_all_categories)){
                $cat_title = $row['cat_title'];
                $cat_id = $row['cat_id'];
                if($cat_id == $post_category_id){
                    echo "<option value='{$cat_id}' selected>{$cat_title}</option>";
                }
                else{
                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
            }
        ?>
        </select>
    </div>


    <div class="form-group">
        <label for="post_author">post_author</label>
        <input id="post_author" type="text" class="form-control" name="post_author" value="<?php echo $post_author; ?>">
    </div>    

    <div class="form-group">
        <label for="post_status">post_status</label>
        <input id="post_status" type="text" class="form-control" name="post_status" value="<?php echo $post_status; ?>">
    </div>

    <div class="form-group">
        <label for="post_image">post_image</label>
        <img width="100px" src="../images/<?php echo $post_image?>">
        <input id="post_image" type="file" class="form-control" name="image">
    </div>    


    <div class="form-group">
        <label for="post_tags">post_tags</label>
        <input id="post_tags" type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
    </div>

    <div class="form-group">
        <label for="post_content">post_content</label>
        <textarea class="form-control" name="post_content" id="post_content" cols="30" rows="10" >  <?php echo $post_content; ?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" name="update_post" value="Update Post" class="btn btn-primary">
    </div>

</form>