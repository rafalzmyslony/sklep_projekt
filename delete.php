<?php
include('db_connect.php');
if( isset($_GET['id']) && is_numeric($_GET['id'])   ){
    
    $id = $_GET['id'];
    $tabela = $_GET['nazwa'];
   // echo $tabela;
   // die();
    if($stmt = $mysqli->prepare("Delete from $tabela where id = ?")){
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    
    header("Location: edycja.php");
    
}else{
    header("Location: edycja.php");
}
}

?>