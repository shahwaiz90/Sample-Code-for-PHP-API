<?php
class User
{
    private $fname;
    private $email;
    private $age; 
    private $totalSum;
    private $records;
    private $conn;

    public function __construct($fname, $email)
    { 
        $this->fname = $fname;
        $this->email = $email;
    } 

    public function getNameAndEmail()
    {
        return $this->fname . ' ' . $this->email;
    }

    public function setAge($age){
        $this->age = $age;
    }

    public function getAge(){
        return $this->age;
    }

    public function getName(){
        return $this->fname;
    } 

    public function getEmail(){
        return $this->email;
    }

    public function sum($a, $b){
         return $this->totalSum = $a + $b;
    } 

    //Getting Records using Database function
    //$conn is passed as a reference
    public function getRecords($conn, $query){
        return $conn->query($query);
    }
}
?>