<?php
    session_start();
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
	require __DIR__ . '/vendor/autoload.php';
	define("IN_INDEX", 1);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset = "UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>GALERIA</title>
    <link href='style.css' rel='stylesheet' type='text/css' >
    <script src="dropzone/dist/dropzone.js"></script>
    <link rel="stylesheet" href="dropzone/dist/dropzone.css">
	<link rel="shortcut icon" type="image/x-icon" href="icon.jpg" />
	<link href='photobox/photobox.css' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9Mu		hOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="jquery-3.0.0.js" type="text/javascript"></script>
    <script type="text/javascript" src="photobox/jquery.photobox.js"></script>
    

</head>
<body>
    <header>
	<div class="container">
    <img src="logo.png" alt="logo" class="logo">
    <nav>
	<ul>
	  <li><a class="nav-link" class="nav-item active" href="gallery">GALERIA ZDJĘĆ</a></li>
        <li><a class="nav-link" class="nav-item active" href="add_photo">DODAJ NOWE ZDJĘCIE</a></li>
        <li><a class="nav-link" class="nav-item active" href="category">KATEGORIE</a></li>
        <li><a class="nav-link" class="nav-item active" href="instruction">INSTRUKCJA OBSŁUGI</a></li>
    </ul>
    </nav>
    </div>
	</header>
    <div class="container mb-5">
            <div class="row">
                <div class="col-md-8">
                <?php 
                    //opening subpages
                    $allowed_pages = ['gallery', 'add_photo', 'category', 'instruction'];

                    if (isset($_GET['page']) && $_GET['page'] && in_array($_GET['page'], $allowed_pages)) {
                        if (file_exists($_GET['page'] . '.php')) {
                            include($_GET['page'] . '.php');
                        } else {
                            print 'Plik ' . $_GET['page'] . '.php nie istnieje.';
                        }
                    } else {
                        include('main.php');
                    }
                ?> 
				</div>
			</div> 
				 
	</div>
</body>
</html>
