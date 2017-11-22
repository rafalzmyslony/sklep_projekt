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
<?php
session_start();
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
<div id='slider'>
      
<div class='container'>


 
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
    <li data-target="#myCarousel" data-slide-to="4"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <?php
    include('db_connect.php');
   
   
    
// SLIDE 1    
    echo "<div class='item active'>";
    echo "<div class='product-slider'>";
   
    
    if ($stmt= $mysqli->query("select * from desktop ")){
      
      if ($stmt->num_rows == 0){
        echo "Brak jeszcze niektórych produktów";
      }else{
      
        $obj = $stmt->fetch_object();
        $firstRow = $obj->id;
        $rows = $stmt->num_rows;

        $najwyzszeId = 1;
        while ($rowsArray = $stmt->fetch_assoc()){
          if ($rowsArray['id'] > $najwyzszeId){
            $najwyzszeId = $rowsArray['id'];
          }
        };
        do{
          $id = rand($firstRow, $najwyzszeId);
          $sql = "SELECT id FROM desktop WHERE id= $id";
          $result = $mysqli->query($sql);
          if($result->num_rows != 0){
           //found
           $idExist = true;
          }
        }while($idExist == false);
        
        if ($row = $mysqli->prepare("select * from desktop where id = ? ")){
        
        $row->bind_param('i', $id);
        $row->execute();
        $row->bind_result($id, $nazwa, $procesor, $taktowanie, $dysk, $k_graficzna, $producent, $os, $pamiec_ram, $path, $ilosc, $cena);
        $row->fetch();
        
        
        
    echo "
    <div class='div-slide-main'>
    <img src='$path' class='img-slide-main'> 
    </div>";
    echo "<div class='div-slide-opis'>";
    echo "Nazwa:<span style='font-weight: bold;'> ".$nazwa; echo "</span><br>";
    echo "Procesor:<span style='font-weight: bold;'> ".$procesor; echo "</span><br>";
    echo "Taktowanie:<span style='font-weight: bold;'> ".$taktowanie; echo "</span><br>";
    echo "Dysk twardy: <span style='font-weight: bold;'>".$dysk; echo "</span><br>";
    echo "Karta graficzna:<span style='font-weight: bold;'> ".$k_graficzna; echo "</span><br>";
    echo "Producent:<span style='font-weight: bold;'> ".$producent; echo "</span><br>";
    echo "System operacyjny:<span style='font-weight: bold;'> ".$os; echo "</span><br>";
    echo "Pamięć RAM:<span style='font-weight: bold;'> ".$pamiec_ram."</span>"; 
    
    echo "</div>";
       
        $row->close();
        
        }else{
          echo $mysqli->error;
          
        }
        
      }
    $stmt->close();
    }else{
      echo 'Błąd zapytania';
    };
    echo "</div></div>";
// SLIDE 2



    echo "<div class='item'>";
    echo "<div class='product-slider'>";

    
    if ($stmt= $mysqli->query("select id from printers ")){
      
      if ($stmt->num_rows == 0){
      
        echo "<div class='div-slide-main'>
          <img src='images/wyprzedany.png' class='img-slide-main'> 
         </div>";
    
        echo "<div class='div-slide-opis'>";
        echo "Produkt wyprzedany";
       echo "</div>";
      }else{
        
        $obj = $stmt->fetch_object();
        $firstRow = $obj->id;
        $rows = $stmt->num_rows;

        $najwyzszeId = 1;
        while ($rowsArray = $stmt->fetch_assoc()){
          if ($rowsArray['id'] > $najwyzszeId){
            $najwyzszeId = $rowsArray['id'];
          }
        };
        do{
          $id = rand($firstRow, $najwyzszeId);
          $sql = "SELECT id FROM printers WHERE id= $id";
          $result = $mysqli->query($sql);
          if($result->num_rows != 0){
           //found
           $idExist = true;
          }
        }while($idExist == false);
  
        
        if ($row = $mysqli->prepare("select nazwa,producent,waga,tech_druku,szybk_druk,format,cena,gwarancja,path from printers where id = ? ")){
        
        $row->bind_param('i', $id);
        $row->execute();
        $row->bind_result($nazwa, $producent, $waga, $tech_druku, $szybk_druk, $format ,$cena, $gwarancja, $path);
        $row->fetch();
        

    echo "
    <div class='div-slide-main'>
    <img src='$path' class='img-slide-main'> 
    </div>";
    
    echo "<div class='div-slide-opis'>";
      echo "Nazwa: <span style='font-weight: bold;'>".$nazwa."</span><br>";
      echo "Producent: <span style='font-weight: bold;'>".$producent."</span><br>";
      echo "Waga: <span style='font-weight: bold;'> ".$waga."</span><br>";
      echo "Technologia druku: <span style='font-weight: bold;'>".$tech_druku."</span><br>";
      echo "Szybkość drukowania: <span style='font-weight: bold;'>".$szybk_druk."</span><br>";
      echo "Gwarancja: <span style='font-weight: bold;'>".$gwarancja."</span><br>";

      
    echo "</div>";
        
        $row->close();
        
        }else{
          echo $mysqli->error;
          
        }
        
      }
    $stmt->close();
    }else{
      echo 'Błąd zapytania';
    };
    
    echo "</div></div>";


// SLIDE 3 
        echo "<div class='item'>";
    echo "<div class='product-slider'>";

    if ($stmt= $mysqli->query("select id from laptop ")){
      
      if ($stmt->num_rows == 0){
        echo "  ";// dodac opis i slide
        echo "<div class='div-slide-main'>
          <img src='images/wyprzedany.png' class='img-slide-main'> 
         </div>";
    
        echo "<div class='div-slide-opis'>";
        echo "Produkt wyprzedany";
       echo "</div>";
      }else{
        
        $obj = $stmt->fetch_object();
        $firstRow = $obj->id;
        $rows = $stmt->num_rows;

        $najwyzszeId = 1;
        while ($rowsArray = $stmt->fetch_assoc()){
          if ($rowsArray['id'] > $najwyzszeId){
            $najwyzszeId = $rowsArray['id'];
          }
        };
        do{
          $id = rand($firstRow, $najwyzszeId);
          $sql = "SELECT id FROM laptop WHERE id= $id";
          $result = $mysqli->query($sql);
          if($result->num_rows != 0){
           //found
           $idExist = true;
          }
        }while($idExist == false);
  
        
        if ($row = $mysqli->prepare("select nazwa,producent,waga,procesor,taktowanie,dysk_twardy,stan,path from laptop where id = ? ")){
        
        $row->bind_param('i', $id);
        $row->execute();
        $row->bind_result($nazwa, $producent, $waga, $procesor, $taktowanie, $dysk_twardy, $stan, $path);
        $row->fetch();
        

    echo "
    <div class='div-slide-main'>
    <img src='$path' class='img-slide-main'> 
    </div>";
    
    echo "<div class='div-slide-opis'>";
    echo "Nazwa:  <span style='font-weight: bold;'>".$nazwa."</span><br>";
    echo "Producent:  <span style='font-weight: bold;'>".$producent."</span><br>";
    echo "Waga:  <span style='font-weight: bold;'>".$waga."</span><br>";
    echo "Procesor:  <span style='font-weight: bold;'>".$procesor."</span><br>";
    echo "Taktowanie:  <span style='font-weight: bold;'>".$taktowanie."</span><br>";
    echo "Dysk twardy:  <span style='font-weight: bold;'>".$dysk_twardy."</span><br>";
    echo "Stan:  <span style='font-weight: bold;'>".$stan."</span><br>";

    echo "</div>";
        
        $row->close();
        
        }else{
          echo $mysqli->error;
          
        }
        
      }
    $stmt->close();
    }else{
      echo 'Błąd zapytania';
    };
    
    echo "</div></div>";
// SLIDE 4 

        echo "<div class='item'>";
    echo "<div class='product-slider'>";

    
    if ($stmt= $mysqli->query("select id from akcesoria ")){
      
      if ($stmt->num_rows == 0){

        echo "<div class='div-slide-main'>
          <img src='images/wyprzedany.png' class='img-slide-main'> 
         </div>";
    
        echo "<div class='div-slide-opis'>";
        echo "Produkt wyprzedany";
       echo "</div>";
      }else{
        
        $obj = $stmt->fetch_object();
        $firstRow = $obj->id;
        $rows = $stmt->num_rows;

        $najwyzszeId = 1;
        while ($rowsArray = $stmt->fetch_assoc()){
          if ($rowsArray['id'] > $najwyzszeId){
            $najwyzszeId = $rowsArray['id'];
          }
        };
        do{
          $id = rand($firstRow, $najwyzszeId);
          $sql = "SELECT id FROM akcesoria WHERE id= $id";
          $result = $mysqli->query($sql);
          if($result->num_rows != 0){
           //found
           $idExist = true;
          }
        }while($idExist == false);
  
        
        if ($row = $mysqli->prepare("select nazwa,producent,cena,zastosowanie,path from akcesoria where id = ? ")){
        
        $row->bind_param('i', $id);
        $row->execute();
        $row->bind_result($nazwa, $producent, $cena, $zastosowanie, $path);
        $row->fetch();
        

    echo "
    <div class='div-slide-main'>
    <img src='$path' class='img-slide-main'> 
    </div>";
    
    echo "<div class='div-slide-opis'>";
    echo "Nazwa:  <span style='font-weight: bold;'>".$nazwa."</span><br>";
    echo "Producent:  <span style='font-weight: bold;'>".$producent."</span><br>";
    echo "Zastosowanie:  <span style='font-weight: bold;'>".$zastosowanie."</span><br>";
    echo "Cena:  <span style='font-weight: bold;'>".$cena."</span><br>";
    echo "</div>";
        
        $row->close();
        
        }else{
          echo $mysqli->error;
          
        }
        
      }
    $stmt->close();
    }else{
      echo 'Błąd zapytania';
    };
    
    echo "</div></div>";
   
// SLIDE 5 
  
       echo "<div class='item'>";
    echo "<div class='product-slider'>";

    
    if ($stmt= $mysqli->query("select id from tablet ")){
      
      if ($stmt->num_rows == 0){
        echo "<div class='div-slide-main'>
          <img src='images/wyprzedany.png' class='img-slide-main'> 
         </div>";
    
        echo "<div class='div-slide-opis'>";
        echo "Produkt wyprzedany";
       echo "</div>";
      }else{
        
        $obj = $stmt->fetch_object();
        $firstRow = $obj->id;
        $rows = $stmt->num_rows;

        $najwyzszeId = 1;
        while ($rowsArray = $stmt->fetch_assoc()){
          if ($rowsArray['id'] > $najwyzszeId){
            $najwyzszeId = $rowsArray['id'];
          }
        };
        do{
          $id = rand($firstRow, $najwyzszeId);
          $sql = "SELECT id FROM tablet WHERE id= $id";
          $result = $mysqli->query($sql);
          if($result->num_rows != 0){
           //found
           $idExist = true;
          }
        }while($idExist == false);
  
        
        if ($row = $mysqli->prepare("select nazwa,cena,producent,bateria,waga,wymiary,procesor,os,pamiec_ram,path from tablet where id = ? ")){
        
        $row->bind_param('i', $id);
        $row->execute();
        $row->bind_result($nazwa, $cena, $producent, $bateria, $waga, $wymiary, $procesor, $os, $pamiec_ram, $path);
        $row->fetch();
        

    echo "
    <div class='div-slide-main'>
    <img src='$path' class='img-slide-main'> 
    </div>";
    
    echo "<div class='div-slide-opis'>";
    echo "Nazwa:  <span style='font-weight: bold;'>".$nazwa."</span><br>";
    echo "Producent:  <span style='font-weight: bold;'>".$producent."</span><br>";
    echo "Waga:  <span style='font-weight: bold;'>".$waga."</span><br>";
    echo "Procesor:  <span style='font-weight: bold;'>".$procesor."</span><br>";
    echo "OS:  <span style='font-weight: bold;'>".$os."</span><br>";
    echo "Pamięć RAM:  <span style='font-weight: bold;'>".$pamiec_ram."</span><br>";
    echo "Bateria:  <span style='font-weight: bold;'>".$bateria."</span><br>";
    echo "</div>";
        
        $row->close();
        
        }else{
          echo $mysqli->error;
          
        }
      }
    $stmt->close();
    }else{
      echo 'Błąd zapytania';
    };
    
    echo "</div></div>";
// END of slides    
    ?>
   
    </div>
      <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  </div>
</div>
</div>   
<!--  END OF SLIDER       -->    

<div style="text-align: center;padding-top: 50px;  ">
<h2>Witaj w internetowym sklepie komputerowym.</h2>
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