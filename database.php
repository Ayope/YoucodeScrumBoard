<?php
    //CONNECT TO MYSQL DATABASE USING MYSQLI
        echo "</br>";
        $conn = mysqli_connect("localhost", "root", "", "youcodescrumbboard");

        if($conn -> connect_error){
            die("connection failed". $conn -> connect_error);
        }
?>