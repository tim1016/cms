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
                                echo $cat_title;
                                if($cat_title == "" || empty($cat_title)) {
                                    echo "<p class='text-danger'> The category title cannot be an empty string</p>";
                                }else{
                                    
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
                    </div>

                    <div class="col-xs-6">
                        <?php
                            $query = "SELECT * FROM categories LIMIT 30";
                            $query_select_all_categories = mysqli_query($connection, $query);        
                        ?>





                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    while($row = mysqli_fetch_assoc($query_select_all_categories)){
                                        $cat_title = $row['cat_title'];
                                        $cat_id = $row['cat_id'];
                                        echo "<tr>";
                                        echo "<td> {$cat_id} </td>";
                                        echo "<td> {$cat_title} </td>";
                                        echo "</tr>";
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