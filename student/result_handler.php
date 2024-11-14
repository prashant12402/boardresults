<?php
    
    $results = [];
    $studentRollNumber;
    $marksObtained = 0;
    $maxMarks = 0;
    $percentage = 0;
    $resultStatus = "";

    //var_dump($GLOBALS);
    //var_dump($_SERVER);

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        
        /*
        $rollNumber = $_REQUEST["roll_number"];
        print("query string=".$rollNumber."<br>");
        $idNumber = $_REQUEST["id_number"];
        print("id =".$idNumber."\r\n");
        */


        $studentRollNumber = $_GET['roll_number'];
        $results = get_result($studentRollNumber);

        //var_dump($results);

        if( $results){
            foreach($results as $result) {
                $marksObtained = $marksObtained + $result['marks_obtained'];
                $maxMarks = $maxMarks + $result['max_marks'];
            }

            $percentage = $marksObtained / $maxMarks * 100;

            if($percentage>33){
                $resultStatus = "PASS";
            }else{
                $resultStatus = "FAIL";
            }

            /*for($i=0; $i< count($results); $i++){
                echo $results[$i]['Id'], '<br>';
            }*/

            require("result_display.php");

        } else {
            require("result_error.html");
        }
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
        $query->execute([$name, $fName,$address, $courseName]);
    }

    function get_result($rollNumber){
        $results = [];
        try{
            $conn = get_connection();
            $query = $conn->prepare("SELECT s.*, m.marks_obtained, m.max_marks, sub.name as subject_name FROM student s, marks m, subject sub WHERE s.Id= m.student_id AND m.subject_id= sub.Id AND s.Id=?");
            $query->execute([$rollNumber]);
            $results = $query->fetchAll();
        }catch (Exception $e){
            echo $e->getMessage();
        }
        return $results;
    }
?>