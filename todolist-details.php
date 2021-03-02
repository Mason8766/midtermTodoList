<?php
// initialize $item variable
$TodoList = null;
$todoList['task'] = null;
$TodoList['hours'] = null;
$TodoList['subjectId'] = null;

// check if there's an itemId URL param. If so, fetch this item for edit; if not not, show blank
if (!empty($_GET['taskId'])) {
    if (is_numeric($_GET['taskId'])) {
        $taskId = $_GET['taskId'];
        // connect
$user = 'Mason1135879';
$database = 'Mason1135879';
$passw = 'OtP4VsItvz';
$db = new PDO("mysql:host=172.31.22.43;dbname=$database", $user, $passw); //db connection

        // fetch selected item
          // fetch selected item
          $sql = "SELECT * FROM todoList  WHERE taskId = :taskId";
          $cmd = $db->prepare($sql);
          $cmd->bindParam(':taskId', $taskId, PDO::PARAM_INT);
          $cmd->execute();
          $todoList = $cmd->fetch(); // use fetch for as single record
         
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Item Details & Updates!!</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css" /> <!--Bootstrap css-->
</head>
<body>
<h1>Create your own School TODO-LIST!!</h1>
<form method="post" action="todolist-store.php" id="form"> <!--HTML FORM todolist collection-->
    <fieldset>
        <label for="task">Enter your task: </label>
        <input name="task" id="task" required value="<?php echo $todoList['task']; ?>" /> <!---->
    </fieldset>
    <fieldset>
        <label for="subjectId">Subject: </label>
        <select name="subjectId" id="subjectId">
            <?php
            //PHP used to call the subjects avaliable on the DB
            // connect to DB
            $user = 'Mason1135879';
            $database = 'Mason1135879';
            $passw = 'OtP4VsItvz';
            $db = new PDO("mysql:host=172.31.22.43;dbname=$database", $user, $passw); //db connection


            $sql = "SELECT * FROM subjects";//retunrs all rows from subjects

            // excutes sql command
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $subjects = $cmd->fetchAll();

            // useing a loop, add each subject to drop down list
            foreach ($subjects as $subject) {
                if ($todoList['subjectId'] == $subject['subjectId']) {
                    echo '<option selected value="' . $subject['subjectId'] . '">' . $subject['class'] . '</option>';
                }
                else {
                    echo '<option value="' . $subject['subjectId'] . '">' . $subject['class'] . '</option>';
                }
            
            }
            ?>
        </select>
    </fieldset>
    <fieldset>
        <label for="hours">Estimated # of hours: </label>
        <input name="hours" id="hours" required type="number" min="1" value="<?php echo $todoList['hours']; ?>"/>
    </fieldset>
    <input type="hidden" name="taskId" id="taskId" value="<?php echo $todoList['taskId']; ?>" />
    <button>Save Task</button>
</form>
</body>
</html>