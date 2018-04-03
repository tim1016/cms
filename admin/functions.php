<?php 

function insert_categories(){
    global $connection;
    if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];
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
}

function findAllCategories(){
    global $connection;
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
}

function deleteCategory(){
    global $connection;
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
}


?>