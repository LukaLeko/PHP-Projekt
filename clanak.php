<?php
include 'connect.php';
define('UPLPATH', 'img/');

$id = $_GET['id'];
$query = "SELECT * FROM projekt_vijesti WHERE id='$id' ";
$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($result)



?>



<!DOCTYPE html>
<html>
<head>
    <title>Franceinfo</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="stylearticleunos.css">
</head>
<body>
    
    <header id="navigacija">
        <img src="img/franceinfo.PNG" id="franceinfoslika">
        <nav>
        <a href="index.php">Home</a>
            <a href="kategorija.php?id=kultura">Kultura</a>
            <a href="kategorija.php?id=drama">Drama</a>
            <a href="unos.html">Unesi vijest</a>
            <a href="prijava.php">Administracija</a>
            <a href="Korisnikunos.html">Registracija</a>

        </nav>
    </header>
    <div class="kutija">
        <div class="naslov">   
            <h2><?php echo $row['naslov'];?></h2>
            <p><?php echo $row['sazetak'];?></p>
        </div>
        <?php echo'<img src="' . UPLPATH . $row['slika'] . '"><br>'; ?>
        <?php  
            echo $row['tekst'];
        
        ?>
    </div>
<footer>
    <p>france.tv</p>
</footer>
</body>
</html>