<?php 
include('db_connect.php');
session_start();
if (!isset($_SESSION['zalogowany'])){
  header('Location: login_view.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title> </title>
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel='stylesheet' href='bootstrap/css/styles.css' type='text/css' />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/script.js"></script>

</head>
<body>
 
<!--  BEGIN OF HEADER       -->  
    <div class="navbar navbar-inverse">
        
        <div class="container-fluid">
            
            <div class='navbar-header'>
                <button type="button" class='navbar-toggle' data-toggle='collapse' data-target='#mainNavBar' >
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="index.php" class='navbar-brand'>nazwa firmy</a>
            </div>
            <?php 
            if (isset($_SESSION['zalogowany'])){
              echo "<ul class='nav navbar-nav navbar-right'>";
              echo "<li class='dropdown'>";
              echo " <a href='#' class='dropdown-toggle' data-toggle='dropdown'>".$_SESSION['username']." <span class='caret'></span></a>";
              echo "<ul class='dropdown-menu'>";
              echo "<li><a href='profil.php'>Profil</a></li>";
              echo "<li><a href='settings.php'>Settings</a></li>";
              echo "<li><a href='logout.php'>Wyloguj</a></li>";
              echo "</ul>"."</li>"."</ul>";
            }else{
              echo "<ul class='nav navbar-nav navbar-right'>";
              echo "<li><a href='login_view.php'> Zaloguj się </a></li>";
              echo "</ul>";
            }
            ?>
            

            <div class='collapse navbar-collapse' id="mainNavBar">
                <ul class='nav navbar-nav'>
                    <li><a href='index.php'>Strona główna</a></li>
                    <li><a href='shopabout.php'>Kontakt</a></li>
                    <li><a href='categories.php'>Kategorie</a></li>
                    <?php
                    if ($_SESSION['username']=='admin'){
                      echo "<li class='dropdown'>
                      <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Panel administratora <span class='caret'></span></a>
                      <ul class='dropdown-menu'>
                        <li><a href='dodaj.php'>Dodaj produkt</a></li>
                      
                        <li><a href='edycja.php'>Edytuj produkt</a></li>
                      
                      </li>";
                    }
                    ?>
                    
                </ul>
                
            </div>
        </div>
        
    </div>
<!--  END OF HEADER       -->

<!--  BEGIN OF CONTAINER       -->        
  
    <div id="container-main">
 <!--  BEGIN OF SLIDER       -->
 
<!--  END OF SLIDER       -->    

<div style="text-align: center;padding-top: 50px;">
  <div id='profil' >
    <div class='profil-head'>
        Twój profil:
    </div>
    <div class='profil-info'>
    <?php

    $addr = "profil.php";

if (isset($_POST['submited'])){
    echo "<form action=\"$addr\" method='POST'>";    
echo "<span style='font-size:120%; font-weight: bold; padding-left: 20px;'>Dane podane przy rejestracji:</span>";

echo "<br><hr>";

echo "<table id=\"profil-table\">";      
echo "<tr>";
echo "<td>"."Imię: "."</td>"; echo "<td >"."<input name='imie' placeholder='".$_SESSION["imie"]."'>"."</td>";
echo "</tr>";
echo "<tr>";
echo "<td>"."Nazwisko: "."</td>"; echo "<td >"."<input  name='nazwisko' placeholder='".$_SESSION["nazwisko"]."'>"."</td>";
echo "</tr>";
echo "<tr>";
echo "<td >"."Login: "."</td>";echo "<td >"."<input  name='username' placeholder='".$_SESSION["username"]."'>"."</td>";
echo "</tr>";
echo "<tr>";
echo "<td>"."Adres e-mail: "."</td>"; echo "<td >"."<input  name='email' placeholder='".$_SESSION["email"]."'>"."</td>";
echo "</tr>";
echo "</table><br>";

echo "<span style='font-size:120%; font-weight: bold; padding-left: 20px;'>Twoje dane adresowe:</span><hr>";

echo "<table id=\"profil-table\">";   
echo "<tr>";
echo "<td>"."Kraj: "."</td>";echo "<td >"."<input  name='kraj' placeholder='".$_SESSION["kraj"]."'>"."</td>";
echo "</tr>";
echo "<tr>";
echo "<td>"."Województwo: "."</td>";echo "<td >"."<input  name='wojewodztwo' placeholder='".$_SESSION["wojewodztwo"]."'>"."</td>";
echo "</tr>";
echo "<tr>";
echo "<td>"."Miejscowość: "."</td>"; echo "<td >"."<input  name='miejscowosc' placeholder='".$_SESSION["miejscowosc"]."'>"."</td>";
echo "</tr>";
echo "<tr>";
echo "<td>"."Ulica i nr domu: "."</td>"; echo "<td >"."<input  name='ulicaNrDomu' placeholder='".$_SESSION["ulica"]." ".$_SESSION['nr_dom']."'>"."</td>";
echo "</tr>";
echo "</table><br>";

echo "<span style='font-size:120%; font-weight: bold; padding-left: 20px;'>Inne dane:</span><hr >";
echo "<table id=\"profil-table\">";   
echo "<tr>";
echo "<td>"."Numer telefonu: "."</td>"; echo "<td >"."<input  name='nrTelefon' placeholder='".$_SESSION["nr_telefon"]."'>"."</td>";
echo "</tr>";
echo "</table>";
echo "<input type='submit' name='zapisz' value='Zapisz' class='btn btn-danger'style='margin-top:4px;float: right;'>";
echo "</form>";
}elseif (isset($_POST['zapisz'])){
$tabNames = ['imie', 'nazwisko', 'username', 'email', 'kraj', 'wojewodztwo', 'nr_dom', 'ulica','nr_telefon'];
include('db_connect.php');

$login =  $_SESSION["username"];

foreach ($tabNames as $key => $value){

  
    if(!isset($_SESSION[$value])  ){
        if ($_POST[$value] != '' ){
            
            $_SESSION[$value] = $_POST[$value];
             $query = "UPDATE uzytkownicy SET $value = ? WHERE login = $login ";
             
            if ($stmt = $mysqli->prepare($query) ){
                $stmt->bind_param('s', $_SESSION[$value]);
                $stmt->execute();
                $stmt->close();
            }else { echo 'Blad 2';} 
        }
    }else{
        
        if ($_POST[$value] == $_SESSION[$value] ){

        }else{
                        
            $_SESSION[$value] = $_POST[$value];
             $query = "UPDATE uzytkownicy SET $value = ? WHERE login = $login";
             
            if ($stmt = $mysqli->prepare($query) ){
                $stmt->bind_param('s', $_SESSION[$value]);
                $stmt->execute();
                $stmt->close();
            }                 
        
        }    
        
        
        
            
       
        
    }
    
}
 

 echo "Zapisuję...";
 echo "<form id='zapisz1' action='profil.php' method='POST'>";
 echo "<input type='submit' style='display: none;' value='zapisz1' name='nichts'>";
 echo "</form>";
 echo "<script type='text/javascript' language='javascript'>
 document.getElementById('zapisz1').submit();
  </script> ";

}else{
echo "<form action=\"$addr\" method='POST'>";    
echo "<span style='font-size:120%; font-weight: bold; padding-left: 20px;'>Dane podane przy rejestracji:</span>";

echo "<br><hr>";

echo "<table id=\"profil-table\">";      
echo "<tr>";
echo "<td>"."Imię: "."</td>"; echo "<td >".$_SESSION['imie']."</td>";
echo "</tr>";
echo "<tr>";
echo "<td>"."Nazwisko: "."</td>"; echo "<td>".$_SESSION['nazwisko']."</td>";
echo "</tr>";
echo "<tr>";
echo "<td >"."Login: "."</td>"; echo "<td>".$_SESSION['username']."</td>";
echo "</tr>";
echo "<tr>";
echo "<td>"."Adres e-mail: "."</td>"; echo "<td>".$_SESSION['email']."</td>";
echo "</tr>";
echo "</table><br>";

echo "<span style='font-size:120%; font-weight: bold; padding-left: 20px;'>Twoje dane adresowe:</span><hr>";

echo "<table id=\"profil-table\">";   
echo "<tr>";
echo "<td>"."Kraj: "."</td>"; echo "<td >".$_SESSION['kraj']."</td>";
echo "</tr>";
echo "<tr>";
echo "<td>"."Województwo: "."</td>"; echo "<td >".$_SESSION['wojewodztwo']."</td>";
echo "</tr>";
echo "<tr>";
echo "<td>"."Miejscowość: "."</td>"; echo "<td >".$_SESSION['miejscowosc']."</td>";
echo "</tr>";
echo "<tr>";
echo "<td>"."Ulica i nr domu: "."</td>"; echo "<td >".$_SESSION['ulica'].$_SESSION['nr_dom']."</td>";
echo "</tr>";
echo "</table><br>";

echo "<span style='font-size:120%; font-weight: bold; padding-left: 20px;'>Inne dane:</span><hr >";
echo "<table id=\"profil-table\">";   
echo "<tr>";
echo "<td>"."Numer telefonu: "."</td>"; echo "<td >".$_SESSION['nr_telefon']."</td>";
echo "</tr>";
echo "</table>";
echo "<input type='submit' name='submited' value='Edytuj' class='btn btn-danger'style='margin-top:23px;float: right;'>";
echo "</form>";
}

    ?>
    </div>
  </div>
</div>

</div>

<!--  END OF CONTAINER       -->
<!--  BEGIN OF FOOTER       -->  
 
<footer>
<div id='foot'>
    <div class='social'>
        
        <a  href='http://youtube.com' >
        <img class='youtube' width='60px' height='60px' src='images/youtube-icon.png'>
        </a>
        
        <a  href='https://pl-pl.facebook.com/' >
        <img class='facebook' width='60px' height='60px' src='images/facebook-icon.jpg'>
        </a>
        
         <a  href='https://twitter.com/' >
        <img class='twitter' width='60px' height='60px' src='images/twitter-icon.png'>
        </a>
        
    </div>
  


</div> 
<div style='color: white;; position: absolute;bottom: 10px;right: 10px'>
  &copy; All rights reserved  <?php echo date("Y"); ?>    
</div> 
</footer>
<!--  END OF FOOTER       -->  
</body>
</html>