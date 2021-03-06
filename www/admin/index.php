<?php
    session_start();

    if (!$_SESSION['isRegistered']) {header("location: login.php");}
    else {
        include 'db/connect.php';

        $db = connect();
        $docs = $db->query("SELECT COUNT(*) FROM documents;")->fetch_assoc();
        $daarrt = $db->query("SELECT COUNT(*) FROM online;")->fetch_assoc();
        $groups = $db->query("SELECT COUNT(DISTINCT id_ori) AS count FROM groups")->fetch_assoc();
        $db->close();
    }
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">

    <title>Panneau de contrôle</title>
    <meta name="description" content="Panneau de contrôle des DAARRT">
    <meta name="author" content="Brian">

    <link rel="stylesheet" href="res/css/styles.css">
    <script language="javascript" src="res/js/konami.js"></script>
</head>

<body>
    <nav class="topbar">
        <div class="topbar-title">DAARRT Manager</div>
    </nav>
    <ul class="navbar">
        <li>
            <a href="index.php"><i class="navbar-icon navbar-icon-dashboard"></i>Dashboard</a>
        </li>
        <li>
            <a href="manage.php"><i class="navbar-icon navbar-icon-network"></i>Manager</a>
        </li>
        <li>
            <a href="groups.php"><i class="navbar-icon navbar-icon-groups"></i>Groupes</a>
        </li>
        <li>
            <a href="td.php"><i class="navbar-icon navbar-icon-td"></i>Gestion des TD</a>
        </li>
        <li>
            <a href="documentation.php"><i class="navbar-icon navbar-icon-doc"></i>Documentation</a>
        </li>
        <li>
            <a href="logout.php"><i class="navbar-icon navbar-icon-logout"></i>Déconnexion</a>
        </li>
    </ul>

    <div class="wrapper">
        <div class="panel panel-blue">
            <div class="panel-container">
                <div class="panel-top">
                    <i class="panel-top-icon"></i>
                    <div class="panel-title-number">
                        <?php echo $daarrt['COUNT(*)']; ?>
                    </div>
                    <span class="panel-title-text">DAARRT en cours d'utilisation</span>
                </div>
                <a href="manage.php">
                    <div class="panel-bottom">Voir détails<i class="panel-detail-icon"></i></div>
                </a>
            </div>
        </div>
        <div class="panel panel-red">
            <div class="panel-container">
                <div class="panel-top">
                    <i class="panel-top-icon"></i>
                    <div class="panel-title-number">
                        <?php echo $groups['count']; ?>
                    </div>
                    <span class="panel-title-text">Groupes travaillent actuellement</span>
                </div>
                <a href="groups.php">
                    <div class="panel-bottom">Voir détails<i class="panel-detail-icon"></i></div>
                </a>
            </div>
        </div>
        <div class="panel panel-green">
            <div class="panel-container">
                <div class="panel-top">
                    <i class="panel-top-icon"></i>
                    <div class="panel-title-number">
                        <?php echo $docs['COUNT(*)']; ?>
                    </div>
                    <span class="panel-title-text">Documents sont consultables</span>
                </div>
                <a href="documentation.php">
                    <div class="panel-bottom">Voir détails<i class="panel-detail-icon"></i></div>
                </a>
            </div>
        </div>
        <div class="panel panel-yellow">
            <div class="panel-container">
                <div class="panel-top">
                    <i class="panel-top-icon"></i>
                    <div class="panel-title-number">16</div>
                    <span class="panel-title-text">J'ai fait ça juste pour faire un truc symétrique</span>
                </div>
                <a href="detail.php">
                    <div class="panel-bottom">Voir détails<i class="panel-detail-icon"></i></div>
                </a>
            </div>
        </div>
    </div>
    <!-- <script src="js/scripts.js"></script> -->
</body>
</html>
