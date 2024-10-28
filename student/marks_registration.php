<?php
    
    $status = false;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $studentId = $_POST['student_id'];
        $subjectId = $_POST['subject_id'];
        $marksObtained = $_POST['marks_obtained'];
        $maximumMarks = $_POST['maximum_marks'];
        $status = save_student($studentId,$subjectId, $marksObtained, $maximumMarks);
        if($status == 1){
            $status = true;
        }

        require("marks_registration_status.php");
    }

    function get_connection(){
        $dsn = "mysql:host=localhost;dbname=upboardresult";
        $user = "root";
        $passwd = "";
        $conn = new PDO($dsn, $user, $passwd);
        return $conn;
    }

    function save_student($stuId,$subId,$marksObtain,$maxMarks){
        $conn = get_connection();
        $sql = "INSERT INTO marks(student_id,subject_id,marks_obtained,max_marks) VALUES (?,?,?,?)";
        $query = $conn->prepare($sql);
        return $query->execute([$stuId,$subId,$marksObtain,$maxMarks]);
    }
?>