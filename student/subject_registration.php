<?php
    
    $status = false;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $subjectName = $_POST['subject_name'];
        $status = save_student($subjectName);


        if($status == 1){
            $status = true;
        }

        require("subject_registration_status.php");
    }

    function get_connection(){
        $dsn = "mysql:host=localhost;dbname=upboardresult";
        $user = "root";
        $passwd = "";
        $conn = new PDO($dsn, $user, $passwd);
        return $conn;
    }

    function save_student($name){
        $conn = get_connection();
        $sql = "INSERT INTO `subject`(`name`) VALUES (?)";
        $query = $conn->prepare($sql);
        return $query->execute([$name]);
    }
?>