<?php
if(isset($_POST["naslov"]) && isset($_POST["o"]) && isset($_POST["sadrzaj"]))
{
$naslov=$_POST["naslov"];
$opis=$_POST["o"];
$sadrzaj=$_POST["sadrzaj"];
$kategorija=$_POST["kategorija"];
if(isset($_POST['arhiva'])){
    $arhiva=1;
   }else{
    $arhiva=0;
   }
   
$slikaIme = $_FILES["slika"]["name"];
$slikaPriv = $_FILES["slika"]["tmp_name"];
move_uploaded_file($slikaPriv, "img/" . $slikaIme);
$slikaDir = "img/" . $slikaIme;
$date=date('d.m.Y.');
}
$dbc = mysqli_connect('localhost', 'root', '', 'projekt') or 
die('Error connecting to MySQL server.'. mysqli_connect_error());

$query = "INSERT INTO projekt_vijesti (datum, naslov, sazetak, tekst, slika, kategorija, 
arhiva ) VALUES ('$date', '$naslov', '$opis', '$sadrzaj', '$slikaIme', 
'$kategorija', '$arhiva')";
$result = mysqli_query($dbc, $query) or die('Error querying database.');


?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $naslov; ?></title>
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
            <h2><?php echo $naslov;?></h2>
            <p><?php echo $opis;?></p>
        </div>
        <img id="pocetna" src="<?php echo $slikaDir;?>">
        <p>
        <?php echo $sadrzaj;?>
        </p>
    </div>
<footer>
    <p>france.tv</p>
</footer>
</body>
</html>