<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Deleting item...</title>
</head>
<body>
<p>fdgsdaf</P>
<?php
if (is_numeric($_GET['taskId'])) {
    // read the taskId from the URL parameter using the $_GET collection
    $taskId = $_GET['taskId'];

    $user = 'Mason1135879';
$database = 'Mason1135879';
$passw = 'OtP4VsItvz';
$db = new PDO("mysql:host=172.31.22.43;dbname=$database", $user, $passw); //db connection

    // set up & run the SQL DELETE command
    $sql = "DELETE FROM todoList WHERE taskId = :taskId";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':taskId', $taskId, PDO::PARAM_INT);
    $cmd->execute();

    // disconnect
    $db = null;
}

// redirect to the updated items.php page. if no numeric taskId URL param, just reload anyway
header('location:todolist-table.php');
?>

</body>
</html>