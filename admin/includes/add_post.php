<?php addNewPost(); ?>



<form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="title">title</label>
        <input id="title" type="text" class="form-control" name="post_title">
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
                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
        ?>
        </select>
    </div>



    <div class="form-group">
        <label for="post_author">post_author</label>
        <input id="post_author" type="text" class="form-control" name="post_author">
    </div>    

    <div class="form-group">
        <label for="post_status">post_status</label>
        <input id="post_status" type="text" class="form-control" name="post_status">
    </div>

    <div class="form-group">
        <label for="post_image">post_image</label>
        <input id="post_image" type="file" class="form-control" name="image">
    </div>    


    <div class="form-group">
        <label for="post_tags">post_tags</label>
        <input id="post_tags" type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">post_content</label>
        <textarea class="form-control" name="post_content" id="post_content" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" name="create_post" value="Publish Post" class="btn btn-primary">

    </div>

</form>