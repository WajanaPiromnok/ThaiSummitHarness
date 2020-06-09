<?php 

    $conn = mysqli_connect("localhost", "root", "", "vue-php");

    if (!$conn) {
        die("Failed to connec to databse " . mysqli_error($conn));
    }

?>