<!DOCTYPE html>
<html>

<!--==================================================================
//
// Web site: It's So Pretty
// Web page: To-Do App
// Author:   Sable Morgan
// Description: A site to showcase my talents. HTML And PHP
//
// 
//=================================================================-->

<head>
  
	<title>To-Do App :: It's So Pretty</title>
  <meta charset="UTF-8">
  <meta name="author" content="Sable"/>
  <meta name="description" content="A site made by Sable to show off her work"/>
  <meta http-equiv="Expires" content="-1">
<!--   <link rel="apple-touch-icon" href="/favicon.ico" type="image/x-icon"> -->
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="pretty.css">

</head>
 
<body>
<!-- php code -->
<?php
//// connect to the database
	$db= mysqli_connect('localhost', 'root', 'mysql', 'todo');
////put data in database	
	if (isset($_POST['submit'])) {
		$task= $_POST['task'];
		mysqli_query($db, "INSERT INTO tasks (task) VALUES ('$task')");
		header('location: todo.php');
	}
////delete a task from the database
	if (isset($_GET['del_task'])){
		$id= $_GET['del_task'];
		mysqli_query($db, "DELETE FROM tasks WHERE id=$id");
		header('location: todo.php');
	}
////get the data from the database	
	$tasks= mysqli_query($db, "SELECT * FROM tasks");

?>

<!-- logo/banner -->
	<img src="images/logo.png" alt="It's So Pretty logo" height="200" align="middle">

<!-- navbar -->
	<h1>
	<a href="index.html">Home</a> - <a href="products.html">Products</a> - <a href="contact.html">Contact Us</a> - <a href="todo.php">To-Do App</a>
	</h1>
	<hr>
  
<!-- To DO -->
	<div class="heading">
		<h2>To Do List Application</h2>
	</div>
	
	<form method="POST" action="todo.php">
		<input type="text" name="task" class="task_input">
		<button type="submit" class="add_btn" name="submit">Add Task</button>
	</form>
	<br>
	
<!-- Database Table Results -->
	<br>
	<table>
		<colgroup>
			<col width="20%">
			<col width="50%">
			<col width="10%">
		</colgroup>
		<thead>
			<tr>
				<th>Number</th>
				<th>Task</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		
		<?php $i=1; while ($row= mysqli_fetch_array($tasks)){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $row['task']; ?></td>
				
				<td>
					<a href="todo.php?del_task=<?php echo $row['id']; ?>">x</a>
				</td>
			</tr>
		
		<?php $i++;} ?> 
		</tbody>
		
	</table>

<!-- footer -->
	<hr>
	It's So Pretty<br>Site Maintained by <a href="mailto:msmorgan@wayne.edu">Sable</a> © 2017
  
</body>
</html>
