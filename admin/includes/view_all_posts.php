<table class="table table-bordered table-hover"> 
    <thead>
        <tr>
            <th>ID</th>
            <th>Category ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Date</th>
            <th>Image</th>
        <!--    <th>Content</th> -->
            <th>Tags</th>
            <th>Comment Count</th>
            <th>Status</th>
        echo "<tr>";
    </thead>

    <?php findAllPosts();?>
</table>

<?php 
    if(isset($_GET['delete'])){
        $post_id=$_GET['delete'];
        deletePost($post_id);
    }
?>