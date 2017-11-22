<?php
session_start();
include('db_connect.php');

if($_POST['login']=='' or $_POST['pass']==''  ){
    $_SESSION['errorPustePole'] = true;
    header("Location: login_view.php");
    exit();
}

if (  isset($_SESSION['zalogowany'])  ){
 header('Location: index.php');
}else{
 
 $login = htmlentities($_POST['login'], ENT_QUOTES);
 $haslo = htmlentities($_POST['pass'], ENT_QUOTES);

 
 $query = "SELECT login, haslo from uzytkownicy WHERE login=? ";
 
 if ($stmt = $mysqli->prepare($query)) {
    $stmt->bind_param('s', $login);
    $stmt->execute();
    $stmt->store_result();

    
    if ( $stmt->num_rows == 0 ) // no such user
    {
     session_start();
     $_SESSION['errorNoSuchUser'] = true;
     header('Location: login_view.php');
    }else{ // user exists
     $stmt->bind_result($username, $hash);
     $stmt->fetch();

     
     if (password_verify($haslo, $hash)) {
        //session_start();
        $_SESSION['zalogowany'] = true;
        $_SESSION['username'] = $username;  
        $_SESSION['fk_user'] = $dane_id;
      
        if ($stmt2= $mysqli->query("select * from dane_uzytkownicy where id = $dane_id ")){
         $obj = $stmt2->fetch_object();
         $najwyzszeId = 1;
         $rowsArray = $stmt2->fetch_assoc();
         
         $_SESSION['nr_telefon'] = $rowsArray['nr_telefon'];
         $_SESSION['kraj'] = $rowsArray['kraj'];
         $_SESSION['wojewodztwo'] = $rowsArray['wojewodztwo'];
         $_SESSION['miejscowosc'] = $rowsArray['miejscowosc'];
         $_SESSION['ulica'] = $rowsArray['ulica'];
         $_SESSION['nr_dom'] = $rowsArray['nr_dom'];
         
         $stmt2->close();
         }       
        
        
        header('Location: index.php');
    } else {
        
        $_SESSION['errorPassDoesntMatch'] = true;
        header('Location: login_view.php');
        
    } 
    }
    
    
    

    $stmt->close();
} else {
   // blad zapytania
   // session_start();
   // $_SESSION['errorQuery'] = true;
   // ...
}; 
 
}

?>