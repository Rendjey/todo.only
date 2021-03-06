<?php
    $error = "";

    $db = mysqli_connect('localhost', 'root', '', 'todo');
    if (isset($_POST['submit'])) {
        $task = $_POST['task'];
        if(empty($task)) {
            $error = "You mast fill in the task!";
        } else {
            mysqli_query($db, "INSERT INTO tasks (task) VALUES ('$task')");
            header('location: index.php');
        }


    }

    $tasks = mysqli_query($db, "SELECT * FROM tasks");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Todo list</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="heading">
    <h2>Todo list with PHP and MySQL </h2>
</div>
<form action="index.php" method="POST">
    <?php if(isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
    <input type="text" name="task" class="task_input">
    <button type="submit" class="add_btn" name="submit">Add Task</button>
</form>

    <table>
        <thead>
            <tr>
                <th>№</th>
                <th>Task</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        <?php while($row = mysqli_fetch_array($tasks)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td class="task"><?php echo $row['task']; ?></td>
                <td class="delete">
                    <a href="#">X</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</body>
</html>