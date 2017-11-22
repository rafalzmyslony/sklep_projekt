<meta charset='utf-8'>
<?php
$e = unserialize($_POST['tablica_row']);
$ee = serialize($e);
$addr = "categories/pelenopis.php?tablica=".urlencode($ee);

//header('Content-type: text/plain; charset=utf-8');

/*analiza wymagan, jakie narzedia
w pliku. plik README.txt ,
dac tam imie i nazwisko
co zrobilem a czego nie i dlaczego
*/
//header('Content-Type:text/html; charset=UTF-8');
$pathDb = "db_connect.php";
session_start();
//$addr = $_SESSION['addrReturn']; // adres powrotu na stronę
include('mysqlfunctions.php');
//$addrReturn = "categories/pelenopis.php?tablica=".$_SESSION['addrReturn'];

$_SESSION['koszykTrue'] = true; // if isset display on site
if (empty($_SESSION['koszyk'])){
    $_SESSION['koszyk'] = array();
}

    $ile_tablic_w_array = count($_SESSION['koszyk'])  ;
    
    // gdy 1. produkt do koszyka
    if($ile_tablic_w_array==0){
       $arrayName = array($_POST['nazwa'], $_POST['ile_sztuk'], $_POST['cena']);
       array_push($_SESSION['koszyk'], $arrayName);  
       $_SESSION['koszyk'][0][1] = $_POST['ile_sztuk'];
       
                /*testowanie update... dodac wyzej  .... do header dopisac nowa tablice z nowa wartoscia*/
                $dostepna_ilosc = $_POST['dostepna_ilosc'];
                $newDostIlosc = $dostepna_ilosc - $_POST['ile_sztuk'];
                updateDostapna_ilosc($_POST['nazwa_tabeli'], $_POST['id'], $newDostIlosc, $pathDb  );
                //$tablica_row = unserialize($_POST['tablica_row']);
               // $tablica_row = $tab;
                //$tablica_row['dostepna_ilosc'] = $newDostIlosc;
                //$_SESSION['addrReturn'] = "categories/pelenopis.php?tablica=".serialize($tablica_row);
                $_SESSION['newDostIlosc'] = $newDostIlosc;
                //header('Content-Type: text/html; charset=utf-8');
                //echo $addrReturn;
               
                header("Location: ".$addr);
                
    }else{
        $stab = false;
        for($i=0; $i<=$ile_tablic_w_array-1;$i++){
           
            if ($_POST['nazwa'] == $_SESSION['koszyk'][$i][0] ){

                if (!isset($_SESSION['koszyk'][$i][1])){
                    $_SESSION['koszyk'][$i][1] = 0;
                }
                $_SESSION['koszyk'][$i][1] = $_SESSION['koszyk'][$i][1] + $_POST['ile_sztuk'];
                /*testowanie update... dodac wyzej  .... do header dopisac nowa tablice z nowa wartoscia*/
                $dostepna_ilosc = $_POST['dostepna_ilosc'];
                $newDostIlosc = $dostepna_ilosc - $_POST['ile_sztuk'];
                $_SESSION['newDostIlosc'] = $newDostIlosc;
                updateDostapna_ilosc($_POST['nazwa_tabeli'], $_POST['id'], $newDostIlosc, $pathDb  );
                //$tablica_row = unserialize($_POST['tablica_row']);
                //$tablica_row = $tab;
                //$tablica_row['dostepna_ilosc'] = $newDostIlosc;
                //$_SESSION['addrReturn'] = "categories/pelenopis.php?tablica=".serialize($tablica_row);
                //$_SESSION['test'] = $tablica_row;
                $stan = true;
                header("Location: ".$addr);
              //  header("Location: $addr"); 
              //header('Content-Type: text/html; charset=utf-8');
             // header("Location:". $_SESSION['addrReturn']." \" "  );
             //header("Location: urlencode($addrReturn)");
            }
        }
        if ($stan == false  ){
           $arrayName = array($_POST['nazwa'], $_POST['ile_sztuk'], $_POST['cena']);
           array_push($_SESSION['koszyk'], $arrayName);   
           // bez sensu, bo musi byc juz ustawiony przez powyzsze 
           /*
           if (!isset($_SESSION['koszyk'][$ile_tablic_w_array][1])){
                $_SESSION['koszyk'][$i][1] = 0;
            }
            
                $_SESSION['koszyk'][$i][1] = $_SESSION['koszyk'][$i][1] + $_POST['ile_sztuk'];
            */
                /*testowanie update... dodac wyzej  .... do header dopisac nowa tablice z nowa wartoscia*/
                $dostepna_ilosc = $_POST['dostepna_ilosc'];
                $newDostIlosc = $dostepna_ilosc - $_POST['ile_sztuk'];
                updateDostapna_ilosc($_POST['nazwa_tabeli'], $_POST['id'], $newDostIlosc, $pathDb  );
                $_SESSION['newDostIlosc'] = $newDostIlosc;
    
                
        }   
    }
header("Location: ".$addr);
//header('Content-Type: text/html; charset=utf-8');
//header("Location:". $_SESSION['addrReturn']." \" "  );







?>