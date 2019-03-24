<?php 
    //
    require "conn.php";
    require "User.php";

    //Initializing Object
    $user   = new User("Ahmad", "ahmadshahwaiz@gmail.com");
    $user->setAge(21);
    $name   = $user->getName();
    $email  = $user->getEmail();

    echo "Hello World!!".$name." ".$user->getAge()." Sum: ".$user->sum(5,5);

    //Connection was already established in the conn.php file.
    //So now creating database. 
    $insertQuery = "INSERT INTO user (full_name, email, status) VALUES ('$name','$email',1)";

    if ($conn->query($insertQuery)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    //Fetching results from database.
    $selectQuery = "SELECT * FROM user";

    $result = $user->getRecords($conn, $selectQuery);

    $i = 1;
    

    while($row = $result->fetch_assoc()){
        echo "<br/> $i) ".$row["full_name"];
        $i++;
    }
 
     //Update Query
     $updateQuery = "UPDATE user set full_name='shahwaiz' where email='ahmadshahwaiz@gmail.com'"; 

     if ($conn->query($updateQuery)) {
         echo "Record Updated";
     } else {
         echo "Error: " . $sql . "<br>" . $conn->error;
     }

    $conn->close();

?>
