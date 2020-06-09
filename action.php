<?php
$connect=new PDO("mysql:host=localhost;dbname=vue-php","root","");
#รับค่าที่ส่งมา
$request_data=json_decode(file_get_contents("php://input"));
$data=array();

if($request_data->action=="insert"){
    $data=array(":fname"=>$request_data->fname ,":position"=>$request_data->position, ":num"=>$request_data->num);
    $query= "INSERT INTO employee (fname,position,num) VALUES(:fname,:position,:num)";
    $statement=$connect->prepare($query);
    $statement->execute($data);
    $output=array("message"=>"Insert Complete");
    echo json_encode($output);
}
if($request_data->action=="getAll"){
    $query= "SELECT * FROM employee";
    $statement=$connect->prepare($query);
    $statement->execute();
    while($row=$statement->fetch(PDO::FETCH_ASSOC)){
            $data[]=$row;
    }
    echo json_encode($data);
}
if($request_data->action=="getEditUser"){
    $query= "SELECT * FROM employee WHERE id = $request_data->id";
    $statement=$connect->prepare($query);
    $statement->execute();
    while($row=$statement->fetch(PDO::FETCH_ASSOC)){
            $data['id']=$row['id'];
            $data['fname']=$row['fname'];
            $data['position']=$row['position'];
            $data['num']=$row['num'];
    }
    echo json_encode($data);
}
if($request_data->action=="update"){
    $data=array(":fname"=>$request_data->fname ,":position"=>$request_data->position , ":num"=>$request_data->num, ":id"=>$request_data->id);
    $query= "UPDATE employee SET fname=:fname , position=:position , num=:num WHERE id=:id";
    $statement=$connect->prepare($query);
    $statement->execute($data);
    $output=array("message"=>"Update Complete");
    echo json_encode($output);
}
if($request_data->action=="deleteUser"){
    $query= "DELETE FROM employee WHERE id = $request_data->id";
    $statement=$connect->prepare($query);
    $statement->execute();
    $output=array("message"=>"Delete Complete");
    echo json_encode($output);
}


?>