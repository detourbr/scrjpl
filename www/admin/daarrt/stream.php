<?php
	session_start();
	if (!$_SESSION['isRegistered']) {header("location: ../login.php");}
    else {
		include '../db/connect.php';

		$db = connect();
		$daarrt = $db->query("SELECT * FROM online WHERE id=".$_GET['id'])->fetch_assoc();
		$db->close();
	}
?>
<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">

	<title>Webcam de <?php echo $daarrt['name']; ?></title>
	<meta name="description" content="Interface de gestion des DAARRT">
	<meta name="author" content="Brian">

	<link rel="stylesheet" href="../res/css/styles.css">
	<link rel="stylesheet" href="../res/css/shell.css">
</head>

<body>
	<iframe class="mjpg-streamer" src="http://<?php echo $daarrt['address']; ?>:8090/?action=stream" width="650px" height="500px"></iframe>
</body>
</html>
