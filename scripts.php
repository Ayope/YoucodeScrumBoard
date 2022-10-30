<?php

    //INCLUDE DATABASE FILE
    include 'database.php';
    //SESSSION IS A WAY TO STORE DATA TO BE USED ACROSS MULTIPLE PAGES
    //session_start();

    //ROUTING
    if(isset($_POST['saveChanges'])){
        SaveTasks($conn); //In the database
    }    
    // if(isset($_POST['update']))      updateTask();
    // if(isset($_POST['delete']))      deleteTask();
    

    function SaveTasks($conn)
    {
        $title = $_POST['title'];
        $type = $_POST['type']; // return the value
        $priority = $_POST['priority'];
        $status = $_POST['status'];
        $date = $_POST['date'];
        $description = $_POST['description'];


        $sql = "INSERT INTO tasks(title, types_id, priority_id, status_id, task_datetime, description)
         VALUES ('$title','$type','$priority','$status','$date','$description');";

        $results = mysqli_query($conn, $sql);

        // $sql = "INSERT INTO tasks(title, types_id, priority_id, status_id, task_datetime, description)
        // VALUES ('$title','$type','$priority','$status','$date','$description');";

        // if(empty($title) || empty($type) || empty($priority) || empty($status) || empty($date) || empty($description) ){
        //     echo "Fill the blanks inputs"; //check the inputs
        // } else{
        //     $results = mysqli_query($conn, $sql);
        //     if($results){
        //         echo "data inserted";
        //     } else {
        //         echo "data not inserted";
        //     }
        // }

        // showTask();

        //$_SESSION['message'] = "Task has been added successfully !";
		header('location: index.php');
    }


    function GetTasks($conn) // from the database
    {
        $sql = "SELECT t.id, t.title, t.task_datetime, t.description, t.types_id, ty.name as type, t.priority_id, p.name as priority, t.status_id, s.name as statusName
        FROM tasks as t, types as ty, priorities as p, statuses as s
        WHERE t.types_id = ty.id and t.priority_id = p.id and t.status_id = s.id;";

        $results = mysqli_query($conn, $sql);

        return $results;
    }
    //GetTasks($conn);

    function updateTask()
    {
        //CODE HERE
        //SQL UPDATE
        //$_SESSION['message'] = "Task has been updated successfully !";
		header('location: index.php');
    }

    function deleteTask()
    {
        //CODE HERE
        //SQL DELETE
        //$_SESSION['message'] = "Task has been deleted successfully !";
		header('location: index.php');
    }

?>