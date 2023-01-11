
<?php

    $servername ="localhost";
    $username ="root";
    $password ="";
    $dbname="TestDb";
    $table="Employye"; // create a table name Emplyoee

    //we will get actions from the app to do operations in the database....

    $action = $_POST["action"];

    //create connections 
    $conn = new mysqli($servername,$username,$password,$dbname);

    //check conncetion

    if($conn->connect_error){
        die("Connection Failed: ".$conn->connect_error);
        return;
    }

    //if connection is  OK 

    //if the app sends an action to create the table 
    if("CREATE_TABLE" == $action)
    {
        $sql = "CREATE TABLE IF NOT EXISTS $table ( 
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                first_name VARCHAR(30) NOT NULL,
                last_name VARCHAR(30) NOT NULL)";
        
        if($conn->query($sql)==TRUE){
            // send back message 
            echo "sucess";
        }else{
            echo "error";
        }

        $conn->close();
        return;
    }
    //Next action to get all employee records from the database 

    if("GET_ALL" == $action)
    {
        $db_data = array();
        $sql = "SELECT id, first_name,last_name from $table ORDER BY id DESC";
        $result = $conn->query($sql);

        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc()){
                $db_data[] = $row;

            }
            //send back the complete records as a json

            echo  json_encode($db_data);
        }else{
            echo "error";
        }

        $conn->close();
        return;
    }

    if("ADD_EMP" == $action)
    {
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];

    }
?>