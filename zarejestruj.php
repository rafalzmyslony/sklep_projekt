<meta charset='utf-8'>
<?php 



session_start();
if (  ( $_POST['newLogin'] == '' or $_POST['newPass'] == '' or $_POST['imie']=='' or $_POST['nazwisko']=='' or $_POST['email']=='' )
 /*   or  ( !isset($_POST['newLogin']) or !isset($_POST['newPass']) )*/  ){
    $_SESSION['noLogOrPass'] = true;
    header('Location: rejestracja_view.php');
}else{
    include('db_connect.php');

    
    $login = htmlentities($_POST['newLogin'], ENT_QUOTES);
    $pass = htmlentities($_POST['newPass'], ENT_QUOTES);
    $imie = htmlentities($_POST['imie'], ENT_QUOTES);
    $nazwisko = htmlentities($_POST['nazwisko'], ENT_QUOTES);
    $email = htmlentities($_POST['email'], ENT_QUOTES);
     
    if ($stmt = $mysqli->query("select * from uzytkownicy where login = '$login'") ){
        
      if ( $stmt->num_rows > 0  ){
       $_SESSION['userExist'] = true;
       header('Location: rejestracja_view.php');
      }else{
          // rejestracja
          $passwd = password_hash($pass, PASSWORD_DEFAULT);

          if ( $stmt2 = $mysqli->prepare("insert into uzytkownicy (imie,nazwisko,login,haslo,email) values
            (?,?,?,?,?) ") ){
              $stmt2->bind_param('sssss', $imie, $nazwisko, $login, $passwd, $email);
              $stmt2->execute();
              $stmt2->close();

            $_SESSION['zalogowany'] = true;
            $_SESSION['username']= $login;
            $_SESSION['email']= $email;
                
    
              $_SESSION['signUpTrue']= true;
              header("Location: rejestracja_view.php");
          }else{
              echo 'Błąd dodania usera do bazy';
          }
      }
       
       $stmt->close();
    }else{
        echo 'Błąd zapytania o login usera';
    }
    
}

?>