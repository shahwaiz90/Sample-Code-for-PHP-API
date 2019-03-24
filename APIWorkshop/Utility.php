<?php
class Utility
{ 
    private $conn;
    
    //Getting Records using Database function
    //$conn is passed as a reference
    public function getRecords($conn, $query){
        return $conn->query($query);
    }

    public function updateQuery($conn, $query){
         $conn->query($query);
    }
}

?>