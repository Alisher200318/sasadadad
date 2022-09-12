<?php
session_start();
error_reporting(0);

$host = "localhost";
$user = "root";
$password = "";

$db = "studentsystem";
$data = new mysqli($host,$user,$password,$db);

if ($data->connect_error) {
    die("Connection failed: " . $data->connect_error);
}

    if($_SERVER['REQUEST_METHOD']=='POST'){
    $name = $_POST['username'];

    $pass = $_POST['password'];

    $sql = "select * from user where username='".$name."' AND password='".$pass."' ";

    $result = mysqli_query($data,$sql);
    $row = mysqli_fetch_array($result);

    if($row["usertype"]=="student"){
        $_SESSION['username']=$name;
        $_SESSION['usertype']="student";
        header("location:studenthome.php");
    } elseif($row["usertype"]=="admin"){
        $_SESSION['username']=$name;
        $_SESSION['usertype']="admin";
        header("location:adminhome.php");
    } else{
        $message = "Вы ввели неправильный логин или пароль!";
        $_SESSION['loginMessage']=$message;
        header("location:login.php");
    }
}

?>