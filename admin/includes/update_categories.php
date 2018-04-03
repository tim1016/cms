
<form action="" method="post">
    <div class="form-group">
        <?php //Find all categories query
            if(isset($_GET['edit'])){
                $cat_id = $_GET['edit'];
                $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
                $query_select_categories_id = mysqli_query($connection, $query); 
                $row = mysqli_fetch_assoc($query_select_categories_id);
                $cat_title = $row['cat_title'];
            ?>
                <div class="form-group">
                    <label for="cat_title">Category Name</label>
                    <input type="text" class="form-control" name="cat_title" id="cat_title" value="<?php echo $cat_title;?>">
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="edit" value="edit Category">
                </div>
            
        <?php }

            if(isset($_POST['edit'])){
                $the_cat_title=$_POST['cat_title'];
                $query =  "UPDATE categories SET cat_title = '$the_cat_title' WHERE cat_id  = {$cat_id}";
                $query_edit_category = mysqli_query($connection, $query);
                if(!$query_edit_category){
                    die("DELETE category failed : " . mysqli_error($connection));
                }
                header("Location: categories.php");
            }
        ?>                                
    </div>
</form>