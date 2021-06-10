

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script type="text/javascript" src="jquery-1.11.0.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="form-validation-user.js"></script> 
    <link rel="stylesheet" type="text/css" href="stylearticleunos.css">
    <title>Document</title>
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

<?php

include 'connect.php';
define('UPLPATH', 'img/');



$ime = $_POST['ime'];
$prezime = $_POST['prezime'];
$username = $_POST['username'];
$lozinka = $_POST['pass'];
$hashed_password = password_hash($lozinka, CRYPT_BLOWFISH);
$razina = 0;
$registriranKorisnik = '';

$sql = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = ?";
$stmt = mysqli_stmt_init($dbc);
if (mysqli_stmt_prepare($stmt, $sql)) {
 mysqli_stmt_bind_param($stmt, 's', $username);
 mysqli_stmt_execute($stmt);
 mysqli_stmt_store_result($stmt);
 }
if(mysqli_stmt_num_rows($stmt) > 0){
 $msg='Korisničko ime već postoji!';
}else{

 $sql = "INSERT INTO korisnik (ime, prezime,korisnicko_ime, lozinka, 
razina)VALUES (?, ?, ?, ?, ?)";
 $stmt = mysqli_stmt_init($dbc);
 if (mysqli_stmt_prepare($stmt, $sql)) {
 mysqli_stmt_bind_param($stmt, 'ssssd', $ime, $prezime, $username, 
$hashed_password, $razina);
 mysqli_stmt_execute($stmt);
 $registriranKorisnik = true;
 }
}
mysqli_close($dbc);

if($registriranKorisnik == true) {
    echo '<p>Korisnik je uspješno registriran!</p>';
    } else {
        echo '
        <p>Korisnik već postoji, molimo vas upisite novog korisnika ili se prijavite:<p>
        <form action="registracija.php" method="POST" name="registracija">
        
            <label for="ime">Ime</label><br>
            <input type="text" name="ime" id="ime"/>
        
            <br><label for="prezime">Prezime</label><br>
            <input type="text" name="prezime" id="prezime"/>
        
            <br><label for="username">Korisničko ime</label><br>
            <input type="text" name="username" id="username"/>
        
            <br><label for="pass">Sifra</label><br>
            <input type="password" name="pass" id="pass"/>
        
            <br><label for="pass1">Ponovite sifru</label><br>
            <input type="password" name="pass1" id="pass1"/>
        
            <button type="submit" id="gumb">Prijava</button>
        
        </form>
        ';}

   
?>
</div>
<footer>
    <p>france.tv</p>
</footer>
</body>
</html>