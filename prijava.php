
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
    <form action="administracija.php" method="POST" name="prijavaform">
            
        <br><label for="username">Korisničko ime</label><br>
        <input type="text" name="username" id="username"/>
    
        <br><label for="lozinka">Sifra</label><br>
        <input type="password" name="lozinka" id="lozinka"/>
    
    
        <button type="submit" name="prijava" id="gumb">Prijava</button>
    
    </form>
    </div>
<footer>
    <p>france.tv</p>
</footer>
</body>
</html>