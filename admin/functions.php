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


function findAllPosts(){
    global $connection;
    $query = "SELECT * FROM posts";
    $query_select_all_posts = mysqli_query($connection, $query); 
    while($row = mysqli_fetch_assoc($query_select_all_posts)){
        echo "<tr>";
        $post_id = $row['post_id'];
        echo "<td> {$post_id} </td>";
        $the_cat_id = $row['post_category_id'];
        $cat_title = getCategoryTitle($the_cat_id);
        
        echo "<td> {$cat_title} </td>";
        echo "<td> {$row['post_title']} </td>";
        echo "<td> {$row['post_author']} </td>";
        echo "<td> {$row['post_date']} </td>";
        $image=$row['post_image'];
        echo "<td> <img width='100px' src=images/{$image} alt='image'> </td>";
    //    echo "<td> {$row['post_content']} </td>";
        echo "<td> {$row['post_tags']} </td>";
        echo "<td> {$row['post_comment_count']} </td>";
        echo "<td> {$row['post_status']} </td>";
        echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
        echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
        echo "</tr>";
    }
}


function findPost_id($the_post_id){
    global $connection;
    $query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";
    $query_post_id = mysqli_query($connection, $query); 
    $row = mysqli_fetch_assoc($query_post_id);
    return $row;

    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_author = $row['post_author'];
    $post_status = $row['post_status'];
    $post_image = $row['image'];
    $post_tags = $row['post_tags'];
    $post_content = $row['post_content'];
    $post_date = $row['post_date'];
    $post_comment_count = $row['post_comment_count'];

    




    
}




function getCategoryTitle($the_cat_id){
    global $connection;
    $query = "SELECT * FROM categories WHERE cat_id = {$the_cat_id}";
    $query_category_title = mysqli_query($connection, $query); 
    $row = mysqli_fetch_assoc($query_category_title);
    $cat_title=$row['cat_title'];
    return $cat_title;
}


function addNewPost(){
    global $connection;
    if(isset($_POST['create_post'])){
        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['post_category_id'];
        $post_author = $_POST['post_author'];
        $post_status = $_POST['post_status'];

        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];        
        
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
        $post_comment_count = 4;

        move_uploaded_file($post_image_temp, "../images/$post_image");

        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
        $query .= "VALUES ( $post_category_id, '{$post_title}', '{$post_author}', now(),  '{$post_image}', '{$post_content}', '{$post_tags}',  $post_comment_count, '{$post_status}')";
        
        $query_add_post = mysqli_query($connection, $query);

        confirm($query_add_post);
    }    
}


function updatePost($the_post_id){
    global $connection;
    if(isset($_POST['update_post'])){
        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['post_category_id'];
        $post_author = $_POST['post_author'];
        $post_status = $_POST['post_status'];

        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];        
        
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        //$post_comment_count = 4;

        move_uploaded_file($post_image_temp, "../images/$post_image");

        $query = "UPDATE posts SET ";
        $query .= "post_title = '{$post_title}', ";
        $query .= "post_category_id = '{$post_category_id}', ";
        $query .= "post_author = '{$post_author}', ";
        $query .= "post_status = '{$post_status}', ";
        $query .= "post_tags = '{$post_tags}', ";
        $query .= "post_content = '{$post_content}', ";
        $query .= "post_date = now(), ";
        $query .= "post_image = '{$post_image}' ";
        $query .= "WHERE post_id = $the_post_id ";

        
        $query_update_post = mysqli_query($connection, $query);

        confirm($query_update_post);
    }    
}





function confirm($result){
    global $connection;
    if(!$result){
        die("QUERY FAILED: " . mysqli_errno($connection) . mysqli_error($connection) );
    }
}


function deletePost($the_post_id){
    global $connection;
    $query = "DELETE FROM posts WHERE post_id = $the_post_id";
    $query_delete_post = mysqli_query($connection, $query); 
    confirm($query_delete_post);
    header("Location: posts.php");   
}


?>