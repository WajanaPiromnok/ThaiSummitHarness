<?php
//$con=mysqli_connect("localhost","root","","vue-php"); #development
$con=mysqli_connect("remotemysql.com","wb7JdbWLVp","Joh2OV3HIn","wb7JdbWLVp"); #remote
$query="SELECT * FROM employee";
$result=mysqli_query($con,$query);


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
    <title>พนักงานใน บริษัท ไทยซัมมิท ฮาร์เนส</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>

    
    <div class="container" id="app">
        <div class="homecontent">
            <!--  notification message -->
            <?php if (isset($_SESSION['success'])) : ?>
                <div class="success">
                    <h3>
                        <?php 
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                        ?>
                    </h3>
                </div>
            <?php endif ?>
        
            <p align="right"><a href="index.php?logout='1'" style="color: red;">Logout</a></p>
        </div>
                <h2 align="center">พนักงานใน บริษัท ไทยซัมมิท ฮาร์เนสพนักงาน</h2>
                <div class="row">
                    <div class="col-md-12">
                    <!-- logged in user information -->
            
                        <form @submit="submitData" @reset="resetData" method="post">                           
                            <div class="form-group">
                                <label for="">ชื่อ</label>
                                <input type="text" v-model="form.fname" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">แผนก</label>
                                <input type="text" v-model="form.position" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">เบอร์</label>
                                <input type="text" v-model="form.num" class="form-control">
                            </div>                                                        
                            <input type="submit" v-model="form.status" class="btn btn-success">
                            <input type="reset" value="ยกเลิก" class="btn btn-danger">
                        </form>
                    </div>
                </div>

                <div class="py-2">
                    <!--{{form}}-->
                </div>
                <table class="table">
                <thead>
                    <tr>
                    <th scope="col">ลำดับที่</th>
                    <th scope="col">ชื่อ</th>
                    <th scope="col">แผนก</th>
                    <th scope="col">เบอร์ภายใน</th>
                    <th scope="col">แก้ไข</th>
                    <th scope="col">ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="row in users">
                        <th scope="row">{{row.id}}</th>
                        <td>{{row.fname}}</td>
                        <td>{{row.position}}</td>
                        <td>{{row.num}}</td>
                        <td>
                            <button class="btn btn-primary" @click="editUser(row.id)">แก้ไข</button>                            
                        </td>
                        <td>
                            <button class="btn btn-danger" @click="deleteUser(row.id)"> ลบ</button>
                        </td>
                    </tr>
                </tbody>
                </table>
        </div>

</body>
<script src="app.js"></script>
</html>
<?php } ?>
