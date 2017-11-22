<?php
define('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/projektsklep/');

function getNumberTable($table, $pathDb){
        include($pathDb);
    
    
    if ( $stmt = $mysqli->query("select id from $table" )  ){
        
        $iloscWierszy = $stmt->num_rows;
        return $iloscWierszy;
        
    }else{
        return '0';
    }
    
}

function updateDostapna_ilosc($table,$id, $newDostepna_ilosc, $pathDb){
    include($pathDb);
    
    if ( $stmt = $mysqli->prepare("UPDATE $table SET dostepna_ilosc = ? where id = $id" )  ){
        
       $stmt->bind_param("i", $newDostepna_ilosc);
       $stmt->execute();
       $stmt->close();
        
    }else{
        return '0';
    }
    
}


?>