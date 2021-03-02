<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Todolist</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" /> <!--bootstrap css-->
</head>
<body>
    <h1>A list of MEGA Things To DO!</h1> <!--Opening title-->
<?php
//Connect to DB
$user = 'Mason1135879';
$database = 'Mason1135879';
$passw = 'OtP4VsItvz';
$db = new PDO("mysql:host=172.31.22.43;dbname=$database", $user, $passw); //db connection

//Calls SQL QUERRY, validates and fetches
$sql = "SELECT t.taskId, t.task, t.hours, s.class FROM todoList AS t INNER JOIN subjects AS s ON t.subjectId = s.subjectId WHERE t.subjectId = s.subjectId ORDER BY t.hours desc ;"; //innerjoins 2 tables and returns the task, hours needed, and subject title
$cmd = $db->prepare($sql);
$cmd->execute();
$task = $cmd->fetchAll();

//Creates html table to  display data
echo '<table class="table table-striped table-secondary"><thead><th>Task</th><th>Length(Hours)</th><th>Subject</th><th></th></thead>'; //table structuer

foreach ($task as $indTask) //loops each row returned by querry
{
    echo '<tr><td>' . $indTask['task'] . '</td> 
        <td>' . $indTask['hours'] . '</td>
        <td>' . $indTask['class'] . '</td>
        <td><a href="delete.php?taskId='. $indTask['taskId'] .'" class="btn btn-danger" title="Delete" onclick="return confirmDelete();">Delete!</a>
        <a href="todolist-details.php?taskId='. $indTask['taskId'] .'">Update<a></td></tr>';
}

// exit table
echo '</table>';
$db = null; //database Disconection

?>
<h3>To add more to your todolist, <a href="http://15.222.122.223/~Mason1135879/COMP1006/assignment1/todolist-details.php">click here</a></h3>
</body>
</html>