<?php
include 'connect.php';
define('UPLPATH', 'img/');


$id = $_GET['id'];
?>




<!DOCTYPE html>
<html>
<head>
    <title>Franceinfo</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
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
    </header>
    <div class="kutija">
    
    
    <section class="GornjiRed">
    <h2 class="maintitle"></h2>
    <?php
    $query = "SELECT * FROM projekt_vijesti WHERE kategorija='$id' AND arhiva=0 ";
    $result = mysqli_query($dbc, $query);
    while($row = mysqli_fetch_array($result)) {
        
    echo'    <article class="Gore">';
    echo'      <img src="' . UPLPATH . $row['slika'] . '">' ;
    echo'        <a href="clanak.php?id=' .$row['id'].'">';
    echo    $row['naslov'];
    echo' </a>';
    echo'    </article>';
    }
        ?>
    </section>

</div>
<footer>
    <p>france.tv</p>
</footer>
</body>
</html>