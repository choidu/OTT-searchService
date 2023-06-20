Login.php---------------------------------------------------------
//
<?php
    $con = mysqli_connect("localhost", "아이디", "비번", "아이디");
    mysqli_query($con,'SET NAMES uft8');

    //입력한 id와 password 받아오기
    $id = isset($_POST["id"]) ? $_POST["id"] : ""; 
    $password = isset($_POST["password"]) ? $_POST["password"] : "";

    $statement = mysqli_prepare($con, "SELECT * FROM USER WHERE id = ? AND password = ?"); 
    mysqli_stmt_bind_param($statement, "ss", $id, $password);
    mysqli_stmt_execute($statement);

    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $id, $password);

    $response = array();
    $response["success"] = false;

    if(($id == "") || ($password == "")){
        $response["success"] = false;
    } 
    elseif(($id == "SELECT id FROM USER WHERE id = '$id'") AND ($password == "SELECT password FROM USER WHERE password = '$password'")){
        $response["success"] = true;
        $response["id"] = $id;
        $response["password"] = $password;
    } 
    else{
        $response["success"] = false;
    }
        
     

    echo json_encode($response);
?>

Register.php------------------------------------
//회원가입
<?php
    $con = mysqli_connect("localhost", "아이디", "비번", "아이디");
    mysqli_query($con,'SET NAMES uft8');

    $id = isset($_POST["id"]) ? $_POST["id"] : ""; //입력받음
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
    $name = isset($_POST["name"]) ? $_POST["name"] : ""; //입력받음

    $statement = mysqli_prepare($con, "INSERT INTO USER VALUES (?,?,?)");
    mysqli_stmt_bind_param($statement, "sss", $id, $password, $name);
    mysqli_stmt_execute($statement);


    $response = array();
    $response["success"] = false;

    if(($id == "") || ($password == "") || ($name == "")){
        $response["success"] = false;
    } else 
    {
        $response["success"] = true;
        
    }

    echo json_encode($response);

?>

Member.php----------------------------------------------
// 멤버 목록 전부 출력하기

<?php

    $con = mysqli_connect("localhost", "아이디", "비번", "아이디");
    
    $result = mysqli_query($con,"SELECT*FROM USER;");

    $response = array();

    while($row = mysqli_fetch_array($result)){
        
        array_push($response,array("id"=>$row[0],"password"=>$row[1],"name"=>$row[2]));
    }
    
    echo json_encode(array("response"=>$response));

    mysqli_close($con);
        
    ?>

<?php  
   
    $con = mysqli_connect("localhost", "juhee3297", "dkdlql!741", "juhee3297");
    $search = $_GET["searchText"];
    $result = mysqli_query($con,"SELECT*FROM CONTENTS_watcha_animation WHERE title LIKE '%$search%';");

    $response = array();

    while($row = mysqli_fetch_array($result)){
        
        array_push($response,array("title"=>$row[0],"genre"=>$row[2],"image"=>$row[4]));
        
//        $response["title"] = $title;
//        $response["contype"] = $contype;
//        $response["genre"] = $genre;
    }
    
    echo json_encode(array("response"=>$response));

    mysqli_close($con);
        
    ?>
    echo json_encode(array("response"=>$response));

    mysqli_close($con);
        
    ?>
