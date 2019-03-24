<?php  
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    require "conn.php";
    require "Utility.php";

    $users_array                    =       array();
    $users_array ["status_code"]    =       200;  
    $users_array ["status_message"] =       "";
    $users_array["data"]            =       array();
 
    if(isset($_GET["name"])){ 
        $fname      =   $_GET["name"]; 
        $utility    =   new Utility(); 
        $getQuery   =   "select * from user where full_name='Ahmad'"; 
        $result     =   $utility->getRecords($conn, $getQuery); 

        $users_array ["status_message"] = "Showing Results";

        while($row = $result->fetch_assoc()){ 
            $user_object=array(
                "full_name" => $row["full_name"],
                "email"     => $row["email"]
            );
    
            array_push($users_array["data"], $user_object);
        }
        // set response code - 200 OK
        http_response_code(200);
    
        // show user data in json format
        echo json_encode($users_array);

    }else{

        $users_array ["status_message"] = "Something went wrong, please try again later.";
        // set response code - 400 Bad Request
        http_response_code(400);
        $users_array ["status_code"]    =       400;  
        
        // show user data in json format
        echo json_encode($users_array);
    }
    

?>
