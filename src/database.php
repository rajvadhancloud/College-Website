<?php
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "my_college";
    try{
        $conn = new mysqli($db_server, $db_user, $db_pass, $db_name);
    } 
    catch(mysqli_sql_exception){
        // echo "could not connect !<br>";
    }
    if($conn){
        // echo "you are connected<br>";
    }
    $query = "CREATE TABLE user_courses (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        course_id INT,
        purchase_date DATETIME,
        FOREIGN KEY (user_id) REFERENCES admin(id),
        FOREIGN KEY (course_id) REFERENCES courses(id)
    )";

    $result = mysqli_query($conn,$query);
    
    
?>
