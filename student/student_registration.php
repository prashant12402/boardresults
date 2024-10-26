<?php
    
    $status = false;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $studentName = $_POST['student_name'];
        $fatherName =$_POST['father_name'];
        $address =$_POST['address'];
        $course=$_POST['course'];
        $status = save_student($studentName, $fatherName,$address,$course);


        if($status == 1){
            $status = true;
        }

        require("student_registration_status.php");
    }

    function get_connection(){
        $dsn = "mysql:host=localhost;dbname=upboardresult";
        $user = "root";
        $passwd = "";
        $conn = new PDO($dsn, $user, $passwd);
        return $conn;
    }

    function save_student($name, $fName,$address, $courseName){
        $conn = get_connection();
        $sql = "INSERT INTO `student`(`name`, `f_name`, `address`, `course_name`) VALUES (?,?,?,?)";
        $query = $conn->prepare($sql);
        return $query->execute([$name, $fName,$address, $courseName]);
    }
?>