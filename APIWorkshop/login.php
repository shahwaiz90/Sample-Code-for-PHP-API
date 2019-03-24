<?php  
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    require "conn.php";
    require "Utility.php";

    $users_array                    =       array();
    $users_array ["status_code"]    =       200;  
    $users_array ["status_message"] =       ""; 
    $users_array ["user_data"]      =       array();
 
    if(isset($_POST["email"]) && isset($_POST["password"])){ 
        $email          =   $_POST["email"]; 
        $password       =   $_POST["password"];
        $randomToken    =   md5(rand(10,100));
        $password       =   md5($password);  
        $utility        =   new Utility(); 
        $getQuery       =   "select * from user where email='$email' and password='$password' limit 1"; 
        $result         =   $utility->getRecords($conn, $getQuery); 
        
        //User is authenticated
        if($result->num_rows == 1){

            $updateTokenQuery = "update user set token='$randomToken' where email='$email'";
            $utility->updateQuery($conn, $updateTokenQuery);
            $users_array ["status_message"] = "Returning User Object"; 
            while($row = $result->fetch_assoc()){ 
                $user_object=array(
                    "full_name"         => $row["full_name"],
                    "email"             => $row["email"],
                    "account_status"    => $row["status"],
                    "token"             => $randomToken 
                ); 
                array_push($users_array["user_data"], $user_object);
            }

            // set response code - 200 OK
            http_response_code(200); 
            // show user data in json format
            echo json_encode($users_array);
        }else{

            $users_array ["status_message"] = "Wrong username or password."; 
            // set response code - 200 OK
            http_response_code(200);
         
            $users_array ["status_code"]    =       600;  
            // show user data in json format
            echo json_encode($users_array);
        } 

    }else{

        $users_array ["status_message"] = "Something went wrong, please try again later.";
        // set response code - 400 Bad Request
        http_response_code(400);
        $users_array ["status_code"]    =       400;  
        
        // show user data in json format
        echo json_encode($users_array);
    } 

?>
