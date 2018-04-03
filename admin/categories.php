<?php include "includes/admin_header.php"?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to the admin panel
                        <small>Inkant Awasthi</small>
                    </h1>
                    <div class="col-xs-6">
                        <?php 
                            if(isset($_POST['submit'])){
                                $cat_title = $_POST['cat_title'];
                                //echo $cat_title;
                                if($cat_title == "" || empty($cat_title)) {
                                    echo "<p class='text-danger'> The category title cannot be an empty string</p>";
                                }else{
                                    $query  = "INSERT INTO categories(cat_title) ";
                                    $query .= "VALUE ('{$cat_title}')";

                                    $query_create_category = mysqli_query($connection, $query);
                                    if(!$query_create_category){
                                        die("Create category Query failed with error: " . mysqli_error($connection));
                                    }

                                }
                            }

                        ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Category Name</label>
                                <input type="text" class="form-control" name="cat_title" id="cat_title">
                            </div>

                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form>

                        <?php

                            if(isset($_GET['edit'])){
                                $the_cat_id=$_GET['edit']; 
                        ?>

                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat_title">Update Category</label>
                                    <input type="text" class="form-control" name="cat_title" id="cat_title">
                                </div>

                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="update" value="Update">
                                </div>
                            </form>
                        <?php
                            if(isset($_POST['update'])){
                                $update_title=$_POST['cat_title'];
                                $query = "UPDATE categories SET cat_title='$update_title' WHERE cat_id=$the_cat_id";
                                echo $query;
                                $query_update_category = mysqli_query($connection, $query);
                                if(!$query_update_category){
                                    die("Update query failed : ". mysqli_error($connection));
                                } 
                                header('Location: categories.php'); 
                            }
                        
                        }?>



                    </div>

                    <div class="col-xs-6">

                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Title</th>
                                    <th>Delete Category</th>
                                    <th>Edit Category</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php //Find all categories query
                                    $query = "SELECT * FROM categories LIMIT 30";
                                    $query_select_all_categories = mysqli_query($connection, $query); 
                                    while($row = mysqli_fetch_assoc($query_select_all_categories)){
                                        $cat_title = $row['cat_title'];
                                        $cat_id = $row['cat_id'];
                                        echo "<tr>";
                                        echo "<td> {$cat_id} </td>";
                                        echo "<td> {$cat_title} </td>";
                                        echo "<td> <a href='categories.php?delete={$cat_id}'>&#x274E;  </a></td>";
                                        echo "<td> <a href='categories.php?edit={$cat_id}'> &#x270E;</a></td>";
                                        echo "</tr>";
                                    }
                                ?>
    
                                <?php
                                // Delete query
                                    if(isset($_GET['delete'])){
                                        $the_cat_id=$_GET['delete'];
                                        $query =  "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
                                        $query_delete_category = mysqli_query($connection, $query);
                                        if(!$query_delete_category){
                                            die("DELETE category failed : " . mysqli_error($connection));
                                        }
                                        header("Location: categories.php");
                                        //header("Refresh:0");
                                    }
                                
                                
                                ?>
                            </tbody>
                        </table>
                    </div>
                    
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "includes/admin_footer.php"?>