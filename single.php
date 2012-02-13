<?php


$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (empty($id)) {
	header('Location: index.php');	// this is if there is no page
	exit;	//stop the PHP right here and immediately redirect the user, ONLY connect to the database if there is a statement to tmake
}

//	**********************
//			By using this format, MySQL is plrotected from a type of common hacking
//	**********************

require_once 'includes/db.php';

		// 	prepare() allows execution of sql commands with user input
$sql = $db->prepare('
SELECT id, title, director, release_date 
FROM movielist
WHERE id = :id
');

$sql->bindValue(':id', $id, PDO::PARAM_INT);

// perform the sql query on the database
$sql->execute();
// get the results and stores them in a variable ($results) - fetch gets a single result, fetch all gets all possible results
$results = $sql->fetch();

if (empty($results)) {
	header('Location: index.php');	// this is if there is no page
	exit;	//stop the PHP right here and immediately redirect the user, ONLY connect to the database if there is a statement to tmake
}

?>		

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $results['title']; ?> | Movie List</title>
<link href="css/general.css" rel="stylesheet">

</head>
<body>
	<div class="stuff">
		<h1><?php echo $results['title']; ?></h1>
		<p>Director: <?php  echo $results['director']; ?></p>
		<p>Released: <?php  echo $results['release_date']; ?></p>

		<a href="index.php">Home</a>
	</div>
</body>
</html>