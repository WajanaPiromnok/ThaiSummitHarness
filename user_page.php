<?php 

    session_start();

    if (!$_SESSION['userid']) {
        header("Location: index.php");
    } else {

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Page</title>

    <link rel="stylesheet" href="style.css">

</head>
<body>

        <h1>ไม่มีสิทธิ์เข้าหน้านี้</h1>
        <h3>กรุณาเข้าบัญชีผู้ใช้อื่น</h3>
        <p><a href="logout.php">Logout</a></p>
    
</body>
</html>


<?php } ?>