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

<div style="text-align: center;padding-top: 50px;">
    
<div id='okno-logowania' style='width: 270px; height: 400px; background-color: #698994;margin-left: auto; margin-right: auto;'>
    <?php
    session_start();
    if(isset($_SESSION['noLogOrPass'])  ){
        echo "<span style='color: red'>Wypełnij wszystkie pola </span>";
        unset($_SESSION['noLogOrPass']);
    }
    
        if(isset($_SESSION['userExist'])  ){
        echo "<span style='color: red'>Taki użytkowik już istnieje </span>";
        unset($_SESSION['userExist']);
    }

        if(isset($_SESSION['signUpTrue'])  ){
            echo "<div class='alert alert-success'>
        Uzupełnij profil swoimi danymi, aby móc kupować <br>
            <strong>Zarejestrowany!</strong> Za 5 sekund zostaniesz przeniesiony na stronę główną
            </div>";
            unset($_SESSION['signUpTrue']);
            header( "refresh:5;url=index.php" );
        }
        
    ?>
  <form method='post' action='zarejestruj.php'>
            Podaj login: </br>  <input type='text' name='newLogin'   /> </br>
            Podaj hasło: </br>  <input type='password' name='newPass'   /> <br>
            Podaj imię: </br>  <input type='text' name='imie'   /> </br>
            Podaj nazwisko: </br>  <input type='text' name='nazwisko'   /> </br>
            Podaj adres e-mail: </br>  <input type='text' name='email'   /> </br>
            </br>    <input type='submit' value='Zarejestruj się' class='btn btn-danger' /><br><br>
            <button formaction='index.php' class='btn btn-primary'> Strona główna </button>

 
  </form>
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