<meta charset='utf-8'>
<?php
session_start();
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
    
    echo "Strona jeszcze w budowie...";
    echo "<form method='POST' action='daneadresowe.php'>";
        echo "Imię: "."<br>";
        echo "<input >"."<br>";
        echo "Nazwisko: "."<br>";
        echo "<input >";
    echo "</form>";
       

    echo "</div>";
     echo "<form method='POST'>";
     echo "<button style='clear: both;float: left;' class=\"btn btn-default\"type='submit' formaction='daneadresowe.php'> Podaj dane adresowe</button>";
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
        
        <a  href='#' >
        <img class='youtube' width='50px' height='50px' src='../images/youtube-icon.png'>
        </a>
        
        <a  href='#' >
        <img class='facebook' width='50px' height='50px' src='../images/facebook-icon.jpg'>
        </a>
        
    </div>
</div>    
</footer>
<!--  END OF FOOTER       -->  
</body>
</html>