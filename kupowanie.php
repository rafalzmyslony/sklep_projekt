<meta charset='utf-8'>
<?php
session_start();
if ( !isset($_SESSION['koszyk']) ){

    $cena = $_POST['cena'];

    $_SESSION['koszyk'] = array();
    $arrayName = array($_POST['nazwa'], $_POST['ile_sztuk'], $cena);
    array_push($_SESSION['koszyk'], $arrayName);  
    $_SESSION['koszyk'][0][1] = $_POST['ile_sztuk'];
    
    $_SESSION['newDostIlosc'] = $_POST['dostepna_ilosc'] - $_POST['ile_sztuk'];
} 


$pathDb = "db_connect.php" ;
include("mysqlfunctions.php");
include('db_connect.php');



$tab = unserialize($_POST['tablica_row']);



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
                <a href="index.php" class='navbar-brand'>nazwa firmy</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Zaloguj/Imię i nazwisko <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Friends</a></li>
                            <li><a href="#">Settings</a></li>
                            <li><a href="#">Wyloguj</a></li>
                            
                        </ul>
                    </li>
                </ul>
            
            <div class='collapse navbar-collapse' id="mainNavBar">
                <ul class='nav navbar-nav'>
                    <li><a href='../index.php'>Strona główna</a></li>
                    <li><a href='../shopabout.php'>Kontakt</a></li>
                    <li><a href='../categories.php'>Kategorie</a></li>
                    
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
                    <a href="categories/desktop.php">Komputery stacjonarne <?php echo "<span class='span-num-records'>(". getNumberTable('desktop',$pathDb).")</span>"; ?></a>
                </li>
                <li>
                    <a href="categories/printers.php">Drukarki <?php echo "<span class='span-num-records'>(". getNumberTable('printers',$pathDb).")</span>"; ?></a>
                </li>
                <li>
                    <a href="categories/laptop.php">Laptopy <?php echo "<span class='span-num-records'>(". getNumberTable('laptop',$pathDb).")</span>"; ?></a>
                </li>
                <li>
                    <a href="categories/software.php">Software <?php echo "<span class='span-num-records'>(". getNumberTable('software',$pathDb).")</span>"; ?></a>
                </li>
                <li>
                    <a href="categories/tablet.php">Tablet <?php echo "<span class='span-num-records'>(". getNumberTable('tablet',$pathDb).")</span>"; ?></a>
                </li>
                <li>
                    <a href="categories/akcesoria.php">Akcesoria <?php echo "<span class='span-num-records'>(". getNumberTable('akcesoria',$pathDb).")</span>"; ?></a>
                </li>
                
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

     <a href="#menu-toggle" class="btn btn-default glyphicon glyphicon-th" id="menu-toggle"> Kategorie</a>


 

        <!-- Page Content -->
        <div id="page-content-wrapper">
          
            <div class="container-fluid">

                <h1><?php ?></h1>
<?php

$suma = 0;

echo "<div class=\"div-pelen-wrap\"  > ";

   
    echo "<div class=\"div-pelen-opis\" >";
        //echo "<span style='font-size:27px;'>".$tab['nazwa']."</span><br>";
        echo "<table id=\"kupowanie\">";
            echo "<tr>";
                echo "<td>  </td>";
                echo "<td> Nazwa </td>";
                echo "<td> sztuk </td>";
                echo "<td> Cena brutto </td>";

            echo "</tr>";
        foreach($_SESSION['koszyk'] as $key => $value){
            echo "<tr>";
                echo "<td>";
                    echo $key+1;
                echo "</td>";
                echo "<td>";
                    echo $_SESSION['koszyk'][$key][0];
                echo "</td>";                
                echo "<td>";
                    echo $_SESSION['koszyk'][$key][1];
                echo "</td>";   
                echo "<td>";
                    echo $_SESSION['koszyk'][$key][1] * $_SESSION['koszyk'][$key][2];
                echo "</td>";                 
            echo "</tr>";
            $suma = $suma + $_SESSION['koszyk'][$key][1] * $_SESSION['koszyk'][$key][2];
        }
        echo "<tr>";
                echo "<td>  </td>";
                echo "<td>  </td>";
                echo "<td>  </td>";
                echo "<td> Razem: <span style='font-weight: bold;'>$suma</span> </td>";
        echo "</tr>";
        echo "</table>";
       

    echo "</div>";
     echo "<form method='POST'>";
     echo "<button style='clear: both;float: left;' class=\"btn btn-default\"type='submit' formaction='wysylka.php'> Wybierz wysyłkę</button>";
     echo "</form>";
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