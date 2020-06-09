<?php 

    //$conn = mysqli_connect("localhost", "root", "", "vue-php"); #development
    $conn = mysqli_connect ("remotemysql.com","wb7JdbWLVp","Joh2OV3HIn","wb7JdbWLVp"); #remote

    if (!$conn) {
        die("Failed to connec to databse " . mysqli_error($conn));
    }

?>