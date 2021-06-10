<?php
session_start();

include 'connect.php';
define('UPLPATH', 'img/');

if (isset($_POST['prijava'])) {

    $prijavaImeKorisnika = $_POST['username'];
    $prijavaLozinkaKorisnika = $_POST['lozinka'];
    $sql = "SELECT korisnicko_ime, lozinka, razina FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, 's', $prijavaImeKorisnika);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    }
    mysqli_stmt_bind_result($stmt, $imeKorisnika, $lozinkaKorisnika, $levelKorisnika);
    mysqli_stmt_fetch($stmt);

    if (password_verify($_POST['lozinka'], $lozinkaKorisnika) && mysqli_stmt_num_rows($stmt) > 0) {
    $_SESSION['$uspjesnaPrijava'] = true;

    if($levelKorisnika == 1) {
    $_SESSION['$admnin'] = true;
    }
    else {
    $_SESSION['$admnin'] = false;
    }


    } else {
    $_SESSION['$uspjesnaPrijava'] = false;
    }
    $_SESSION['$username'] = $imeKorisnika;
    $_SESSION['$level'] = $levelKorisnika;
   }

?>


<!DOCTYPE html>
<html>
<head>
    <title>Franceinfo</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="styleadmin.css">
</head>
<body>
    
    <header id="navigacija">
        <img src="img/franceinfo.PNG" id="franceinfoslika">
        <nav>
            <a href="index.php">Home</a>
            <a href="kategorija.php?id=kultura">kultura</a>
            <a href="kategorija.php?id=drama">Drama</a>
            <a href="unos.html">Unesi vijest</a>
            <a href="prijava.php">Administracija</a>
            <a href="Korisnikunos.html">Registracija</a>
        </nav>
    </header>
    <div class="kutija">
    <?php

if (($_SESSION['$uspjesnaPrijava'] == true && $_SESSION['$admnin'] == true) || (isset($_SESSION['$username'])) && $_SESSION['$level'] == 1) {
    $query = "SELECT * FROM projekt_vijesti";
    $result = mysqli_query($dbc, $query);


    while($row = mysqli_fetch_array($result)) {
     
     echo '
     <div class="izbrisi">
     
     <form enctype="multipart/form-data" action="" method="POST">
     <label for="naslov">Naslov vjesti:</label>
     <br>
     <input type="text" name="naslov" 
    value="'.$row['naslov'].'">
    <br>
     <label for="sazetak">Kratki sadržaj vijesti (do 50 
    znakova):</label>
    <br>
     <textarea name="sazetak" cols="30" rows="10">'.$row['sazetak'].'</textarea>
     <br>
     <label for="sadrzaj">Sadržaj vijesti:</label>
     <br>

     <textarea name="sadrzaj" cols="30" rows="10">'.$row['tekst'].'</textarea>
     <br>

     <label for="slika">Slika:</label>
     <br>

     <input type="file" id="slika" 
    value="'.$row['slika'].'" name="slika"/> <br><img src="' . UPLPATH . 
    $row['slika'] . '" width=100px>
    <br>

     <label for="kategorija">Kategorija vijesti:</label>
     <select name="kategorija" id="" 
    value="'.$row['kategorija'].'">
    <option value="sport">Sport</option>
    <option value="kultura">Kultura</option>
    <option value="drama">Drama</option>
    <option value="znanost">Znanost</option>
    <option value="politika">Politika</option>
    <option value="religija">Religija</option>
     </select>
     <br>
     <label>Spremiti u arhivu: 
     <br>';
     if($row['arhiva'] == 0) {
     echo '<input type="checkbox" name="archive" id="archive"/> 
    Arhiviraj?';
     } else {
     echo '<input type="checkbox" name="archive" id="archive" 
    checked/> Arhiviraj?';
     }
     echo '
     </label>


     <input type="hidden" name="id" 
    value="'.$row['id'].'">
    <br>
     <button type="reset" value="Poništi">Poništi</button>
     <button type="submit" name="update" value="Prihvati"> 
    Izmjeni</button>
     <button type="submit" name="delete" value="Izbriši"> 
    Izbriši</button>
     </form>

     </div>
     <hr>';
    }
 }
 
 else if ($_SESSION['$uspjesnaPrijava'] == true && $_SESSION['$admnin'] == false) {
 
    echo '<p>Bok ' . $imeKorisnika . '! Uspješno ste prijavljeni, ali niste administrator.</p>';
    } else if (isset($_SESSION['$username']) && $_SESSION['$level'] == 0) {
    echo '<p>Bok ' . $_SESSION['$username'] . '! Uspješno ste prijavljeni, ali niste administrator.</p>';
    } else if ($_SESSION['$uspjesnaPrijava'] == false) {
echo'<p>Ne postojite u sistemu, molim vas registrirajte se</p>';
echo '   <form method="POST" name="prijavaform">
            
<br><label for="username">Korisničko ime</label><br>
<input type="text" name="username" id="username"/>

<br><label for="lozinka">Sifra</label><br>
<input type="password" name="lozinka" id="lozinka"/>


<button type="submit" name="prijava" id="gumb">Prijava</button>

</form>';


    }
    ?>
    
    
    
 <?php
 if(isset($_POST['delete'])){
    $id=$_POST['id'];
    $query = "DELETE FROM projekt_vijesti WHERE id=$id ";
    $result = mysqli_query($dbc, $query);
   }

   if(isset($_POST['update'])){
    $slika = $_FILES['slika']['name'];
    $naslov=$_POST['naslov'];
    $sazetak=$_POST['sazetak'];
    $sadrzaj=$_POST['sadrzaj'];
    $kategorija=$_POST['kategorija'];
    if(isset($_POST['arhiva'])){
     $archive=1;
    }else{
     $archive=0;
    }
    $target_dir = 'img/'.$slika;
    move_uploaded_file($_FILES["slika"]["tmp_name"], $target_dir);
    $id=$_POST['id'];
    $query = "UPDATE projekt_vijesti SET naslov='$naslov', sazetak='$sazetak', tekst='$sadrzaj', 
    slika='$slika', kategorija='$kategorija', arhiva='$archive' WHERE id=$id ";
    $result = mysqli_query($dbc, $query);
    }
    
 ?>

    </div>
<footer>
    <p>france.tv</p>
</footer>
</body>
</html>