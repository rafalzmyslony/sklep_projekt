<?php 
include('db_connect.php');
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
              echo "<li><a href='#'>Friends</a></li>";
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
  
    <div id="container-main">
 <!--  BEGIN OF SLIDER       -->

<!--  END OF SLIDER       -->    

<div style="text-align: center;padding-top: 50px;  ">
<h2>Edycja.</h2>
<?php


if($_POST['etap'] == ''){
echo "Do jakiej tabeli chcesz dodać produkt?<br>";
echo "<form method='POST' action: dodaj.php>";
    echo "<select name='taskOption'>
          <option value='akcesoria'>Akcesoria</option>
          <option value='desktop'>Desktop</option>
          <option value='laptop'>Laptop</option>
          <option value='printers'>Printers</option>
          <option value='software'>Software</option>
          <option value='tablet'>Tablet</option>          
        </select>";
        echo "<input type='hidden' name='etap' value='2etap'>";
        echo "<input type='submit' value='dalej'>";
echo "</form>";    
}elseif ($_POST['etap']=='2etap'){
    $table = $_POST['taskOption'];
    if ($result = $mysqli->query("Select * from $table order by id")){
        if ($result->num_rows > 0){
            echo "<table>";
                echo "<tr>
                <td>ID</td>
                <td>Nazwa</td>
                </tr>";
            while($row = $result->fetch_object()){
                echo "<tr>
                <td>".$row->id."</td>
                <td>".$row->nazwa."</td>
                <td>"."<a href='records.php?id=".$row->id."&nazwa=".$table."'>Edytuj</a>"."</td>
                <td>"."<a href='delete.php?id=".$row->id."&nazwa=".$table."'>Usuń</a>"."</td>
                </tr>";
            }    
            echo "</table>";
        }
    }
    
    
    
}




?>
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