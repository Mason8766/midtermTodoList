<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adding your Task</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
</head>
<body>
<?php
//Variables used
$task = $_POST['task'];
$hours = $_POST['hours'];
$subjectId = $_POST['subjectId'];
$flag = true; //validator
$taskId = $_POST['taskId']; // hidden field; blank when adding, has value when editing

//validation steps
if ($task ==""){
    $flag = false;
}elseif ($hours<1&& $hours.is_numeric()){
    $flag = false;

}elseif ($subjectId <0 || $subjectId > 7){
    $flag = false;

}


if ($flag) { //if validation is true

    //db connection
    $user = 'Mason1135879';
    $database = 'Mason1135879';
    $passw = 'OtP4VsItvz';
    $db = new PDO("mysql:host=172.31.22.43;dbname=$database", $user, $passw);

    if (empty($taskId)){
        $sql = "INSERT INTO todoList (task, hours, subjectId) VALUES (:task, :hours, :subjectId)"; //STORES DATA INTO SQL TABLE
        
    }
    else{
        $sql = "UPDATE todoList SET task = :task, hours = :hours, subjectId = :subjectId 
            WHERE taskId = :taskId";
            
    }
    ///Fills inserts, than binds param, than excutes
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':task', $task, PDO::PARAM_STR, 50);
    $cmd->bindParam(':hours', $hours, PDO::PARAM_INT);
    $cmd->bindParam(':subjectId', $subjectId, PDO::PARAM_INT);
    if (!empty($taskId)) {
        $cmd->bindParam(':taskId', $taskId, PDO::PARAM_INT);
    }
    $cmd->execute();


    $db = null; //db disconection


    echo "<h1>Task Saved</h1>";//comp msg
}

?>
    <h3>To view your Todo List, <a href="http://15.222.122.223/~Mason1135879/COMP1006/midtermTodoList/todolist-table.php">click here</a></h3>
</body>
</html>