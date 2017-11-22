<meta charset='utf-8'>
<?php
$pathDb = "../db_connect.php" ;
include("../mysqlfunctions.php");
include('../db_connect.php');

$tab = unserialize($_GET['tablica']);
session_start();
$_SESSION['addrReturn'] = "categories/pelenopis.php?tablica=".$_GET['tablica'];

if (isset($_SESSION['newDostIlosc'] ) ){
    $tab['dostepna_ilosc'] = $_SESSION['newDostIlosc'];
    unset($_SESSION['newDostIlosc']);
}



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title> </title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel='stylesheet' href='../bootstrap/css/styles.css' type='text/css' />
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="../style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/script.js"></script>

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
                <a href="../index.php" class='navbar-brand'>nazwa firmy</a>
            </div>
            <?php 
            if (isset($_SESSION['zalogowany'])){
              echo "<ul class='nav navbar-nav navbar-right'>";
              echo "<li class='dropdown'>";
              echo " <a href='#' class='dropdown-toggle' data-toggle='dropdown'>".$_SESSION['username']." <span class='caret'></span></a>";
              echo "<ul class='dropdown-menu'>";
              echo "<li><a href='profil.php'>Profil</a></li>";;
              echo "<li><a href='#'>Settings</a></li>";
              echo "<li><a href='../logout.php'>Wyloguj</a></li>";
              echo "</ul>"."</li>"."</ul>";
            }else{
              echo "<ul class='nav navbar-nav navbar-right'>";
              echo "<li><a href='../login_view.php'> Zaloguj się </a></li>";
              echo "</ul>";
            }
            ?>
            

            <div class='collapse navbar-collapse' id="mainNavBar">
                <ul class='nav navbar-nav'>
                    <li><a href='../index.php'>Strona główna</a></li>
                    <li><a href='../shopabout.php'>Kontakt</a></li>
                    <li><a href='../categories.php'>Kategorie</a></li>
                    <?php
                    if ($_SESSION['username']=='admin'){
                      echo "<li class='dropdown'>
                      <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Panel administratora <span class='caret'></span></a>
                      <ul class='dropdown-menu'>
                        <li><a href='../dodaj.php'>Dodaj produkt</a></li>
                      
                        <li><a href='../edycja.php'>Edytuj produkt</a></li>
                      
                      </li>";
                    }
                    ?>
                    
                </ul>
                
            </div>
        </div>
        
    </div>
<!--  END OF HEADER       -->

<!--  BEGIN OF CONTAINER       -->        

<div id='container-main'>
 <!--  BEGIN OF MENU    -->     

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                       
                </li>
                <li>
                    <a href="desktop.php">Komputery stacjonarne <?php echo "<span class='span-num-records'>(". getNumberTable('desktop',$pathDb).")</span>"; ?></a>
                </li>
                <li>
                    <a href="printers.php">Drukarki <?php echo "<span class='span-num-records'>(". getNumberTable('printers',$pathDb).")</span>"; ?></a>
                </li>
                <li>
                    <a href="laptop.php">Laptopy <?php echo "<span class='span-num-records'>(". getNumberTable('laptop',$pathDb).")</span>"; ?></a>
                </li>
                <li>
                    <a href="software.php">Software <?php echo "<span class='span-num-records'>(". getNumberTable('software',$pathDb).")</span>"; ?></a>
                </li>
                <li>
                    <a href="tablet.php">Tablet <?php echo "<span class='span-num-records'>(". getNumberTable('tablet',$pathDb).")</span>"; ?></a>
                </li>
                <li>
                    <a href="akcesoria.php">Akcesoria <?php echo "<span class='span-num-records'>(". getNumberTable('akcesoria',$pathDb).")</span>"; ?></a>
                </li>
                
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

     <a href="#menu-toggle" class="btn btn-default glyphicon glyphicon-th" id="menu-toggle"> Kategorie</a>

<?php

if (isset($_SESSION['koszykTrue'])){
    echo "<div id=\"koszyk\">";
    
        if (isset($_SESSION['koszyk'][0])){
            foreach ($_SESSION['koszyk'] as $key => $value){
               echo "<span style='font-size: 9px;'><span style='font-weight: bold;font-size: 10px'>".$_SESSION['koszyk'][$key][0]."</span> szt. ".$_SESSION['koszyk'][$key][1]."</span><br>";
            }
        }
    
    
    echo "</div>";
}
?>  

 

        <!-- Page Content -->
        <div id="page-content-wrapper">
          
            <div class="container-fluid">

                <h1><?php echo $tab['nazwa'];?></h1>
<?php



echo "<div class=\"div-pelen-wrap\"  > ";

    echo "<div class=\"div-pelen-image\" >";
        echo "<a href='podglad.php?tablica=".serialize($tab)."'>";
            echo "<img src='"."../".$tab['path']."' class=\"img-pelen\" />";
        echo "</a>";
        
    echo "</div>";
    echo "<div class=\"div-pelen-buy\" >";
         echo "<form method='POST'>";

             echo "<input type='number' value='1' min='1' style='width: 40px;' max='".$tab['dostepna_ilosc']."' name='ile_sztuk'/>";


             echo "<input type='hidden' name='dostepna_ilosc' value='".$tab['dostepna_ilosc']."' />"; 
             echo "<span class='span-pelenopis-sztuk'> z ".$tab['dostepna_ilosc']." sztuk </span>";
             echo "<input type='hidden' name='nazwa' value='".$tab['nazwa']."' />";
             echo "<input type='hidden' name='nazwa_tabeli' value='".$tab['nazwa_tabeli']."' />";  
             echo "<input type='hidden' name='id' value='".$tab['id']."' />"; 
             echo "<input type='hidden' name='tablica_row' value='".serialize($tab)."' />";              
             echo "<input type='hidden' name='cena' value='".$tab['cena']."' />";    
             
             echo"<br>";
             if (isset($_SESSION['zalogowany'])  ){
             echo "<button type='submit' formaction='../kupowanie.php'>Kup</button>";echo "<br>";
             echo " <button type='submit' formaction='../dodajdokoszyka.php'>Dodaj do koszyka</button>";  
             }else{
                 echo "<br><span style='color: red;'><a href='../login_view.php'>Zaloguj się, aby kupić</a></span><br>";
             }
  
             echo "<br> <span class=\"span1-pelenopis-cena\">Cena: </span>".$tab['cena']." PLN";
         echo "</form>";
    echo "</div>";    
    echo "<div class=\"div-pelen-opis\" >";
        echo "<span style='font-size:27px;'>".$tab['nazwa']."</span><br>";
        echo "
        <table id=\"pelenopis\">
          <tr>
            <td>Procesor</td>
            <td>".$tab['procesor']."</td>
          </tr>
          <tr>
            <td>Taktowanie</td>
            <td>".$tab['taktowanie']."</td>
          </tr>
          <tr>
            <td>Dysk twardy</td>
            <td>".$tab['dysk_twardy']."</td>
          </tr>
          <tr>
            <td>Karta graficzna</td>
            <td>".$tab['karta_graficzna']."</td>
          </tr>
          <tr>
            <td>Producent</td>
            <td>".$tab['producent']."</td>
          </tr>      
          <tr>
            <td>Pamięć RAM</td>
            <td>".$tab['pamiec_ram']."</td>
          </tr>            
        ";
        echo "</table>";
    echo "</div>";
echo "</div>";

?>
                        

            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    </script>    

 <!-- END of MENU -->
<!--  END OF CONTAINER       -->
</div>
<!--  BEGIN OF FOOTER       -->  

<footer>
<div id='foot'>
    <div class='social'>
        
        <a  href='http://youtube.com' >
        <img class='youtube' width='60px' height='60px' src='../images/youtube-icon.png'>
        </a>
        
        <a  href='https://pl-pl.facebook.com/' >
        <img class='facebook' width='60px' height='60px' src='../images/facebook-icon.jpg'>
        </a>
        
         <a  href='https://twitter.com/' >
        <img class='twitter' width='60px' height='60px' src='../images/twitter-icon.png'>
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