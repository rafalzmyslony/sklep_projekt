<?php
$pathDb = "db_connect.php" ;
include("mysqlfunctions.php");

session_start();

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
              echo "<li><a href='#'>Settings</a></li>";
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
<?php

if (isset($_SESSION['koszykTrue'])){
    echo "<div id=\"koszyk\">";
    
        if (isset($_SESSION['koszyk'][0])){
            foreach ($_SESSION['koszyk'] as $key => $value){
               echo "<span style='font-size: 9px;'>".$_SESSION['koszyk'][$key][0]." szt. ".$_SESSION['koszyk'][$key][1]."</span><br>";
            }
        }
    
    
    echo "</div>";
}
?> 
   

        <!-- Page Content -->
        <div id="page-content-wrapper">
          <!--  <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Kategorie</a>  -->
            <div class="container-fluid">
                <div class="row">
                 <!--   <div class="col-lg-12"> -->
                        <h1>Kategorie</h1>
              

       
                        
               <!--     </div>  -->
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

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