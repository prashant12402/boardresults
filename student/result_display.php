<html>
    <head>
        <title>UP Board Results</title>
    </head>

    <body>
        <form>
            <div>
                <label>Student Name :</label>
                <label><?php  echo $results[1]['name'] ?></label>
            </div>
            <div>
                <label>Course Name : </label>
                <label><?php  echo $results[1]['course_name'] ?></label>
            </div>
            <div>
                <label>Father Name : </label>
                <label><?php  echo $results[1]['f_name'] ?></label>
            </div>
            <div>
                <label>Address : </label>
                <label><?php  echo $results[1]['address'] ?></label>
            </div>
            <table>
                <tr>
                    <th>Subject Name</th>
                    <th>Marks</th>
                    <th>Maximum Marks</th>
                  </tr>
                
                <?php  foreach($results as $value):?>
                    <tr>
                        <td><?php echo $value["subject_name"];?></td>
                        <td><?php echo $value["marks_obtained"];?></td>
                        <td><?php echo $value["max_marks"];?></td>
                    </tr>
                <?php endforeach;?>
            </table>
            <div>
                <label>Total Marks :</label>
                <label>
                    <?php echo $marksObtained; ?>
                </label>
            </div>

            <div>
                <label>Percentage:</label>
                <label><?php echo $percentage; ?></label>
            </div>

            <div>
                <label>Result:</label>
                <label><?php echo $resultStatus; ?></label>
            </div>
        </form>
    </body>
</html>